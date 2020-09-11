<?php

require_once 'boostrap.php';

if ( ! isset($_GET['id'])) {
    header('Location:search.php');
}

$sql = 'SELECT * FROM enseignants WHERE id = ' . $_GET['id'];
$teacher = $db->query($sql)
                ->fetch(\PDO::FETCH_ASSOC);
if ( ! $teacher) {
    header('Location:search.php');
}

$sql = 'SELECT * FROM competences WHERE id_enseignant = ' . $_GET['id'];
$competences = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM publications WHERE id_enseignant = ' . $_GET['id'];
$publications = $db->query($sql)
                ->fetchAll(\PDO::FETCH_ASSOC);

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            <?= $teacher['noms'] ?>
            <div class="text-left pl-5">
                <h1 class="mt-5 pl-0">Compétences</h1>
                <ul class="list-group-item-info">
                    <?php
                        foreach ($competences as $competence) {
                            echo '<li class="h4 p-3 comp">' . $competence['domaine'] . ' ('. $competence['niveau_de_maitrise'] .')</li>';
                        }
                    ?>
                </ul>
            </div>
            
        </div>
  
        <form method="post" id="form" class="col-sm-6 p-5" method="post">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="mb-5 pl-0">Publications<?php if (isset($_SESSION['user'])) {
                    echo '<a href="print_card.php?id=' . $teacher['id'] . '" class="pull-right small" id="print">Imprimer carte</a>';
                } ?></h1>
                    <div class="row">
                        <?php foreach ($publications as $publication) { ?>
                            <div class="col-12 p-3 publication">
                                <div class="row align-items-center">
                                    <div class="text-center col-2">
                                        <img src="public/uploads/publication/<?= $publication['photo']? $publication['photo']: '145859.png' ?>" class="" alt="">
                                    </div>
                                    <div class="nd-part col-10 p-2 container-fluid">
                                        <h4 class="h5 text-bold"><?= $publication['titre'] ?></h4>
                                        <span class="d-block mb-1"><?= $publication['resume'] ?></span>
                                        <span class="d-block mb-1">
                                            <?= $publication['domaine'] ?>,
                                            <?= $publication['annee'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();
$title = ' - ' . $teacher['noms'];
$styles = '.Contact_sec {
    display: none;
}
div .comp {
    border-top: 1px solid white !important;
    list-style-type: none;
}
#form-img {
    padding-top: 10vh;
}
.text-bold {
    font-weight: bold;
}
.publication {
    border: 1px solid #ddd;
    margin-bottom: 20px;
    border-radius: 10px;
}
#print {
    font-size: 15px;
    padding: 16px 12px !important;
    border-radius: 50px;
    cursor: pointer;
    border: 1px dotted #333;
}
';

require  'template.php';
