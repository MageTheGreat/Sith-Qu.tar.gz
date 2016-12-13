function Cell(i,j)
{
	this.i = i;
	this.j = j;
	this.top = true;
	this.left = true;
	this.visited = false;

	this.showTop = function(x,y,cellLength)
	{
		stroke(255);
		line(this.i*cellLength-x,this.j*cellLength-y,(this.i+1)*cellLength-x,this.j*cellLength-y);
	}

	this.showLeft = function(x,y,cellLength)
	{
		stroke(255);
		line(this.i*cellLength-x,this.j*cellLength-y,this.i*cellLength-x,(this.j+1)*cellLength-y);
	}

	this.show = function(x,y,cellLength)
	{
		if(this.top)
		{
			this.showTop(x,y,cellLength);
		}
		if(this.left)
		{
			this.showLeft(x,y,cellLength);
		}
	}

	this.visit = function(game)
	{
		this.visited = true;

		var neighbors = [];

		var top = game.getCell(this.i,this.j-1);
		if(top && !top.isVisited())
		{
			neighbors.push([top,8]);
		}

		var right = game.getCell(this.i+1,this.j);
		if(right && !right.isVisited())
		{
			neighbors.push([right,6]);
		}

		var bottom = game.getCell(this.i,this.j+1);
		if(bottom && !bottom.isVisited())
		{
			neighbors.push([bottom,2]);
		}

		var left = game.getCell(this.i-1,j);
		if(left && !left.isVisited())
		{
			neighbors.push([left,4]);
		}

		var next = neighbors[floor(random(0,neighbors.length))];
		if(next)
		{
			switch(next[1])
			{
				case 8:
					this.top = false;
					break;

				case 4:
					this.left = false;
					break;

				case 6:
					next[0].left = false;
					break;

				case 2: 
					next[0].top = false;
					break;
			}				
			return next[0];	
		}
		return undefined;
	}

	this.isVisited = function()
	{
		return this.visited;
	}
}