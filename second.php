<?php

$host = 'localhost';
$dbname = 'utilisateurs_db';
$user = 'root'; 
$pass = '';   

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $terms = isset($_POST["terms"]);

    if (!$terms) {
        $error = "Veuillez accepter les conditions d'utilisation.";
    } else {
        
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
        
            header("Location: quatrieme.php");
            exit();
        } else {
            $error = "E-mail ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>login</title>
</head>
<body style="background-color: #F5F5DC; color: #A52A2A;">
    <h1 style="text-align: center;">Bienvenue</h1>

    <div style="width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; text-align: center;">
        <img src="88.jpg" alt="User Icon" style="width: 50px; height: 50px;"> 
        <br><br>
        <form id="loginForm">
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" style="width: 250px;" required><br><br>

            <label for="password">Mot de passe:</label><br>
            <input type="password" id="password" name="password" style="width: 250px;" required><br><br>

            <label>
                <input type="checkbox" id="terms">
                J'accepte les <a href="#" style="color: #A52A2A;">conditions d'utilisation</a>
            </label><br><br>

            <div id="errorMsg" style="color: red;"></div>

            <div style="color: red;"><?php echo $error; ?></div>

            <input type="submit" value="Envoyer">
            <input type="reset" value="Effacer">
        </form>
        <br>
       
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const errorMsg = document.getElementById('errorMsg');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const termsAccepted = document.getElementById('terms').checked;

            const passwordValid = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^_-])[A-Za-z\d@$!%*#?&^_-]{9,}$/.test(password);

            if (!termsAccepted) {
                errorMsg.textContent = "Veuillez accepter les conditions d'utilisation.";
            } else if (!passwordValid) {
                errorMsg.textContent = "Le mot de passe doit contenir au moins 9 caractères, y compris lettres, chiffres et symboles.";
            } else {
                errorMsg.textContent = "";
                
                window.location.href = "quatrieme.html"; 
            }
        });
    </script>
</body>
</html>
