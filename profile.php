<?php
session_start(); // 🔥 BUNU UNUTURSAN LOGIN’E ATAR

include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$q = $db->prepare("SELECT * FROM users WHERE id = ?");
$q->execute([$user_id]);
$user = $q->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Profilim</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div id="particles-js"></div>

<div class="card" style="max-width: 500px; text-align:left;">

    <h2 style="text-align:center;">Profil Bilgilerim</h2>

    <p><b>Ad:</b> <?= $user["name"] ?></p>
    <p><b>Soyad:</b> <?= $user["surname"] ?></p>
    <p><b>Okul No:</b> <?= $user["school_number"] ?></p>
    <p><b>E-posta:</b> <?= $user["email"] ?></p>
    <p><b>Son Giriş:</b> <?= $user["last_login"] ?></p>

    <div class="dashboard-links">
        <a href="dashboard.php">Geri Dön</a>
        <a href="logout.php">Çıkış Yap</a>
    </div>
</div>

<!-- Particles.js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", {
    particles: { number: { value: 80 }, size: { value: 3 }, move: { speed: 1.3 }, line_linked: { enable: true, opacity: 0.2 } }
});
</script>

</body>
</html>
