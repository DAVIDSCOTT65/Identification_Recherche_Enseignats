<?php

require_once 'boostrap.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = 'SELECT * FROM users WHERE username = "' . $_POST['username'] . '" AND password = "' . sha1($_POST['password']) . '"';
    $result = $db->query($sql)->fetch(\PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION['user'] = $result;
        header('Location:index.php');
        exit();
    } else {
        $msg = 'Impossible de vous connecter.';
    }
}

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Espace<br>
            Ens. - Admins.
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="text-center mb-5">Connectez-vous !</h1>
                    <?php
                        if (isset($msg)):
                            echo '<p class="alert alert-danger">' . $msg . '</p>';
                        endif;
                    ?>
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" placeholder="Nom d'utilisateur" name="username" class="form-control form-control-lg form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input placeholder="Mot de passe" type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group submit-btn">
                        <input type="submit" value="CONNEXION" name="login" class="btn btn-lg btn-primary btn-block">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();
$title = ' - Connexion';
$styles = '.Contact_sec {
    display: none;
}';

require  'template.php';
