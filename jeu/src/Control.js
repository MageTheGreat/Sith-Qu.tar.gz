function Control(maze,cellSize,wallSize,playerSize,playerSpeed)
{
	this.maze = new Maze(maze,cellSize,wallSize);
	var len = ((maze.length+1)*cellSize)/2;
	this.player = new Player(len,len,playerSize,playerSpeed);

	this.keys = [false,false,false,false];
	window.addEventListener('keydown',
		function(e)
		{
			var m = {37:3,38:0,39:1,40:2};
			canvas.keyDown(m[e.keyCode]);
			switch(e.keyCode)
			{
				case 37: case 38: case 39: case 40:
					e.preventDefault();
					break;
				default:
					break;
			}
		}, false);
	window.addEventListener('keyup',
		function(e)
		{
			var m = {37:3,38:0,39:1,40:2};
			canvas.keyUp(m[e.keyCode]);
		}, false);
	this.keyDown = function(key)
	{
		this.keys[key] = true;
	}
	this.keyUp = function(key)
	{
		this.keys[key] = false;
	}

	this.update = function()
	{
		var direction = [Number(this.keys[1])-Number(this.keys[3]),Number(this.keys[2])-Number(this.keys[0])];
		this.player.move(this.checkMoves(direction));
		if(this.maze.finished(this.player.getPosition()))
		{
			end(this.player.getSearch());
		}
	}

	this.show = function(size)
	{
		this.maze.show(this.player.getPosition(),size);
		this.player.show();
	}

	this.checkMoves = function(direction)
	{
		var currPos = this.player.getPosition();
		var dir = createVector(direction[0],direction[1]);
		var mag = dir.mag();

		var target;
		if(mag == 0)
		{
			target = currPos;
		} else
		{
			target = p5.Vector.add(currPos,p5.Vector.mult(dir,this.player.getSpeed()/mag));
		}

		var cellRef = vMap(Math.floor,p5.Vector.mult(currPos,1/this.maze.getCellSize()));
		var delta = this.player.getSize()+this.maze.getWallSize()/5;

		this.checkTop(target,cellRef,delta);
		this.checkRight(target,cellRef,delta);
		this.checkBottom(target,cellRef,delta);
		this.checkLeft(target,cellRef,delta);

		var celltarget = vMap(Math.floor,p5.Vector.mult(target,1/this.maze.getCellSize()));
		var move = "";
		switch(p5.Vector.sub(celltarget,cellRef).array())
		{
			case [0,-1]:
				move = "";
				break;
			case [1,0]:
				move = "";
				break;
			case [0,1]:
				move = "";
				break;
			case [-1,0]:
				move = "";
				break;
			default:
				break;
		}

		return [target,move];
	}

	this.checkTop = function(target,cellRef,delta)
	{
		cell = this.maze.getCell(cellRef);
		if(cell.getTop())
		{
			target.set(target.x,max(this.maze.getCellSize()*cellRef.y+delta,target.y));
		}
	}

	this.checkRight = function(target,cellRef,delta)
	{
		rightCell = this.maze.getCell(p5.Vector.add(cellRef,createVector(1,0)));
		if(!rightCell || rightCell.getLeft())
		{
			target.set(min(this.maze.getCellSize()*(cellRef.x+1)-delta,target.x),target.y);
		}
	}

	this.checkBottom = function(target,cellRef,delta)
	{
		bottomCell = this.maze.getCell(p5.Vector.add(cellRef,[0,1]));
		if(!bottomCell || bottomCell.getTop())
		{
			target.set(target.x,min(this.maze.getCellSize()*(cellRef.y+1)-delta,target.y));
		}
	}

	this.checkLeft = function(target,cellRef,delta)
	{
		cell = this.maze.getCell(cellRef);
		if(cell.getLeft())
		{
			target.set(max(this.maze.getCellSize()*cellRef.x+delta,target.x),target.y);
		}
	}
}