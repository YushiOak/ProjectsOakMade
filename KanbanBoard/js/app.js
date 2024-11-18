const taskLists = document.querySelectorAll('.task-list')
const backlogTasks = document.querySelector('#backlog .task-list')
const titleInput = document.querySelector('#title')
const descriptionInput = document.querySelector('#description')
// const submitButton = document.querySelector('#submit-button')
const errorContainer = document.querySelector('.error-container')


let tasks = [
  {
    id: 0,
    title: 'Fix submit button',
    description:
      'The submit button has stopped working since the last release.',
  },
  {
    id: 1,
    title: "Change text on T and C's",
    description:
      'The terms and conditions need updating as per the business meeting.',
  },
  {
    id: 2,
    title: 'Change banner picture',
    description:
      'Marketing has requested a new banner to be added to the website.',
  },

  {
    id: 3,
    title: 'Test',
    description:
      'Marketing has requested a new banner to be added to the website.',
  },

  {
    id:43,
    title: 'Tes5',
    description:
      'Marketing has requested a new banner to be added to the website.',
  }
]

taskLists.forEach((taskList) => {
  taskList.addEventListener('dragover', dragOver)
  taskList.addEventListener('drop', dragDrop)
})




function createTask(taskId, title, description) {
  const taskCard = document.createElement('div')
  const taskHeader = document.createElement('div')
  //create own
  const titleDeletIconDiv = document.createElement('div')
 const taskChooseColor = document.createElement('div')
  
  document.body.appendChild(taskChooseColor); // Append the div to the document body




  fetch('pages/circlecolor.html')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.text();
  })
  .then(htmlContent => {
    taskChooseColor.innerHTML = htmlContent;

    // Execute the script after adding HTML content to the DOM
    const scriptElement = document.createElement('script');
    scriptElement.textContent = `
      document.getElementById('canvas1').addEventListener('click', function() {
        document.querySelector('.task-header').style.backgroundColor = '#d16bca';
      });

      document.getElementById('canvas2').addEventListener('click', function() {
        document.querySelector('.task-header').style.backgroundColor = '#795ce0';
      });

      document.getElementById('canvas3').addEventListener('click', function() {
        document.querySelector('.task-header').style.backgroundColor = '#30d1d9';
      });
    `;
    document.body.appendChild(scriptElement);
  })
  .catch(error => {
    console.error('Error fetching HTML:', error);
  });



  //  canvas1 = document.createElement('canvas');
  //  canvas2 = document.createElement('canvas');
  //  canvas3 = document.createElement('canvas');
  //
  const taskTitle = document.createElement('p')
  const taskDescriptionContainer = document.createElement('div')
  const taskDescription = document.createElement('p')
  const deleteIcon = document.createElement('p')

  taskCard.classList.add('task-container')
  taskHeader.classList.add('task-header')
  taskDescriptionContainer.classList.add('task-description-container')
  //create own
  // taskChooseColor.classList.add('taskChooseColor')
  // taskChooseColor.classList.add('canvas-container')
  titleDeletIconDiv.classList.add('titleDeletIconDiv')
  // canvas1.classList.add('canvas')
  // canvas2.classList.add('canvas')
  // canvas3.classList.add('canvas')

  taskTitle.textContent = title
  taskDescription.textContent = description
  deleteIcon.textContent = '☒'

  taskCard.setAttribute('draggable', true)
  taskCard.setAttribute('task-id', taskId)

  taskCard.addEventListener('dragstart', dragStart)
  deleteIcon.addEventListener('click', deleteTask)

  //  taskHeader.append(taskTitle, deleteIcon)
  //create own
  titleDeletIconDiv.append(taskTitle, deleteIcon)
  taskHeader.append(titleDeletIconDiv,taskChooseColor);
  taskDescriptionContainer.append(taskDescription)
  taskCard.append(taskHeader, taskDescriptionContainer)
  backlogTasks.append(taskCard)
  // taskChooseColor.append(canvas1,canvas2,canvas3);
}


function addColor(column) {
  // let color
  // switch (column) {
  //   case 'backlog':
  //     color = 'rgb(96, 96, 192)'
  //     break
  //   case 'doing':
  //     color = 'rgb(83, 156, 174)'
  //     break
  //   case 'done':
  //     color = 'rgb(224, 165, 116)'
  //     break
  //   case 'discard':
  //     color = 'rgb(222, 208, 130)'
  //     break
  //   default:
  //     color = 'rgb(232, 232, 232)'
  // }
  // return color
}

function addTasks() {
  // advanced: you can pass through the whole task object if you wish
  tasks.forEach((task) => createTask(task.id, task.title, task.description))
}

addTasks()

let elementBeingDragged

function dragStart() {
  elementBeingDragged = this
}

function dragOver(e) {
  e.preventDefault()
}

function dragDrop() {
  const columnId = this.parentNode.id
  elementBeingDragged.firstChild.style.backgroundColor = addColor(columnId)
  this.append(elementBeingDragged)
}

function showError(message) {
  const errorMessage = document.createElement('p')
  errorMessage.textContent = message
  errorMessage.classList.add('error-message')
  errorContainer.append(errorMessage)

  setTimeout(() => {
    errorContainer.textContent = ''
  }, 2000)
}

function addTask(e) {
  e.preventDefault()
  const filteredTitles = tasks.filter((task) => {
    return task.title === titleInput.value
  })

  if (!filteredTitles.length) {
    const newId = tasks.length
    tasks.push({
      id: newId,
      title: titleInput.value,
      description: descriptionInput.value,
    })
    createTask(newId, titleInput.value, descriptionInput.value)
    titleInput.value = ''
    descriptionInput.value = ''
  } else {
    showError('Title must be unique!')
  }
}
// submitButton.addEventListener('click', addTask)

function deleteTask() {
  const headerTitle = this.parentNode.firstChild.textContent

  const filteredTasks = tasks.filter((task) => {
    return task.title === headerTitle
  })

  tasks = tasks.filter((task) => {
    return task !== filteredTasks[0]
  })
  
  this.parentNode.parentNode.remove()
}
