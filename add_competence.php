<?php

require_once 'boostrap.php';

if ( ! isset($_SESSION['user']) || $_SESSION['user']['role'] != 'ROLE_TEACHER') {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
}
// exit(var_dump($_SESSION['user']));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = 'INSERT INTO competences (domaine, id_enseignant, niveau_de_maitrise) VALUES(?, ?, ?)';
    $i = $db->prepare($sql);
    $i->execute([
        $_POST['domaine'],
        $_SESSION['user']['id_enseignant'],
        $_POST['niveau_de_maitrise'],
    ]);
    
    $_SESSION['flash'] = 'Compétence ajoutée';
    header('Location:add_competence.php');
    exit();
}

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Parlez de vos <br>Compétences
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="text-center mb-5">Ajoutez vos compétences</h1>
                    <?php
                        if (isset($msg)):
                            echo '<p class="alert alert-danger">' . $msg . '</p>';
                        endif;
                    ?>
                    <div class="form-group">
                        <label for="domaine">Domaine</label>
                        <input type="text" placeholder="Domaine" name="domaine" class="form-control form-control-lg form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="niveau_de_maitrise">Niveau de maîtrise</label>
                        <select name="niveau_de_maitrise" class="form-control form-control-lg" required>
                            <option value="Assez bien">Assez bien</option>
                            <option value="Bien">Bien</option>
                            <option value="Très bien">Très bien</option>
                        </select>
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
$title = ' - Ajout compétences';
$styles = '.Contact_sec {
    display: none;
}';

require  'template.php';
