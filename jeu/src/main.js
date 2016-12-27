var canvas;
var cellSize;

function setup()
{
	cellSize = 100;
	canvas = new Canvas(500,maze,cellSize,12,10,5);
	window.addEventListener("beforeunload", function (e) {return "Etes-vous sûr de vouloir abandonner ?";});
}

function draw()
{
	canvas.update();
}

var end = function(infos)
{
	var form = document.createElement("FORM");
	form.action = "validation.php";
	form.method = "post"
	var input = document.createElement("INPUT");
	form.appendChild(input);
	input.type = "text";
	input.name = "parcours";
	input.value = infos;
	var input2 = document.createElement("INPUT");
	form.appendChild(input2);
	input2.type = "text";
	input2.name = "jeu";
	input2.value = "labysith";
	form.submit();
	noLoop();
}

var add = function(tab1,tab2)
{
	var tab = [];

	for(var i = 0; i<tab1.length; i++)
	{
		tab[i] = tab1[i] + tab2[i];
	}

	return tab;
}

var vMap = function(f,vec)
{
	return createVector(f(vec.x),f(vec.y));
}

var norme = function(v)
{
	return Math.sqrt(Math.pow(v[0],2)+Math.pow(v[1],2));
}

var mult = function(a,v)
{
	return fMap(function(x) {return a*x;},v);
}

var shuffleTab = function(tab)
{
	for(var i=tab.length-1; i>=0; i--)
	{
		j = Math.floor(random(0,i+1));
		temp = tab[i];
		tab[i] = tab[j];
		tab[j] = temp;
	}
}

var equals = function(v1,v2)
{
	return (v1[0] == v2[0]) && (v1[1] == v2[1]);
}

var arg = function(tab,elem)
{
	var i = 0;
	while(i<tab.length)
	{
		for(var j=0; j<tab[i].length; j++)
		{
			if(equals(elem,tab[i][j]))
			{
				return i;
			}
		}

		i++;
	}
}

var valInInterval = function(x,a,b)
{
	return x >= a && x < b;
}

var vecInInterval = function(vec,start,end)
{
	return valInInterval(vec[0],start[0],end[0]) && valInInterval(vec[1],start[1],end[1]); 
}