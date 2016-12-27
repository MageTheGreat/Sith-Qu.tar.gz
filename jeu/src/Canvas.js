function Canvas(size,maze,cellSize,wallSize,playerSize,playerSpeed)
{
	this.canvas = createCanvas(size,size);
	this.canvas.parent("sketch-holder");
	this.controller = new Control(maze,cellSize,wallSize,playerSize,playerSpeed);
	this.graphics = new Graphics(this.controller,size);

	this.update = function()
	{
		this.controller.update();
		this.graphics.show();
	}

	this.resize = function()
	{
	  	var margin = document.body.clientWidth - this.graphics.getSize();
	  	this.canvas.style("margin-left:"+String(margin/2)+"px;margin-right:"+String(margin/2)+"px;");
	}
	window.addEventListener('resize', function() {canvas.resize();} , false);
	this.resize();

	this.keyDown = function(key)
	{
		this.controller.keyDown(key);
	}
	this.keyUp = function(key)
	{
		this.controller.keyUp(key);
	}
}