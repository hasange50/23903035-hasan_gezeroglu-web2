<?php 
include "db.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Giriş Yap</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div id="particles-js"></div>

<div class="card">

<h2>Giriş Yap</h2>

<form method="POST">
    <input type="email" name="email" placeholder="E-posta" required>
    <input type="password" name="password" placeholder="Şifre" required>
    <button type="submit">Giriş</button>
</form>

<a href="register.php">Hesap oluştur</a>

<?php
if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $db->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $update = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $update->execute([$user["id"]]);

        $_SESSION["user_id"] = $user["id"];

        header("Location: dashboard.php");
        exit;

    } else {
        echo "<p style='color:red;'>E-posta veya şifre hatalı!</p>";
    }
}
?>

</div>

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

</body>
</html>
