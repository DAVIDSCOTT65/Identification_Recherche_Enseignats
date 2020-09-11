<?php

require_once 'boostrap.php';

if ( ! isset($_SESSION['user'])) {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (sha1($_POST['password']) != $_SESSION['user']['password']) {
        $msg = 'Modifier annulée. Mot de passe actuel invalide';
    } else {
        if (isset($_POST['new_password'])) {
            $password = sha1($_POST['new_password']);
        } else {
            $password = $_SESSION['user']['password'];
        }

        if (isset($_FILES['photo'])) {
            if ( ! ($_FILES['photo']['error'] == 0 && strpos($_FILES['photo']['type'], 'image/') !== false)) {
                $msg = 'Photo invalide';
            } else {
                $file_parts = explode('/', $_FILES['photo']['type']);
                $filename = md5(microtime() . basename($_FILES['photo']['name'])) . '.' . $file_parts[1];

                unlink(__DIR__ . '/public/uploads/photo/' . $_SESSION['user']['photo']);
        
                move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/public/uploads/photo/' . $filename);
            }
        } else {
            $photo = $_SESSION['user']['photo'];
        }

        $sql = 'SELECT * FROM users WHERE username = "' . $_POST['username'] . '" AND password = "' . $_POST['password'] . '"';
        $exists = $db->query($sql)
                    ->fetch(\PDO::FETCH_COLUMN);

        if ($exists) {
            $msg = 'Cet utilisateur existe déjà';
        } else {
            if (! isset($msg)) {
                $sql = 'UPDATE users SET password = ?, photo = ?, username = ? WHERE id = ?';
                $i = $db->prepare($sql);
                $i->execute([
                    $password,
                    $photo,
                    $_POST['username'],
                    $_SESSION['user']['id']
                ]);

                $_SESSION['flash'] = 'Modification effectuée';
                header('Location:profile.php');
                exit();
            }
        }
        
    }
}

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Mise à jour<br>
            Profil
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="text-center mb-5">Mettez-vous à jour !</h1>
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
                        <label for="new_password">Nouveau mot de passe (Facultatif)</label>
                        <input placeholder="Nouveau mot de passe" type="password" name="new_password" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo (Facultatif)</label>
                        <input type="file" id="photo" name="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe actuel</label>
                        <input placeholder="Mot de passe" type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    
                    <div class="form-group submit-btn">
                        <input type="submit" value="MODIFIER" name="login" class="btn btn-lg btn-primary btn-block">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();
$title = ' - Profil';
$styles = '.Contact_sec {
    display: none;
}';

require  'template.php';
