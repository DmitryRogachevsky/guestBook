<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
require_once 'include_classes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оставить отзыв</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style0.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,regular,500,600,700" rel="stylesheet">
</head>
<body>
    <div class="container__reviews">
        <section class="give__feedback">
            <h2>Оставить отзыв</h2>
            <div class="wrapper">
                <?php
                $elemOD = new \OutputData();
                echo $elemOD->builtInputBlock();
                
                $elemDP = new \DataProcessing();
                $elemDB = new \Database();
                ?>
                
            </div>
        </section>
        <section class="all__reviews">
            <h2>Все отзывы</h2>
            <div class="wrapper">
                <div class="filters">
                    <form method="post">
                        <input type="submit" class="filter__one" name="filter__one" value="по дате по возрастанию" />
                        <input type="submit" class="filter__two" name="filter__two" value="по дате по убыванию" />
                    </form>
                </div>
                <?php
                if(isset($_POST['filter__two'])) {
                    echo $elemOD->buildOutputBlock('desc');
                } else {
                    echo $elemOD->buildOutputBlock('asc');
                }
                ?>
                
            </div>
        </section>
    </div>
</body>
</html>

