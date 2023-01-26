<!DOCTYPE html>
<html lang="en">
<head>
  <title> Nick Spokes </title>
  <meta charset="UTF-8">
  <link rel="icon" type="image/svg+xml" href="img/js.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link href="css/thanks-message.css" rel="stylesheet">
</head>

<!-- Links to other pages -->

<body>
  <div class="content">
    <div id="section2">
      <h1 id ="hh">&nbsp;</h1>
    </div>

    <div class="w3-display-container w3-opacity-min">
        <div class="w3-display-middle" style="white-space:nowrap;">
          <span class="w3-center w3-padding-large w3-dark-grey w3-xlarge w3-wide w3-animate-opacity">Your message was sent, I'll respond soon! </span>
        </div>
    </div>
    
    <canvas id="canvas1"></canvas>
  </div>
  <script>
const canvas = document.getElementById("canvas1");
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let particlesArray;

let mouse = {
    x: null,
    y: null,
    radius: (canvas.height/80) * (canvas.width/80)
}

window.addEventListener('mousemove',
    function(event) {
        mouse.x = event.x;
        mouse.y = event.y;
    }
);

// class for particle

class Particle {
    constructor(x, y, directionX, directionY, size, color) {
        this.x = x;
        this.y = y;
        this.directionX = directionX;
        this.directionY = directionY;
        this.size = size;
        this.color = color;
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI*2, false);
        ctx.fillStyle = '#ffff';
        ctx.fill();
    }

    update() {
        if (this.x > canvas.width || this.x < 0) {
            this.directionX = -this.directionX;
        }
        if (this.y > canvas.height || this.y < 0) {
            this.directionY = -this.directionY;
        }
        // check collision
        let dx = mouse.x - this.x;
        let dy = mouse.y - this.y;
        let distance = Math.sqrt(dx*dx + dy*dy);
        let rad = 4;
        if (distance < mouse.radius + this.size) {
            if (mouse.x < this.x && this.x < canvas.width - this.size * rad) {
                this.x += rad;
            }
            if (mouse.x > this.x && this.x > this.size * rad) {
                this.x -= rad;
            }
            if (mouse.y < this.y && this.y < canvas.height - this.size * rad) {
                this.y += rad;
            }
            if (mouse.y > this.y && this.y > this.size * rad) {
                this.y -= rad;
            }
        }
        //move particle
        this.x += this.directionX;
        this.y += this.directionY;
        this.draw();

    }
    
}

function init() {
    particlesArray = [];
    let numberOfParticles = (canvas.height * canvas.width) / 9000;
    for (let i = 0; i < numberOfParticles; i++) {
        let size = (Math.random() * 5) + 1;
        let x = (Math.random() * ((innerWidth -size * 2) - (size * 2)) + size*2);
        let y = (Math.random() * ((innerHeight -size * 2) - (size * 2)) + size*2);
        let directionX = (Math.random() * 5) -2.5;
        let directionY = (Math.random() * 5) -2.5;
        let color = "#ffff";
        particlesArray.push(new Particle(x, y, directionX, directionY, size, color));

    }
}

//check if close enough to connect
function connect() {
    let op = 1;
    for (let a = 0; a < particlesArray.length; a++) {
        for (let b = 0; b < particlesArray.length; b++) {
            let distance = (( particlesArray[a].x) - particlesArray[b].x) * (particlesArray[a].x - particlesArray[b].x) + ((particlesArray[a].y - particlesArray[b].y) * (particlesArray[a].y - particlesArray[b].y));
            if (distance < (canvas.width/7) * (canvas.height/7)) {
                op = 1 - (distance/20000)
                ctx.strokeStyle='rgba(255,255,255,'+ op+ ')';
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
                ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
                ctx.stroke();
            }
        }
    }
}


//animate

function animate() {
    requestAnimationFrame(animate);
    ctx.clearRect(0,0,innerWidth,innerHeight);
    for (let i = 0; i < particlesArray.length; i++) {
        particlesArray[i].update();
    }
    connect();
}

window.addEventListener('resize',
    function() {
        canvas.width = innerWidth;
        canvas.height = innerHeight;
        mouse.radius = ((canvas.height/80)*(canvas.height/80));
        init();
    }
);

window.addEventListener('mouseout',
    function() {
        mouse.x = undefined;
        mouse.y = undefined;
    }
)

init();
animate();



</script>
  <script src="js/time.js"></script>
</body>

</html>
<?php
    if (!is_null($_POST['Email'])) {
        $headers = 'From: notifications@nickspokes.com'."\r\n".'Reply-To: '.$_POST['Email']."\r\n".'X-Mailer: PHP/'.phpversion();
        mail('nick@nickspokes.com', $_POST['Name'], $_POST['Message'], $headers);
    }
?>