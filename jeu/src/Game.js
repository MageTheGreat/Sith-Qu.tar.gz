function Game(viewSize,difficulty,zoomLevel,velocityScale,initialX,initialY,seed)
{
	this.viewSize = Number(viewSize);
	this.difficulty = Number(difficulty);
	this.zoomLevel = Number(zoomLevel);
	this.velocityScale = Number(velocityScale);
	this.initialX = Number(initialX);
	this.initialY = Number(initialY);
	this.seed = Number(seed);

	// Useful constants
	this.length = 2 * this.difficulty + 1;
	this.cellLength = this.viewSize / this.zoomLevel;
	this.mazeSize = this.length * this.cellLength;

	// Maze
	this.maze = [];
	// Player
	this.player = new Player(this.initialX,this.initialY,this.cellLength);

	this.init = function()
	{
		for(var i=0; i<this.length;i++)
		{
			this.maze.push([]);
			for(var j=0; j<this.length;j++)
			{
				this.maze[i].push(new Cell(i,j));
			}
		}

		this.generation(this.initialX,this.initialY);
	}

	this.show = function()
	{
  		background(200,20,20);
		noStroke();
		fill(25);
		rect(-this.player.x+this.viewSize/2,-this.player.y+this.viewSize/2,this.mazeSize,this.mazeSize);

		var currentCell = this.player.getPlayerCell();
		var activeCell;
		for(var i=0; i<100;i++)
		{
			for(var j=0; j<100;j++)
			{
				activeCell = this.getCell(i,j);
				if(activeCell)
				{
					activeCell.show(this.player.x-this.viewSize/2,this.player.y-this.viewSize/2,this.cellLength);
				}
			}
		}

		this.player.show(this);
		this.player.move(this);
	}

	this.getCell = function(i,j)
	{
		if(this.maze && i>=0 && i < this.maze.length && j >= 0 && j < this.maze.length)
		{
			return this.maze[i][j];
		}
		return undefined;
	}

	// Depth-first search algorithm
	this.generation = function(i,j)
	{
	  var search = [];
	  var current = this.maze[i][j];
	  var next;

	  do
	  {
	    next = current.visit(this);

	    if(!next)
	    {
	      current = search.pop();
	    } else
	    {
	      search.push(current);
	      current = next;
	    }
	  } while(search.length > 0)
	}
}