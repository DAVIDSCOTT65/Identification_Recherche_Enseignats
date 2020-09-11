<?php

require_once 'boostrap.php';

if ( ! isset($_SESSION['user']) || $_SESSION['user']['role'] != 'ROLE_TEACHER') {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['photo'])) {
        if ( ! ($_FILES['photo']['error'] == 0 && strpos($_FILES['photo']['type'], 'image/') !== false)) {
            $msg = 'Photo invalide';
        } else {
            $file_parts = explode('/', $_FILES['photo']['type']);
            $filename = md5(microtime() . basename($_FILES['photo']['name'])) . '.' . $file_parts[1];
    
            move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/public/uploads/publication/' . $filename);
        }
    } else {
        $filename = '';
    }
    
    $sql = 'INSERT INTO publications (domaine, id_enseignant, photo, titre, annee, resume) VALUES(?, ?, ?, ?, ?, ?)';
    $i = $db->prepare($sql);
    $i->execute([
        $_POST['domaine'],
        $_SESSION['user']['id_enseignant'],
        $filename,
        $_POST['titre'],
        $_POST['annee'],
        $_POST['resume'],
    ]);

    $_SESSION['flash'] = 'Publication ajoutée';
    header('Location:add_publication.php');
    exit();
}

$sql = 'SELECT * FROM competences WHERE id_enseignant = ' . $_SESSION['user']['id_enseignant'];
$competences = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Ajouter une <br>publication
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" enctype="multipart/form-data">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="text-center mb-5">Boostez vos publications !</h1>
                    <?php
                        if (isset($msg)):
                            echo '<p class="alert alert-danger">' . $msg . '</p>';
                        endif;
                    ?>
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" placeholder="Titre" name="titre" class="form-control form-control-lg form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="annee">Année de publication</label>
                        <input type="date" name="annee" max="<?= date('Y-m-d') ?>" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="domaine">Domaine</label>
                        <select name="domaine" class="form-control form-control-lg" required>
                            <?php
                                foreach ($competences as $competence) {
                                    echo '<option value="' . $competence['domaine'] . '">' .$competence['domaine'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="resume">Résumé</label>
                        <textarea placeholder="resume" name="resume" class="form-control form-control-lg form-control-lg" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo (Facultatif)</label>
                        <input type="file" id="photo" name="photo" class="form-control">
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
$title = ' - Publication';
$styles = '.Contact_sec {
    display: none;
}';

require  'template.php';
