<?php

require_once 'boostrap.php';

if (isset($_GET['q'])) {
    $sql = 'SELECT E.* FROM enseignants E INNER JOIN competences C ON C.id_enseignant = E.id  WHERE domaine = "' . $_GET['q'] . '" AND valide = TRUE';
    $teachers = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);
} else {
    $sql = 'SELECT * FROM enseignants WHERE valide = TRUE';
    $teachers = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);
}

$sql = 'SELECT DISTINCT(domaine) FROM competences';
$competences = $db->query($sql)
                ->fetchAll(\PDO::FETCH_COLUMN);

ob_start();

?>

<div class="container-fluid" id="main">
<div class="col-sm-12" id="forms">
    <div class="col-sm-12 mt-5">
        <form action="" id="my_form" method="get" class="col-6 offset-3">
            <div class="form-group">
                <label for="search">Recherchez par domaine</label>
                <div class="row mt-2">
                    <div class="col-12">
                        <select name="q" id="search" class="form-control selectpicker" data-live-search="true">
                            <option value="" disabled selected></option>
                            <?php
                                foreach ($competences as $competence) {
                                    echo '<option value="'.$competence.'">'.$competence.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <?php
            if (isset($teachers)) {
        ?>
            <div class="row" id="bg">
                <div class="col-12 mb-5">
                    <div class="row">
                        <?php foreach ($teachers as $teacher) { ?>
                            <div class="col-2 p-3">
                                <div class="teacher p-3">
                                    <div class="text-center">
                                        <img src="public/uploads/photo/<?= $teacher['photo'] ?>" class="" alt="">
                                    </div>
                                    <div class="nd-part p-2 container-fluid">
                                        <h4 class="h5 text-bold"><?= substr($teacher['noms'], 0, 20) ?></h4>
                                        <span class="d-block mb-1"><?= $teacher['phoneNum'] ?></span>
                                        <a href="explore_teacher.php?id=<?= $teacher['id'] ?>">Plus de détails</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        
    </div>
</div>
</div>
<?php

$content = ob_get_clean();
$title = ' - teachers';
$styles = '#main {
    
    height: auto;
}
.nd-part {
    
}
.nd-part .h5 {
    font-weight: bold;
}
.nd-part a {
    color: orange;
}
.teacher {
    border: 1px solid #ddd;
    text-align: center;
    border-radius: 10px;
}
.teacher img {
    height: 200px !important;
}
';
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

$("#search").on("change", function () {
    $("#my_form").submit();
});
</script>
<script src="public/bootstrap-4.0.0-dist/js/bootstrap-select.min.js"></script>
';

$links = '<link rel="stylesheet" href="public/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="public/bootstrap-4.0.0-dist/css/bootstrap-select.min.css">';

require  'template.php';
