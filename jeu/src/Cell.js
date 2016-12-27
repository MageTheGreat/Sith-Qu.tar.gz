function Cell()
{
	this.top = true;
	this.left = true;

	this.getTop = function()
	{
		return this.top;
	}

	this.rmTop = function()
	{
		this.top = false;
	}

	this.getLeft = function()
	{
		return this.left;
	}

	this.rmLeft = function()
	{
		this.left = false;
	}
}