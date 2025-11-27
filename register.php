<?php
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=system_db;charset=utf8", "root", "");
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

$kayıt_basarili = false;
$user = [];

if ($_POST) {
    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $school = htmlspecialchars($_POST["school_number"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check = $db->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() == 0) {

        $add = $db->prepare("INSERT INTO users (name, surname, school_number, email, password) VALUES (?,?,?,?,?)");
        $add->execute([$name, $surname, $school, $email, $password]);

        $user = [
            "name" => $name,
            "surname" => $surname,
            "school_number" => $school,
            "email" => $email
        ];
        $kayıt_basarili = true;

    } else {
        $hata = "Bu e-posta zaten kayıtlı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Kayıt Ol</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div id="particles-js"></div>

<div class="card">

<?php if (!$kayıt_basarili) { ?>

<h2>Kayıt Ol</h2>

<?php if (!empty($hata)) { ?>
    <p style="color:red;"><?= $hata ?></p>
<?php } ?>

<form method="POST">
    <input type="text" name="name" placeholder="Ad" required>
    <input type="text" name="surname" placeholder="Soyad" required>
    <input type="text" name="school_number" placeholder="Okul No" required>
    <input type="email" name="email" placeholder="E-posta" required>
    <input type="password" name="password" placeholder="Şifre" required>
    <button type="submit">Kayıt Ol</button>
</form>

<?php } else { ?>

<h2>Kayıt Başarılı!</h2>
<p><b>Ad:</b> <?= $user["name"] ?></p>
<p><b>Soyad:</b> <?= $user["surname"] ?></p>
<p><b>Okul No:</b> <?= $user["school_number"] ?></p>
<p><b>E-posta:</b> <?= $user["email"] ?></p>
<p><b>Kayıt Tarihi:</b> <?= date("Y-m-d H:i") ?></p>
<p><b>Son Giriş:</b> Henüz giriş yapılmadı</p>

<?php } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", { "particles": { "number": { "value": 90 }, "size": { "value": 3 }, "move": { "speed": 1.5 }, "line_linked": { "enable": true, "opacity": 0.2 } } });
</script>

</body>
</html>
