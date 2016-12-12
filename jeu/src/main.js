var settings;
var game;
var canvas;
var parent;

var up;
var right;
var down;
var left;

function setup()
{
  var keys = {};
  window.addEventListener('keydown',
      function(e){
          keys[e.keyCode] = true;
          switch(e.keyCode){
              case 37: case 39: case 38:  case 40: // Arrow keys
              case 32: e.preventDefault(); break; // Space
              default: break; // do not block other keys
          }
      },
  false);
  window.addEventListener('keyup',
      function(e){
          keys[e.keyCode] = false;
      },
  false);

  // Set the in-page content size and position
  var canvas = createCanvas(0, 0); // size
  canvas.parent('sketch-holder'); // position

  // Settings interface
  var settingsHTML = '<p id="settings" onkeypress="return submitDetection(event)">';
  settingsHTML += 'Taille : <input id="viewSize" value="400"></input></br>';
  settingsHTML += 'Difficulté : <input id="difficulty" value="5"></input></br>';
  settingsHTML += 'Zoom : <input id="zoomLevel" value="6"></input></br>';
  settingsHTML += 'Vitesse du joueur : <input id="velocityScale" value="5"></input></br>';
  settingsHTML += 'Case départ (abscisse) : <input id="initialX" value="5"></input></br>';
  settingsHTML += 'Case départ (ordonnée) : <input id="initialY" value="5"></input></br>';
  settingsHTML += 'Graine : <input id="seed" value="0"></input></br>';
  settingsHTML += '<button type="submit" id="submit">Générer !</button></p>';

  settings = document.createElement("div");
  settings.innerHTML = settingsHTML;
  parent = document.getElementById('sketch-holder');
  parent.appendChild(settings);

  // Initial state
  var button = select('#submit');
  button.mousePressed(createMaze);
  up = false;
  right = false;
  down = false;
  left = false;
  noLoop();
}

function createMaze()
{
  // Current seed access
  var seed = Number(select('#seed').value());
  randomSeed(seed);

  // new instance of maze
  game = new Game(Number(select('#viewSize').value()),
                  Number(select('#difficulty').value()),
                  Number(select('#zoomLevel').value()),
                  Number(select('#velocityScale').value()),
                  Number(select('#initialX').value()),
                  Number(select('#initialY').value()),
                  seed);
  game.init();

  // adapt the canvas to the maze
  resizeCanvas(game.viewSize,game.viewSize);
  var margin = document.body.clientWidth - game.viewSize;
  canvas.style = "margin-left:"+String(margin/2)+"px;margin-right:"+String(margin/2)+";"

  // remove settings interface
  parent.removeChild(settings);


  // Run the game
  loop();
}

// Automatically called function to run the game (by default it's looping, see frameRate parameter and loop/noLoop functions)
function draw()
{
  if(game)
  {
    game.show();
  }
}

// Events
function keyPressed()
{
  if(keyCode === UP_ARROW)
  {
    up = true;
    game.player.moveY(-1);
  } else if(keyCode === RIGHT_ARROW)
  {
    right = true;
    game.player.moveX(1);
  } else if(keyCode === DOWN_ARROW)
  {
    down = true;
    game.player.moveY(1);
  } else if(keyCode === LEFT_ARROW)
  {
    left = true;
    game.player.moveX(-1);
  }
}

function keyReleased()
{
  if(keyCode === UP_ARROW)
  {
    up = false
    game.player.moveY(Number(down));
  } else if(keyCode === RIGHT_ARROW)
  {
    right = false;
    game.player.moveX(-1*Number(left));
  } else if(keyCode === DOWN_ARROW)
  {
    down = false;
    game.player.moveY(-1*Number(up));
  } else if(keyCode === LEFT_ARROW)
  {
    left = false;
    game.player.moveX(Number(right));
  }
}

function submitDetection(event)
{
  if(event.keyCode === ENTER)
  {
    createMaze();
  }
}