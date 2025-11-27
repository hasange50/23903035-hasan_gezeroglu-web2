<?php
header("Location: login.php");
exit;
?>

<!-- Particles.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 40,
      "density": { "enable": true, "value_area": 800 }
    },
    "color": { "value": ["#6a00ff", "#b200ff", "#ff00dd"] },
    "shape": {
      "type": "circle"
    },
    "opacity": {
      "value": 0.35,
      "random": true
    },
    "size": {
      "value": 12,
      "random": true
    },
    "line_linked": {
      "enable": false
    },
    "move": {
      "enable": true,
      "speed": 1.2,
      "direction": "none",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": false
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": { "enable": true, "mode": "grab" },
      "onclick": { "enable": true, "mode": "push" }
    },
    "modes": {
      "grab": { "distance": 150, "line_linked": { "opacity": 0.4 } },
      "push": { "particles_nb": 4 }
    }
  },
  "retina_detect": true
});
</script>