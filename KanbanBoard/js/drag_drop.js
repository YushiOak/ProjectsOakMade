let project_id = document.getElementById('project_id').getAttribute('value');
let user_id_div = document.getElementById('user_id');
let user_id = document.getElementById('user_id').getAttribute('value');

function allowDrop(ev) {
    ev.preventDefault();
    ev.target.closest('.dropzone').classList.add('drag-over');
}
function dragLeave(ev) {
    ev.preventDefault();
    ev.target.closest('.dropzone').classList.remove('drag-over');
}
function drag(ev) {
    let taskDiv = document.getElementById(ev.target.id);
console.log("drag");
    //user div id == task-d to move between role divs
    let task_div_id = ev.target.id;

    let task_id = taskDiv.getAttribute('task_id');
    let stage_id = taskDiv.getAttribute('stage_id');
 
    ev.dataTransfer.setData("task_div_id", task_div_id);
    ev.dataTransfer.setData("task_id", task_id);
    ev.dataTransfer.setData("old_stage_id", stage_id);
    ev.dataTransfer.setData("stage_id", stage_id);
}

document.addEventListener('DOMContentLoaded', function() {
    const taskLists = document.querySelectorAll('.task-list');
    taskLists.forEach(taskList => {
        taskList.addEventListener('drop', drop);
        taskList.addEventListener('dragover', allowDrop);
    });
  
    // Initially update task counts
  //   updateTaskCounts();
  
  //   updateBarChartData();
});

function drop(ev) {
    ev.preventDefault();
    
    console.log(ev.target.closest('.drop_stage').id);
    // ev.preventDefault();
    ev.target.classList.remove('drag-over');
    let task_div           = document.getElementById(ev.dataTransfer.getData("task_div_id"));
    let task_id            = ev.dataTransfer.getData("task_id");
    let old_stage_id = ev.dataTransfer.getData("old_stage_id");
console.log(task_div);
console.log(project_id);
    let new_stage_div = document.getElementById(ev.target.closest('.drop_stage').id);
    //get new_stage_id from drop target stage div
    let new_stage_id = new_stage_div.getAttribute("stage_id");
    console.log("old stage :" + old_stage_id);
    console.log("new stage :" + new_stage_id);
    let target = ev.target.closest('.dropzone');    
     update_task_stage(task_id, new_stage_id, task_div, new_stage_div, project_id, function() {
        update_task_stage(task_id, new_stage_id, task_div, new_stage_div, project_id, function() {        
            updateTaskCounts();
            updateTaskCounts();
            updateBarChartData();
        StageChgHistory(task_id, user_id, old_stage_id, new_stage_id, project_id);
    });
});
}

//update function for barchart(myo)
function update_task_stage(task_id, new_stage_id, task_div, new_stage_div, project_id, callback) {
    // Move the task element to the new stage element in the DOM
    new_stage_div.appendChild(task_div);
    task_div.setAttribute('stage_id', new_stage_id);

    // Update the task stage in the backend (assuming asynchronous operation)
    let url = '../Functions4Kanban/task_stage_update.php?task_id=' + task_id + '&stage_id=' + new_stage_id + '&project_id=' + project_id;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let response = JSON.parse(xhttp.responseText);
        if (response.code === 1) {
            // Task stage updated successfully
            console.log('Task stage updated successfully.');
            // Call the callback function once the task movement is completed
            if (typeof callback === 'function') {
                callback();
            }
        } else {
            console.error('Error updating task stage:', response.message);
        }
    };
    xhttp.open("GET", url);
    xhttp.send();
}

function StageChgHistory(task_id, user_id, old_stage_id, new_stage_id, project_id) {
    // Form the query string with proper parameter values
    let url = '../Functions4Kanban/stage_history.php?task_id=' + task_id +
        '&user_id=' + user_id +
        '&old_stage_id=' + old_stage_id +
        '&new_stage_id=' + new_stage_id +
        '&project_id=' + project_id;

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(xhttp) {
        let response = JSON.parse(xhttp.target.responseText);
        if (response.code == 1) {
            console.log('success');
        }
    };
    xhttp.open("GET", url);
    xhttp.send();
}

console.log("drag");

console.log("pj id: " + project_id);
console.log("user id : " + user_id);

//add function for barchart(myo)
function updateTaskCounts(){
    const columnContainers = document.querySelectorAll('.column-container .task-list');
    columnContainers.forEach(column => {
        const columnId = column.closest('.task-column').id;
        const tasks = column.querySelectorAll('.task-container');
        console.log(`Tasks in column ${columnId}:`, tasks.length);

        const taskCountElement = document.getElementById(`${columnId}TaskCount`);
        if (taskCountElement) {
            taskCountElement.innerHTML = tasks.length;
        }
    });
}

//add function for barchart(myo)
function updateBarChartData() {
    var labels = [];
    var data = [];
    // Iterate over each column to get task counts
    document.querySelectorAll('.column-container .task-column').forEach(column => {
        const columnId = column.id;
        const taskCountElement = document.getElementById(`${columnId}TaskCount`);
        if (taskCountElement) {
            labels.push(columnId);
            data.push(parseInt(taskCountElement.textContent));
        }
    });
  
    // Get the chart instance
    var myChart = Chart.getChart("YbarChart_from_kanban_board");
  
    // Update chart data
    myChart.data.labels = labels;
    myChart.data.datasets[0].data = data;
    myChart.update();
}
