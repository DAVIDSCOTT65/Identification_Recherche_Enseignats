<?php

require_once 'boostrap.php';

if ( ! isset($_SESSION['user']) || $_SESSION['user']['id_enseignant']) {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
    exit();
}

if (isset($_GET['delete'])) {
    $sql = 'DELETE FROM enseignants WHERE id = ?';
    $i = $db->prepare($sql);
    $i->execute([$_GET['delete']]);
    $_SESSION['flash'] = 'Suppression effectuée.';
    header('Location:validate_teachers.php');
    exit();
}

if (isset($_GET['confirm'])) {
    $sql = 'UPDATE enseignants SET valide = TRUE WHERE id = ?';
    $i = $db->prepare($sql);
    $i->execute([$_GET['confirm']]); 

    $sql = 'SELECT * FROM enseignants WHERE id = ' . $_GET['confirm'];
    $teacher = $db->query($sql)->fetch(\PDO::FETCH_ASSOC);

    $password = substr(md5(microtime(true)), 0, 8);
    $username = substr(md5(microtime(true)), 0, 5);

    $_SESSION['id'] = ['username' => $username, 'password' => $password];
    
    $body = 'Username: ' . $username . ', Mot de passe: ' . $password;
    @mail($teacher['email'], 'Login sur MINESURES', $body);

    $sql = 'INSERT INTO users (username, password, id_enseignant, photo, role) VALUES(?, ?, ?, ?, "ROLE_TEACHER")';
    $i = $db->prepare($sql);
    $i->execute([
        $username,
        sha1($password),
        $_GET['confirm'],
        $teacher['photo'],
    ]); 

    header('Location:validate_teachers.php');
}

$sql = 'SELECT * FROM enseignants WHERE valide = FALSE';
$teachers = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

if ( ! $teachers) {
    header('Location:index.php');
}

ob_start();
?>

<div class="container-fluid" id="main">
<div class="col-sm-12" id="forms">
    <div class="col-sm-12">
        <h1 class="mb-4">Demandes d'identification</h1>
        <div class="table-responsive">
            
            <table class="table display" id="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Photo</th>
                        <th>Noms</th>
                        <th>Sexe</th>
                        <th>Date de naissance</th>
                        <th>Année fin études</th>
                        <th>Filière études</th>
                        <th>Grade</th>
                        <th>Type</th>
                        <th>Num. tél</th>
                        <th>Institution affiliée</th>
                        <th>Type de id</th>
                        <th>Num. de id</th>
                        <th>Matricule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($teachers as $key => $teacher):
                    ?>
                            <tr>
                                <td><?= ($key + 1) ?></td>
                                <td><img style="height: 70px" src="public/uploads/photo/<?= $teacher['photo']?>" alt=""/></td>
                                <td><?= $teacher['noms']?></td>
                                <td><?= $teacher['sexe'] ?></td>
                                <td><?= $teacher['dob'] ?></td>
                                <td><?= $teacher['anneeFinEtudes'] ?></td>
                                <td><?= $teacher['filiereEtudes'] ?></td>
                                <td><?= $teacher['grade'] ?></td>
                                <td><?= $teacher['type'] ?></td>
                                <td><?= $teacher['phoneNum'] ?></td>
                                <td><?= $teacher['institutionAffiliee'] ?></td>
                                <td><?= $teacher['type_piece_id'] ?></td>
                                <td><?= $teacher['num_piece_id'] ?></td>
                                <td><?= $teacher['matricule'] ?></td>
                                <?= isset($_SESSION['user'])? '<td><a href="#" aria-id="' . $teacher['id'] . '" class="btn btn-sm btn-danger">Supprimer</a><a href="#" aria-id="' . $teacher['id'] . '" class="btn btn-sm btn-primary">Confirmer</a></td>': '' ?>
                            </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php

$content = ob_get_clean();
$title = ' - Validation enseignants';

$scripts = '
<script src="public/dataTables/datatables.min.js"></script>
<script type="text/javascript">
$("#table").DataTable();

$("td .btn-danger").click(function(e) {
    if (confirm("Voulez-vous supprimer cette demande ?")) {
        document.location.href = "?delete=" + $(this).attr("aria-id");
    } else {
        e.preventDefault();
    }
});

$("td .btn-primary").click(function(e) {
    if (confirm("Voulez-vous enregistrer cette demande ?")) {
        document.location.href = "?confirm=" + $(this).attr("aria-id");
    } else {
        e.preventDefault();
    }
});

</script>
';

$styles = '#main {
    margin-top: 150px !important;
}';

$links = '<link rel="stylesheet" href="public/datatables-bs4/css/dataTables.bootstrap4.min.css">';

require  'template.php';
