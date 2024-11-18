//stage
new TomSelect("#select-tags",{
	plugins: ['remove_button'],
	create: true,
	onItemAdd:function(){
		this.setTextboxValue('');
		this.refreshOptions();
	},
	render:{
		option:function(data,escape){
			return '<div class=""><span>' + escape(data.value) + '</div>';
		},
		item:function(data,escape){
			return '<div>' + escape(data.value) + '</div>';
		}
	}
});



