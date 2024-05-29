<?php
$title = "WebRunners - Login";
ob_start();

$pdo = getDatabaseConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['isLogged'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo 'Identifiants incorrects.';
    }
}
?>
<body class="sub_page">
    </div>
  
<!---------------------------------------->
<?php

include('../includes/section/login_section.php');

$content = ob_get_clean();
include '../template/layout.php';
