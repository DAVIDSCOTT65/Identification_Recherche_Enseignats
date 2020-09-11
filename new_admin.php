<?php

require_once 'boostrap.php';

if ( ! isset($_SESSION['user']) || $_SESSION['user']['role'] != 'ROLE_SUPER_ADMIN') {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = 'SELECT * FROM users WHERE username = "' . $_POST['username'] . '" AND password = "' . sha1($_POST['password']) . '"';
    $exists = $db->query($sql)
                ->fetch(\PDO::FETCH_COLUMN);
    if ($exists) {
        $msg = 'Cet utilisateur existe déjà';
    } else {
        if (isset($_FILES['photo'])) {
            if ( ! ($_FILES['photo']['error'] == 0 && strpos($_FILES['photo']['type'], 'image/') !== false)) {
                $msg = 'Photo invalide';
            } else {
                $file_parts = explode('/', $_FILES['photo']['type']);
                $filename = md5(microtime() . basename($_FILES['photo']['name'])) . '.' . $file_parts[1];
        
                move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/public/uploads/photo/' . $filename);
        
                $e = $db->prepare('INSERT INTO users (username, password, photo, role) VALUES(?, ?, ?, "ROLE_ADMIN")');
        
                $e->execute([
                    $_POST['username'],
                    sha1($_POST['password']),
                    $filename,
                ]);
        
                $_SESSION['flash'] = 'Utilisateur ajouté';
            }
        } else {
            $e = $db->prepare('INSERT INTO users (username, password, role) VALUES(?, ?, "ROLE_ADMIN")');
        
            $e->execute([
                $_POST['username'],
                sha1($_POST['password']),
            ]);
    
            $_SESSION['flash'] = 'Utilisateur ajouté';
        }
    }
}

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Création admin
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="text-center mb-5">Complétez les détails de connexion !</h1>
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
                    <div class="form-group">
                        <label for="photo">Photo (facultatif)</label>
                        <input type="file" name="photo" class="form-control form-control-lg">
                    </div>
                    <div class="form-group submit-btn">
                        <input type="submit" value="AJOUTER" name="login" class="btn btn-lg btn-primary btn-block">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();
$title = ' - Creation admin';
$styles = '.Contact_sec {
    display: none;
}';

require  'template.php';
