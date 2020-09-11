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

ob_start();

?>

<div class="container-fluid" id="main">
    <div class="row align-items-center">
        <div class="col-sm-6 align-items-center text-center" id="form-img">
            Impression<br>Carte            
        </div>
  
        <div id="form" class="col-sm-6 p-5">
            <div class="row">
                <div class="col-10 offset-1">
                    <h1 class="mb-5 pl-0"><?= $teacher['noms'] ?></h1>
                
                    <?php
                        $d = new \DateTime($teacher['dob']);
                    ?>
                    
                    <div id="idCard" class="col-12 p-4">
                        <div class="row align-items-center">
                            <div class="col-3 logo">
                                <img src="public/img/logo_esu.png">
                            </div>
                            <div class="col-7">
                                <span class="float-righ" style="position: absolute; top: 0px; right: -65px;">
                                    Num id: <?= (int) microtime(true) ?>
                                </span>
                                <p id="postFullName" class="h3 m-0 ml-5">MINESURES</p>
                                <span style="color: #eee;">Ministère des études supérieures</span>
                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-8">
                                        <b class="d-block">Nom & Prénom</b>
                                        <p class="data"><?= $teacher['noms'] ?></p>
                                        <b class="d-block">Grade</b>
                                        <p class="data"><?= $teacher['grade'] ?></p>
                                    </div>
                                    <div class="col-4 p-0">
                                        <img id="barcode" class="img-fluid" />
                                    </div>
                                    <div class="col-3">
                                        <b class="d-block">Age</b>
                                        <p class="data"><?= date('Y') - $d->format('Y') ?> ans</p>
                                    </div>
                                    <div class="col-4">
                                        <b class="d-block">Téléphone</b>
                                        <p class="data"><?= $teacher['phoneNum'] ?></p>
                                        
                                    </div>
                                    <div class="col-4 offset-1">
                                        <b class="d-block">Type</b>
                                        <p class="data"><?= $teacher['type'] ?></p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-4">
                                <img src="public/uploads/photo/<?= $teacher['photo'] ?>" class="img-teacher pull-right">
                            </div>
                        </div>
                    </div>
                    <button id="print-now" class="rounded mt-4 btn-lg btn-block rounded-3 btn btn-primary">Imprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();
$title = ' - ' . $teacher['noms'] . ' Carte';
$styles = '.Contact_sec {
    display: none;
}
#idCard {
    border: 3px solid #000;
    background-color: #303469;
    background-image: linear-gradient(#303469, #339983);
    border-radius: 20px;
    color: #fff;
}
#idCard .logo img {
    width: 50px !important;
    height: 50px !important;
    padding: 2px;
    background: #d1d1d6;
    border-radius: 10px;
}
.data {
    color: orange;
    text-transform: uppercase;
    font-weight: bold;
}
.img-teacher {
    height: 120px;
    padding: 4px;
    background: #d1d1d6;
    border-radius: 7px;
}
#postFullName {
    font-family: roboto, sans-serif;
}
';
$links = '';

$scripts = '<script src="public/lindell-JsBarcode-v3.11.0-17-g31373e0/lindell-JsBarcode-31373e0/dist/JsBarcode.all.min.js"></script>
<script>
    $("#barcode").JsBarcode("' . $teacher['matricule'] . '", {
        displayValue: false,
        background: "rgb(48, 57, 106)",
        lineColor: "#fff"
    });
    $("#print-now").click(function() {
        var divElements = $("#idCard").html();
        var oldPage = document.body.innerHTML;
        var head = $("head").html();
        console.log(head);
        document.body.innerHTML = "<html>"+head+"<body>"+ divElements +"</body></html>";

        window.print();

        document.body.innerHTML = oldPage;
    });
</script>';

require  'template.php';
