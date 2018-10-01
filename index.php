<?php
session_start();

if(isset($_SESSION['log']))
{
    include 'menu_admin.php';
    ?>
    <div class="row">
    <div class="col-12 text-center mt-5">
        <h1 class="pt-5 titre"> GestPro </h1><br>
        <h4 class="mb-5 sous_titre"> Solutions Projets </h4>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-6">
            <h6 class="para1"> Premier paragraphe </h6>
            <p >Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Eum porro molestiae,
                totam fugit dolorem facilis obcaecati
                aperiam consectetur ipsa dolore aspernatur
                impedit ab, delectus quo assumenda eius fugiat
                nisi nihil. totam fugit dolorem facilis obcaecati
                aperiam consectetur ipsa dolore aspernatur
                impedit ab, delectus quo assumenda eius fugiat
                nisi nihil.
            </p>
        </div>
        <div class="col-12 col-md-6">
            <h6 class="para1"> Deuxieme paragraphe </h6>
            <p >Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Eum porro molestiae,
                totam fugit dolorem facilis obcaecati
                aperiam consectetur ipsa dolore aspernatur
                impedit ab, delectus quo assumenda eius fugiat
                nisi nihil. totam fugit dolorem facilis obcaecati
                aperiam consectetur ipsa dolore aspernatur
                impedit ab, delectus quo assumenda eius fugiat
                nisi nihil.
            </p>
        </div>
    </div>
</div>
<?php
}
else{
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"> 
    <link rel="stylesheet" href="css/evaluation.css">
    <title> Evaluation </title>
</head>

<body>
    <?php
include 'menu.php';
?>

    <div class="row">
        <div class="col-12 text-center mt-5">
            <h1 class="pt-5 titre"> GestPro </h1><br>
            <h4 class="mb-5 sous_titre"> Solutions Projets </h4>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <h6 class="para1"> Premier paragraphe </h6>
                <p >Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Eum porro molestiae,
                    totam fugit dolorem facilis obcaecati
                    aperiam consectetur ipsa dolore aspernatur
                    impedit ab, delectus quo assumenda eius fugiat
                    nisi nihil. totam fugit dolorem facilis obcaecati
                    aperiam consectetur ipsa dolore aspernatur
                    impedit ab, delectus quo assumenda eius fugiat
                    nisi nihil.
                </p>
            </div>
            <div class="col-12 col-md-6">
                <h6 class="para1"> Deuxieme paragraphe </h6>
                <p >Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Eum porro molestiae,
                    totam fugit dolorem facilis obcaecati
                    aperiam consectetur ipsa dolore aspernatur
                    impedit ab, delectus quo assumenda eius fugiat
                    nisi nihil. totam fugit dolorem facilis obcaecati
                    aperiam consectetur ipsa dolore aspernatur
                    impedit ab, delectus quo assumenda eius fugiat
                    nisi nihil.
                </p>
            </div>
        </div>
    </div>
    <?php 
    }  
    include 'footer.php';   
    ?>
</body>

</html>