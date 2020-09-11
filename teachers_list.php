<?php

namespace Psr\SimpleCache;

interface CacheInterface {}

interface InvalidArgumentException extends CacheInterface {}

require_once 'boostrap.php';

if ( ! isset($_SESSION['user']) || $_SESSION['user']['role'] == 'ROLE_TEACHER') {
    $_SESSION['flash'] = 'Vous ne pouvez pas accéder à ce lien.';
    header('Location:index.php');
    exit();
}

if (isset($_GET['type'])) {
    if ( ! in_array($_GET['type'], ['Nouvelle unité', 'Non payé'])) {
        $type = 'Non payé';
    } else {
        $type = $_GET['type'];
    }
} else {
    $type = 'Non payé';
}

$sql = 'SELECT * FROM enseignants WHERE valide = TRUE AND type = "' . $type . '"';

$teachers = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);

spl_autoload_register(function($class_name) {
    $preg_match = preg_match('/^PhpOffice\\\PhpSpreadsheet\\\/', $class_name);
    if (1 === $preg_match) {
        // exit(var_dump($class_name));
        $class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
        require_once (__DIR__ . '/lib/' . $class_name . '.php');
    }
});

spl_autoload_register(function($class_name) {
    $preg_match = preg_match('/^Psr\\\\/', $class_name);
    if (1 === $preg_match) {
        // $class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
        // require_once (__DIR__ . '/../PHPOffice/src/PhpSpreadsheet/' . $class_name . '.php')
    } else if (false === $preg_match) {
        assert(false,  'Erreur de preg_match');
    }
});

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if (isset($_GET['generate_xls'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValueByColumnAndRow(1, 1, 'Noms');
    $sheet->setCellValueByColumnAndRow(2, 1, 'Matricule');
    $sheet->setCellValueByColumnAndRow(3, 1, 'Sexe');
    $sheet->setCellValueByColumnAndRow(4, 1, 'Date de naissance');
    $sheet->setCellValueByColumnAndRow(5, 1, 'Année fin d\études');
    $sheet->setCellValueByColumnAndRow(6, 1, 'Filière d\'études');
    $sheet->setCellValueByColumnAndRow(7, 1, 'Type');
    $sheet->setCellValueByColumnAndRow(8, 1, 'Numéro de téléphone');
    $sheet->setCellValueByColumnAndRow(9, 1, 'Institution affiliée');
    $sheet->setCellValueByColumnAndRow(10, 1, 'Email');
    $sheet->setCellValueByColumnAndRow(11, 1, 'Type pièce d\'identité');
    $sheet->setCellValueByColumnAndRow(12, 1, 'Num. pièce d\'identité');

    require_once 'boostrap.php';
    
    $line = 2;
    foreach ($teachers as $teacher) {
        $sheet->setCellValueByColumnAndRow(1, $line, $teacher['noms']);
        $sheet->setCellValueByColumnAndRow(2, $line, $teacher['matricule']);
        $sheet->setCellValueByColumnAndRow(3, $line, $teacher['sexe']);
        $sheet->setCellValueByColumnAndRow(4, $line, $teacher['dob']);
        $sheet->setCellValueByColumnAndRow(5, $line, $teacher['anneeFinEtudes']);
        $sheet->setCellValueByColumnAndRow(6, $line, $teacher['filiereEtudes']);
        $sheet->setCellValueByColumnAndRow(7, $line, $teacher['type']);
        $sheet->setCellValueByColumnAndRow(8, $line, $teacher['phoneNum']);
        $sheet->setCellValueByColumnAndRow(8, $line, $teacher['institutionAffiliee']);
        $sheet->setCellValueByColumnAndRow(8, $line, $teacher['email']);
        $sheet->setCellValueByColumnAndRow(8, $line, $teacher['type_piece_id']);
        $sheet->setCellValueByColumnAndRow(8, $line, $teacher['num_piece_id']);
        $line++;
    }

    $writer = new Xls($spreadsheet);

    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=teachers_goma.xls');
    header('Pragma: no-cache');
    header('Expires: 0');

    $writer->save('php://output');
}

if (isset($_GET['delete'])) {
    $sql = 'DELETE FROM enseignants WHERE id = ' . (int) $_GET['delete'];
    $db->exec($sql);
}

ob_start();

?>

<div class="container-fluid" id="main">
    <form method="get" class="col-6 offset-3 mt-5">
        <div class="row align-items-center">
            <div class="col-9">
                <label for="type">Trier par type d'enseignants</label>
                <select name="type" class="form-control" id="type">
                    <option <?= $type == 'Non payé'? 'selected': '' ?> value="Non payé">Non payé (NP)</option>
                    <option <?= $type != 'Non payé'? 'selected': '' ?> value="Nouvelle unité">Nouvelle unité (NU)</option>
                </select>
            </div>
            <div class="col-3">
                <input type="submit" value="Modifier" class="btn btn-lg btn-success">
            </div>
        </div>
        
    </form>
<div class="col-sm-12" id="forms">
    <div class="col-sm-12">
        <h1>Tous nos enseignants<span class="pull-right small" id="print">Format excel</span></h1>
        <div class="table-responsive" class="mt-5">
            
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
                                <td>
                                    <a href="#" aria-id="<?= $teacher['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                                    <a href="explore_teacher?id=<?= $teacher['id'] ?>" class="btn btn-sm btn-primary">Explorer</a>
                                </td>
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
$title = ' - teachers';
$styles = '#print {
    font-size: 15px;
    padding: 16px 12px !important;
    border-radius: 10px;
    cursor: pointer;
    border: 1px dotted #333;
}

.null {
    font-size: 20px;
    text-align: center;
    width: 100%;
    display: block;
    font-weight: bold;
}';
$scripts = '
<script src="public/dataTables/datatables.min.js"></script>
<script type="text/javascript">
$("#table").DataTable();

$(".btn-danger").click(function(e) {
    if (confirm("Voulez-vous supprimer ce teacher ?")) {
        document.location.href = "?delete=" + $(this).attr("aria-id");
    } else {
        e.preventDefault();
    }
});

$("#print").click(function() {
    document.location.href = "?generate_xls=1";
});
</script>
';

$links = '<link rel="stylesheet" href="public/datatables-bs4/css/dataTables.bootstrap4.min.css">';

require  'template.php';
