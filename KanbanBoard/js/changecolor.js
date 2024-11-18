



function Delete(task){
  let TasktoDelete = task.closest('.task-container');
  // alert('Are you sure?');
  TasktoDelete.remove();

  $('#exampleModalCenter').modal('hide');
  $('.modal-backdrop').remove(); // Remove the backdrop
}




function KdeleteMember(memberId) {
  console.log("hello");
  jQuery.ajax({
      url: '../pages/delete_memberlist.php',
      type: 'GET',
      data: { id: memberId },
      success: function(response) {
          // Optionally, you can handle success response
          console.log('Member deleted successfully');
          $('#' + memberId).modal('hide');
          $('.modal-backdrop').remove();
          // Remove the list item corresponding to the deleted member
          $('#listItem_' + memberId).remove();
      },
      error: function(xhr, status, error) {
          // Handle errors
          console.error('Error deleting member:', error);
      }
  });

 
}

function hello(){
  console.log("hello");
}





function changecolor(canvas) {
  // console.log("Canvas class:", canvas.classList);
  let hasCanvas1        =     canvas.classList.contains("canvas1");
  let hasCanvas2        =     canvas.classList.contains("canvas2");
  let new_taskContainer =     '';
  let new_taskHeader    =     '';
  let taskContainer = canvas.closest('.task-container');
  // let hasCanvas3 = canvas.classList.contains("canvas3");
  // Get the parent task-container element
  if (hasCanvas1) {
      // Check if the task-container element exists
      if (taskContainer) {
         
           // Remove all existing classes from the task-container element
          taskContainer.className = 'task-container';
          
          // Add 'YFirstCardBorder' class to the task-container element    
          taskContainer.classList.add('YFirstCardBorder');

          // Find the task-header element within the task-container
          let taskHeader = taskContainer.querySelector('.task-header');

          // Set the background color of the task-header element
          if (taskHeader) {
              taskHeader.className = 'task-header';    
              taskHeader.classList.add('YfirstPriority');
          }
      }
      new_taskContainer =  'YFirstCardBorder';
      new_taskHeader    =  'YfirstPriority';
  }else if(hasCanvas2){
      // Check if the task-container element exists
      if (taskContainer) {
         
          taskContainer.className = 'task-container';
          taskContainer.classList.add('YSecondCardBorder');

         
          let taskHeader = taskContainer.querySelector('.task-header');

         
          if (taskHeader) {
              taskHeader.className = 'task-header';    
              taskHeader.classList.add('YsecondPriority');
          }
      }
      new_taskContainer =  'YSecondCardBorder';
      new_taskHeader    =  'YsecondPriority';
  }else {  
      // Check if the task-container element exists
      if (taskContainer) {
          // Remove all existing classes from the task-container element
          taskContainer.className = 'task-container';

          // Add 'YFirstCardBorder' class to the task-container element
          taskContainer.classList.add('YThirdCardBorder');

          // Find the task-header element within the task-container
          let taskHeader = taskContainer.querySelector('.task-header');

          // Set the background color of the task-header element
          if (taskHeader) {
              taskHeader.className = 'task-header';    
              taskHeader.classList.add('YthirdPriority');
          }
      }
      new_taskContainer =  'YThirdCardBorder';
      new_taskHeader    =  'YthirdPriority';
  }
  let task_id           =     taskContainer.getAttribute('task_id');
  // console.log(task_id);
  // console.log(new_taskContainer);
  // console.log(new_taskHeader);

  ChgPColor4Tasks(task_id,new_taskContainer,new_taskHeader);

  console.log('<br>');
  console.log('after');
  console.log(task_id);
  console.log(new_taskContainer);
  console.log(new_taskHeader);
}

function ChgPColor4Tasks(task_id,new_taskContainer,new_taskHeader) {
  let url = '../Functions4Kanban/TasksPColorChg.php?task_id=' + task_id + '&new_taskContainer=' + new_taskContainer + '&new_taskHeader=' + new_taskHeader;

  //alternative approach use jquery $.get().... 
  const xhttp = new XMLHttpRequest();
  //onload == response code 200 and status 4.. request no error and completed
  xhttp.onload = function (xhttp) {
      let response = JSON.parse(xhttp.target.responseText);
      if (response.code == 1) {//success
          console.log('success');
      }
  };
  xhttp.open("GET", url);
  xhttp.send();
}

function Delete(task){
    const TasktoDelete = task.closest('.task-container');
    // alert('Are you sure?');
    TasktoDelete.remove();
    const column = task.closest('.task-column');
    // updateTaskCounts(column);
    updateTaskCounts();
    updateBarChartData();
    $('#exampleModalCenter').modal('hide');
    $('.modal-backdrop').remove(); // Remove the backdrop


}

// function allowDrop(ev) {
//     ev.preventDefault();
//   }
  
//   function drag(ev) {
//     ev.dataTransfer.setData("text", ev.target.id);
//   }
  
// //   function drop(ev) {
// //     ev.preventDefault();
// //     var data = ev.dataTransfer.getData("text");
// //     ev.target.appendChild(document.getElementById(data));
// //   }



// function drop(event) {
//     event.preventDefault();
//     updateTaskCounts(); 
//     updateBarChartData();

//     var data = event.dataTransfer.getData("text");
    
//     event.target.appendChild(document.getElementById(data));
//     var draggedElement = document.getElementById(data);
//     var target = event.target.closest('.task-container');

//     if (target === null) {
//       // console.error("Error: Target element not found.");
//       return; // Exit the function early to prevent further execution
//   }else{

//     var tasks = target.closest('.task-list').querySelectorAll('.task-container');
  
//     // Get the index of the dropped task
//     var droppedIndex = Array.from(tasks).indexOf(draggedElement);
  
//     // Get the index of the target task (if dropping onto another task)
//     var targetIndex = Array.from(tasks).indexOf(target);
  
//     // If dropping onto another task, adjust the target index
//     if (targetIndex !== -1) {
//       if (droppedIndex < targetIndex) {
//         targetIndex--; // Adjust index for dropping above the target task
//       }else {
//       targetIndex = tasks.length; // Append to the end if dropping at the bottom of the column
//     }
// }
  
//     // Insert the dragged task at the correct position
//     if (droppedIndex < targetIndex) {
//       target.parentNode.insertBefore(draggedElement, target);
//     } else {
//       if (targetIndex === 0) {
//         target.parentNode.insertBefore(draggedElement, tasks[0]);
//       } else {
//         target.parentNode.insertBefore(draggedElement, tasks[targetIndex]);
//       }
//     }

    
//   }
//   }

  // updateTaskCounts();
  
function updateTaskCounts() {
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

document.addEventListener('DOMContentLoaded', function() {
  const taskLists = document.querySelectorAll('.task-list');
  taskLists.forEach(taskList => {
      taskList.addEventListener('drop', drop);
      taskList.addEventListener('dragover', allowDrop);
  });

  // Initially update task counts
  updateTaskCounts();

  updateBarChartData();
});




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


document.addEventListener("DOMContentLoaded", function () {
  const taskLists = document.querySelectorAll('.task-list');

  taskLists.forEach(taskList => {
    const taskColumn = taskList.closest('.task-column');

    taskList.addEventListener('dragenter', function (event) {
      event.preventDefault();
      taskColumn.classList.add('hover');
    });

    taskList.addEventListener('dragover', function (event) {
      event.preventDefault(); // This line prevents the browser default behavior
      taskColumn.classList.add('hover');
    });

    taskList.addEventListener('dragleave', function (event) {
      event.preventDefault();
      taskColumn.classList.remove('hover');
    });

    taskList.addEventListener('drop', function (event) {
      event.preventDefault();
      taskColumn.classList.remove('hover');
    });
  });
});


