var dfsAlgo = function(seed,length)
{
	randomSeed(seed);

	var maze = [];
	for(var i=0; i<length;i++)
	{
		maze.push([]);
		for(var j=0; j<length;j++)
		{
			maze[i].push({cell: new Cell(), visited : false});
		}
	}

	var search = [];
	var current = [0,0];
	var last = current.slice();

	do
	{
		maze[current[0]][current[1]].visited = true;

		var neighborough = fMap(function(direction){ return add(current,direction); },[[0,-1],[1,0],[0,1],[-1,0]]);
		var neighbors = [];

		if(current[1]>0 && !maze[neighborough[0][0]][neighborough[0][1]].visited)
		{
			neighbors.push([neighborough[0],"top"]);
		}
		if(current[0]<length-1 && !maze[neighborough[1][0]][neighborough[1][1]].visited)
		{
			neighbors.push([neighborough[1],"right"]);
		}
		if(current[1]<length-1 && !maze[neighborough[2][0]][neighborough[2][1]].visited)
		{
			neighbors.push([neighborough[2],"bottom"]);
		}
		if(current[0]>0 && !maze[neighborough[3][0]][neighborough[3][1]].visited)
		{
			neighbors.push([neighborough[3],"left"]);
		}

		var next = neighbors[Math.floor(random(0,neighbors.length))];

		if(!next)
		{
			current = search.pop();
		} else
		{
			search.push(current);
			switch(next[1])
			{
				case "top":
					maze[current[0]][current[1]].cell.rmTop();
					break;
				case "right":
					maze[next[0][0]][next[0][1]].cell.rmLeft();
					break;
				case "bottom":
					maze[next[0][0]][next[0][1]].cell.rmTop();
					break;
				case "left":
					maze[current[0]][current[1]].cell.rmLeft();
					break;
				default:
					break;
			}
			current = next[0];
			last = current.slice();
		}

	} while(search.length > 0)

	return [fMap(function(col) { return fMap(function(elem) { return elem.cell; }, col); }, maze),last];
}

var kruskAlgo = function(seed,length)
{
	randomSeed(seed);

	var maze = [];
	var sets = [];
	var walls = [];

	for(var i=0; i<length;i++)
	{
		maze.push([]);
		for(var j=0; j<length;j++)
		{
			var topWall = [i,j,"top"];
			walls.push(topWall);
			var leftWall = [i,j,"left"];
			walls.push(leftWall);
			sets.push([[i,j]]);
			maze[i].push(new Cell());
		}
	}

	shuffleTab(walls);

	for(var wall of walls)
	{
		var x = wall[0];
		var y = wall[1];
		switch(wall[2])
		{
			case "top":
				if(y>0)
				{
					a1 = arg(sets,[x,y]);
					a2 = arg(sets,[x,y-1]);
					if(a1 != a2)
					{
						sets[a1] = sets[a1].concat(sets[a2]);
						sets.splice(a2,1);
						maze[x][y].rmTop();
					}	
				}
				break;
			case "left":
				if(x>0)
				{
					a1 = arg(sets,[x,y]);
					a2 = arg(sets,[x-1,y]);
					if(a1 != a2)
					{
						sets[a1] = sets[a1].concat(sets[a2]);
						sets.splice(a2,1);
						maze[x][y].rmLeft();
					}	
				}
				break;
			default:
				break;
		}
	}
	
	return [maze,[0,0]];
}