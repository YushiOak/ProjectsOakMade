/// create task
var settings = {
  plugins: ['remove_button'],
	persist: false,
	createOnBlur: true,
	create: false 
};

// new TomSelect('#tselect',settings);

try {
  // Attempt to initialize TomSelect
  new TomSelect('#tselect', settings);
} catch (error) {
  // Handle the error here
  // console.error('An error occurred while initializing TomSelect:', error);
}




document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltips = document.querySelectorAll('[data-toggle="tooltip"]');
    tooltips.forEach(function(tooltip) {
        new bootstrap.Tooltip(tooltip);
    });


var selectedCanvas = null;

// Function to handle click events on canvas elements
function handleCanvasClick(event) {
  var canvas = event.target;
  if (canvas.tagName === 'CANVAS') {
    // Remove selected class from previously selected canvas
    if (selectedCanvas) {
      selectedCanvas.classList.remove('MiYselected');
    }
    // Set the clicked canvas as selected
    selectedCanvas = canvas;
    selectedCanvas.classList.add('MiYselected');

    // Get the priority from the data-priority attribute
    var priority = selectedCanvas.getAttribute('data-priority');
    console.log('Selected priority:', priority);
  }
}

// Add click event listener to the canvas container
var canvasContainer = document.querySelector('.canvas-containerMi');
if(canvasContainer){
  canvasContainer.addEventListener('click', handleCanvasClick);
}

});

/// create project



// //stage
// new TomSelect("#select-tags",{
// 		plugins: ['remove_button'],
// 		create: true,
// 		onItemAdd:function(){
// 			this.setTextboxValue('');
// 			this.refreshOptions();
// 		},
// 		render:{
// 			option:function(data,escape){
// 				return '<div class=""><span>' + escape(data.value) + '</div>';
// 			},
// 			item:function(data,escape){
// 				return '<div>' + escape(data.value) + '</div>';
// 			}
// 		}
// 	});



