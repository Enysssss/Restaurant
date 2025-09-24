<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - Traînée Fluide</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        margin: 0;
        height: 100vh;
        background-color: #000;
        overflow: hidden;
        cursor: none;
    }

    .center-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        text-align: center;
    }

    .btn-lg {
        width: 200px;
        margin-bottom: 20px;
    }

    /* Canvas pour les particules */
    canvas {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        z-index: 1;
    }
</style>
</head>
<body>

<div class="center-content">
    <a href="{{ route('formUser') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
    <a href="{{ route('formLogin') }}" class="btn btn-outline-light btn-lg">Sign In</a>
</div>

<canvas id="trailCanvas"></canvas>

<script>
const canvas = document.getElementById('trailCanvas');
const ctx = canvas.getContext('2d');
let width = canvas.width = window.innerWidth;
let height = canvas.height = window.innerHeight;

const particles = [];
const numParticles = 50;

let mouse = { x: width / 2, y: height / 2 };

// Génère des particules initiales
for(let i=0; i<numParticles; i++){
    particles.push({
        x: mouse.x,
        y: mouse.y,
        vx: 0,
        vy: 0,
        alpha: 1
    });
}

document.addEventListener('mousemove', e => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
});

function animate(){
    ctx.fillStyle = 'rgba(0,0,0,0.15)'; // effet de fondu pour traînée
    ctx.fillRect(0,0,width,height);

    for(let i=0; i<particles.length; i++){
        let p = particles[i];
        // décalage vers la souris avec easing
        p.vx += (mouse.x - p.x) * 0.1;
        p.vy += (mouse.y - p.y) * 0.1;
        p.vx *= 0.7; // friction
        p.vy *= 0.7;

        p.x += p.vx;
        p.y += p.vy;

        ctx.beginPath();
        ctx.arc(p.x, p.y, 5, 0, Math.PI*2);
        ctx.fillStyle = `rgba(255,255,255,${0.5 + Math.random()*0.5})`;
        ctx.fill();
    }

    requestAnimationFrame(animate);
}

animate();

// ajuste le canvas à la taille de la fenêtre
window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
