<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$db = new PDO('mysql:host=localhost;dbname=minesures;port=3308;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Logout made possible everywhere
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location:index.php');
}

if (isset($_POST['subscribe'])) {
    $phone = '+243' . ltrim(trim($_POST['subscription_phone']), '0');
    if (strlen($phone) != 13) {
        $_SESSION['flash'] = 'Ce numéro est invalide.';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }

    $exists = $db->query('SELECT COUNT(*) FROM subscriptions WHERE phone = "' . $phone . '"')
                ->fetch(\PDO::FETCH_COLUMN);
            
    
    if ( ! $exists) {
        $sql = 'INSERT INTO subscriptions (phone) VALUES("'. $phone .'")';
        $db->exec($sql);
        $_SESSION['flash'] = 'Merci pour l\'inscription. Dès maintenant vous recevrez les notifications sur les crimes.';
    } else {
        $_SESSION['flash'] = 'Vous êtes déjà inscrit.';
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

$sql = 'SELECT COUNT(*) FROM enseignants WHERE valide = FALSE';
$unvalidated_teachers = $db->query($sql)->fetch(\PDO::FETCH_COLUMN);

?>
