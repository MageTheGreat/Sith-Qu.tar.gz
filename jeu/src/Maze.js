function Maze(maze,cellSize,wallSize)
{
	this.grid = maze;
	this.end = createVector(0,0);
	this.tick = 0;
	this.cellSize = cellSize;
	this.wallSize = wallSize;

	this.getLength = function()
	{
		return this.grid.length;
	}

	this.getCellSize = function()
	{
		return this.cellSize;
	}

	this.getWallSize = function()
	{
		return this.wallSize;
	}

	this.getCell = function(v)
	{
		if(vecInInterval(v.array(),[0,0],[this.getLength(),this.getLength()]))
		{
			return this.grid[v.x][v.y];	
		}
	}

	this.show = function(pos,size)
	{
		var center = vMap(Math.floor,p5.Vector.div(pos,this.cellSize));
		var delta = Math.floor(size/(2*this.cellSize)+2);
		var screenPos = p5.Vector.sub(createVector(width/2,height/2),pos);

		for(var i = -delta; i < delta; i++)
		{
			for(var j = -delta; j < delta; j++)
			{
				var current = p5.Vector.add(center,createVector(i,j));
				if(vecInInterval(current.array(),[0,0],[this.getLength(),this.getLength()]))
				{
					fill(42);
					var A = p5.Vector.add(p5.Vector.mult(current,this.cellSize),screenPos);
					rect(A.x,A.y,this.cellSize+1,this.cellSize+1);
				}
			}
		}
		for(var i = -delta; i < delta; i++)
		{
			for(var j = -delta; j < delta; j++)
			{
				var current = p5.Vector.add(center,createVector(i,j));
				if(vecInInterval(current.array(),[0,0],[this.grid.length,this.grid.length]))
				{
					var cell = this.grid[current.x][current.y];

					stroke(0);
					strokeCap(ROUND);
					strokeWeight(this.wallSize);
					if(cell.getTop())
					{
						this.drawTop(current,screenPos);
					}
					if(cell.getLeft())
					{
						this.drawLeft(current,screenPos);
					}
				}
			}
		}

		var B = p5.Vector.add(createVector(this.cellSize*this.getLength(),0),screenPos);
		var C = p5.Vector.add(createVector(0,this.cellSize*this.getLength()),screenPos);
		var D = p5.Vector.add(createVector(this.cellSize*this.getLength(),this.cellSize*this.getLength()),screenPos);
		line(B.x,B.y,D.x,D.y);
		line(C.x,C.y,D.x,D.y);
		this.showEnd(screenPos);
	}

	this.drawTop = function(current,screenPos)
	{
		this.drawLine(current,screenPos,createVector(1,0));
	}

	this.drawLeft = function(current,screenPos)
	{
		this.drawLine(current,screenPos,createVector(0,1));
	}

	this.drawLine = function(current,screenPos,vec)
	{
		var A = p5.Vector.add(p5.Vector.mult(current,this.cellSize),screenPos);
		var B = p5.Vector.add(p5.Vector.mult(vec,this.cellSize),A);
		line(A.x,A.y,B.x,B.y);
	}

	this.showEnd = function(screenPos)
	{
		var O = p5.Vector.add(p5.Vector.mult(this.end,this.cellSize),p5.Vector.add(screenPos,[this.cellSize/2,this.cellSize/2]));
		this.tick++;
		noFill();
		strokeWeight(5);
		stroke(15,150,15,map(60-(this.tick%60),0,60,0,255));
		ellipse(O.x,O.y,this.tick%60,this.tick%60);
		stroke(15,150,15,map(60-((this.tick+30)%60),0,60,0,255));
		ellipse(O.x,O.y,(this.tick+30)%60,(this.tick+30)%60);
	}

	this.finished = function(pos)
	{
		return vMap(Math.floor,p5.Vector.div(pos,this.cellSize)).equals(this.end);
	}
}