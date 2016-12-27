function Graphics(controller,size)
{
	this.size = size;
	this.controller = controller;
	this.overlay = createImage(size, size);

	var alphaValue = function(i,j)
	{
		var dist2center = Math.pow(i-size/2,2)+Math.pow(j-size/2,2);
		var a = map(min(dist2center,Math.pow(size/2,2)),0,Math.pow(size/2,2),0,255);
		return color(0,a);
	}

	this.overlay.loadPixels();
	for(var i=0; i<this.overlay.width; i++)
	{
		for (var j=0; j<this.overlay.height; j++)
		{
			this.overlay.set(i, j, alphaValue(i,j));
		}
	}
	this.overlay.updatePixels();

	this.show = function()
	{
		background(0);
		this.controller.show(this.size);
		image(this.overlay, 0, 0);
	}

	this.getSize = function()
	{
		return this.size;
	}
}