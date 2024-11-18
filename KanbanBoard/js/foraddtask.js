/// create task
var settings = {
  plugins: ['remove_button'],
	persist: false,
	createOnBlur: true,
	create: false 
};
new TomSelect('#tselect',settings);

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltips = document.querySelectorAll('[data-toggle="tooltip"]');
    tooltips.forEach(function(tooltip) {
        new bootstrap.Tooltip(tooltip);
    });

// Function to handle click events on canvas elements
var selectedCanvas = null; // Ensure this is defined outside the function to keep track of the selected canvas

function handleCanvasClick(event) {
  var canvas = event.target;
  console.log(canvas);
  var color = document.getElementById('tpc');
  var border = document.getElementById('tpb');

  if (canvas.tagName === 'CANVAS') {
    if (selectedCanvas) {
      selectedCanvas.classList.remove('MiYselected');
    }
    canvas.classList.add('MiYselected');
    selectedCanvas = canvas; // Update the reference to the new selected canvas

    var hasCanvas1 = canvas.classList.contains('MiYcanvas1');
    var hasCanvas2 = canvas.classList.contains('MiYcanvas2');
    console.log(hasCanvas1);
    console.log(hasCanvas2);
  
    if(hasCanvas1){
      color.value  = "YfirstPriority";
      border.value = "YFirstCardBorder";
    }else if(hasCanvas2){
      color.value  = "YsecondPriority";
      border.value = "YSecondCardBorder";
    }else{
      color.value  = "YthirdPriority";
      border.value = "YthirdPriority";
    }
  }
}
// var priority = selectedCanvas.getAttribute('data-priority');
// console.log('Selected priority:', priority);
var canvasContainer = document.querySelector('.canvas-containerMi');
console.log(canvasContainer);

if(canvasContainer){
  canvasContainer.addEventListener('click', handleCanvasClick);
}
});

/// create project



//stage
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



