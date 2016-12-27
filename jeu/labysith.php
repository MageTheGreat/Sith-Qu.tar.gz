
<?php
	function MapWPa($array,$param)
	{
		$res = array();
		foreach ($array as $value)
		{
			$v = in_array($param,$value);
			array_push($res,$v);
		}
		return $res;
	}

	$seed = 1;
	$difficulty = 30;

	srand($seed);

	$maze = array();
	$sets = array();
	$walls = array();

	for($i=0; $i<$difficulty;$i++)
	{
		array_push($maze,[]);
		for($j=0; $j<$difficulty;$j++)
		{
			array_push($walls,array('x' => $i, 'y' => $j, 'direction' => "top"));
			array_push($walls,array('x' => $i, 'y' => $j, 'direction' => "left"));
			array_push($sets,array(array('x' => $i, 'y' => $j)));
			array_push($maze[$i],array('top' => true,'left' => true));
		}
	}

	shuffle($walls);

	for($i=0; $i<count($walls); $i++)
	{
		$wall = $walls[$i];
		$x = $wall['x'];
		$y = $wall['y'];

		switch($wall['direction'])
		{
			case "top":
				if($y>0)
				{
					$cell = array('x' => $x, 'y' => $y);
					$top = array('x' => $x, 'y' => $y-1);
					$keys1 = array_keys(MapWPa($sets,$cell),true);
					$keys2 = array_keys(MapWPa($sets,$top),true);
					$a1 = array_pop($keys1);
					$a2 = array_pop($keys2);
					if($a1 != $a2)
					{
						$sets[$a1] = array_merge($sets[$a1],$sets[$a2]);
						array_splice($sets,$a2,$length = 1);
						$maze[$x][$y]['top'] = false;
					}
				}
				break;
			case "left":
				if($x>0)
				{
					$cell = array('x' => $x, 'y' => $y);
					$left = array('x' => $x-1, 'y' => $y);
					$keys1 = array_keys(MapWPa($sets,$cell),true);
					$keys2 = array_keys(MapWPa($sets,$left),true);
					$a1 = array_pop($keys1);
					$a2 = array_pop($keys2);
					if($a1 != $a2)
					{
						$sets[$a1] = array_merge($sets[$a1],$sets[$a2]);
						array_splice($sets,$a2,$length = 1);
						$maze[$x][$y]['left'] = false;
					}
				}
				break;
			default:
				break;
		}
	}

	addParticipation("labysith");
?>
<div id="sketch-holder"></div> <!-- Emplacement du jeu -->
<script language="javascript" type="text/javascript" src="jeu/libraries/p5.js"></script>
<script language="javascript" type="text/javascript" src="jeu/libraries/p5.dom.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Cell.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Player.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Maze.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Canvas.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Control.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Graphics.js"></script>
<script language="javascript" type="text/javascript" src="jeu/src/Algorithm.js"></script>
<script language="javascript" type="text/javascript">
<?php
	echo "var maze = [];";
	for($i=0; $i<$difficulty; $i++)
	{
		echo "maze.push([]);";
		for($j=0; $j<$difficulty; $j++)
		{
			echo "var c = new Cell();";
			if(! $maze[$i][$j]['top'])
			{
				echo "c.rmTop();";
			}
			if(! $maze[$i][$j]['left'])
			{
				echo "c.rmLeft();";
			}
			echo "maze[".$i."].push(c);";
		}
	}
?>
</script>
<script language="javascript" type="text/javascript" src="jeu/src/main.js"></script>