function Player(initialX,initialY,cellLength)
{
	this.x = initialX*cellLength+cellLength/2;
	this.xVelocity = 0;
	this.y = initialY*cellLength+cellLength/2;
	this.yVelocity = 0;
	this.xCell = initialX;
	this.yCell = initialY;
	this.r = cellLength/4;

	this.show = function(game)
	{
		noStroke();
		fill(0,255,0);
		ellipse(game.viewSize/2,game.viewSize/2,this.r,this.r);
	}

	this.getPlayerCell = function()
	{
		return [this.xCell,this.yCell];
	}

	this.move = function(game)
	{
		var currentCell = game.getCell(this.xCell,this.yCell);
		var adjCell;

		if(this.xVelocity === 1)
		{
			if(this.x+game.velocityScale+this.r/2 < (this.xCell+1)*game.cellLength)
			{
				this.x += game.velocityScale;
			} else
			{
				adjCell = game.getCell(this.xCell+1,this.yCell);
				if(adjCell && !adjCell.left)
				{
					this.x += game.velocityScale;
					this.xCell += 1;
				} else
				{
					this.x = this.xCell*game.cellLength+game.cellLength-this.r/2;
				}
			}
		} else if(this.xVelocity === -1)
		{
			if(this.x-game.velocityScale-this.r/2>this.xCell*game.cellLength)
			{
				this.x -= game.velocityScale;
			} else
			{
				adjCell = game.getCell(this.xCell-1,this.yCell);
				if(adjCell && !currentCell.left)
				{
					this.x -= game.velocityScale;
					this.xCell -= 1;
				} else
				{
					this.x = this.xCell*game.cellLength+this.r/2;
				}
			}
		}

		if(this.yVelocity === 1)
		{
			if(this.y+game.velocityScale+this.r/2<this.yCell*game.cellLength+game.cellLength)
			{
				this.y += game.velocityScale;
			} else // Cell edge
			{
				adjCell = game.getCell(this.xCell,this.yCell+1);
				if(adjCell && !adjCell.top)
				{
					this.y += game.velocityScale;
					this.yCell += 1;
				} else
				{
					this.y = this.yCell*game.cellLength+game.cellLength-this.r/2;
				}
			}
		} else if(this.yVelocity === -1)
		{
			if(this.y-game.velocityScale-this.r/2>this.yCell*game.cellLength)
			{
				this.y -= game.velocityScale;
			} else
			{
				adjCell = game.getCell(this.xCell,this.yCell-1);
				if(adjCell && !currentCell.top)
				{
					this.y -= game.velocityScale;
					this.yCell -= 1;
				} else
				{
					this.y = this.yCell*game.cellLength+this.r/2;
				}
			}
		}
	}

	this.stop = function()
	{
		this.moveX(0);
		this.moveY(0);
	}

	this.moveX = function(dir)
	{
		this.xVelocity = dir;
	}

	this.moveY = function(dir)
	{
		this.yVelocity = dir;
	}
}