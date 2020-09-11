<?php
require_once 'boostrap.php';

if (isset($_SESSION['user'])) {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
}

ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ( ! ($_FILES['photo']['error'] == 0 && strpos($_FILES['photo']['type'], 'image/') !== false)) {
        $msg = 'Photo invalide';
    } else {
        $file_parts = explode('/', $_FILES['photo']['type']);
        $filename = md5(microtime() . basename($_FILES['photo']['name'])) . '.' . $file_parts[1];

        move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/public/uploads/photo/' . $filename);

        $e = $db->prepare('INSERT INTO enseignants (noms, sexe, dob, anneeFinEtudes, filiereEtudes, grade, type, phoneNum, institutionAffiliee, email, type_piece_id, num_piece_id, photo, matricule) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $e->execute([
            $_POST['noms'],
            $_POST['sexe'],
            $_POST['dob'],
            $_POST['anneeFinEtudes'],
            $_POST['filiereEtudes'],
            $_POST['grade'],
            $_POST['type'],
            $_POST['phoneNum'],
            $_POST['institutionAffiliee'],
            $_POST['email'],
            $_POST['type_piece_id'],
            $_POST['num_piece_id'],
            $filename,
            $_POST['matricule'],
        ]);
    
        $_SESSION['flash'] = 'Votre demande a été envoyée.';
        header('Location:identification.php');
        exit();
    }
}

?>
<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Nous répondons dans l'heure
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-10 offset-1">
                <h1>IDENTIFICATION</h1>
                <?php
                    if (isset($msg)) {
                        echo '<div class="alert alert-danger">' . $msg . '</div>';
                    }
                ?>
                <div class="form-group">
                    <label for="noms">Noms</label>
                    <input type="text" id="noms" name="noms" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sexe">Sexe</label>
                    <select name="sexe" id="sexe" class="form-control">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Date de naissance</label>
                    <input type="date" max="2000-01-01" id="dob" name="dob" class="form-control">
                </div>
                <div class="form-group">
                    <label for="anneeFinEtudes">Année de fin d'études</label>
                    <select  id="anneeFinEtudes" name="anneeFinEtudes" class="form-control">
                        <?php
                            for ($i = 1950; $i < date('Y') - 1; $i++) {
                                echo "<option value=\"$i\">$i</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filiereEtudes">Filière d'études</label>
                    <input type="text" id="filiereEtudes" name="filiereEtudes" class="form-control">
                </div>
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <select id="grade" name="grade" class="form-control">
                        <option value="Professeur ordinaire">Professeur ordinaire</option>
                        <option value="Professeur emerite">Professeur emerite</option>
                        <option value="Assistant">Assistant</option>
                        <option value="Master">Master</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control">
                        <option disabled selected>Selectionnez un type</option>
                        <option value="Non payé">Non payé (NP)</option>
                        <option value="Nouvelle unité">Nouvelle unité (NU)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="matricule">Matricule</label>
                    <input type="text" readonly="true" id="matricule" name="matricule" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phoneNum">Téléphones</label>
                    <input type="text" id="phoneNum" name="phoneNum" class="form-control">
                </div>
                <div class="form-group">
                    <label for="institutionAffiliee">Institution affiliée</label>
                    <input type="text" id="institutionAffiliee" name="institutionAffiliee" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="type_piece_id">Type pièce d'identité</label>
                    <select id="type_piece_id" name="type_piece_id" class="form-control">
                        <option value="Carte d'électeur">Carte d'électeur</option>
                        <option value="Passeport">Passeport</option>
                        <option value="Carte de service">Carte de service</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="num_piece_id">Numéro pièce d'identité</label>
                    <input type="text" id="num_piece_id" name="num_piece_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Valider" class="btn btn-success btn-block">
                </div>
            </div>
        </form>
    </div>
</div>
                    

<?php

$content = ob_get_clean();
$title = ' - Identification';
$styles = '.Contact_sec {
    display: none;
}';
$scripts = '<script type="text/javascript">
    $("#type").on("change", function() {
        if ($(this).val() == "Non payé") {
            $("#matricule").removeAttr("readonly");
        } else {
            $("#matricule").val("");
            $("#matricule").attr("readonly", "true");
        }
    });
</script>';

$links = '';

require  'template.php';
