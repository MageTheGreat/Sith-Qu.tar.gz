function Player(x,y,size,speed)
{
	this.pos = createVector(x,y);
	this.size = size;
	this.speed = speed;
	this.search = [];

	this.getPosition = function()
	{
		return this.pos;
	}

	this.getSize = function()
	{
		return this.size;
	}

	this.getSpeed = function()
	{
		return this.speed;
	}

	this.getSearch = function()
	{
		return String(this.search);
	}

	this.move = function(dest)
	{
		this.pos = dest[0];
		if(dest[1] != "")
		{
			this.search.push(dest[1]);	
		}
	}

	this.show = function()
	{
		noStroke();
		fill(200,40,40);
		ellipse(width/2,height/2,this.size,this.size);
	}
}