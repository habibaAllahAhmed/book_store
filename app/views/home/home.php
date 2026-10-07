<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/home/home.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/home/index.responsive.css"); ?>">
</head>

<body>

    <?php include __DIR__ . "/../components/navbar.php"; ?>

    <div id="carouselExampleIndicators" data-bs-ride="carousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="button active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="button " aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="button " aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 vh-100 d-flex align-items-center">
                            <div class="item">
                                <h5>Search book easily</h5>
                                <h2 class="h1">ISBN Search Feature</h2>
                                <p>search books using ISBn numbers or author names and save your time</p>
                                <button class="btn btn-success">Read now</button>
                            </div>
                        </div>
                        <div class="col-lg-6  vh-100 d-flex align-items-center">
                            <div class="item">
                                <img src="<?= asset("images/slide_1.png") ?>" class="img-fluid d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 vh-100 d-flex align-items-center">
                            <div class="item">
                                <h5>Search book easily</h5>
                                <h2 class="h1">ISBN Search Feature</h2>
                                <p>search books using ISBn numbers or author names and save your time</p>
                                <button class="btn btn-success">Read now</button>
                            </div>
                        </div>
                        <div class="col-lg-6  vh-100 d-flex align-items-center">
                            <div class="item">
                                <img src="<?= asset("images/slide_2.png") ?>" class="img-fluid d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 vh-100 d-flex align-items-center">
                            <div class="item">
                                <h5>Search book easily</h5>
                                <h2 class="h1">ISBN Search Feature</h2>
                                <p>search books using ISBn numbers or author names and save your time</p>
                                <button class="btn btn-success">Read now</button>
                            </div>
                        </div>
                        <div class="col-lg-6  vh-100 d-flex align-items-center">
                            <div class="item">
                                <img src="<?= asset("images/slide_3.png") ?>" class="img-fluid d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo asset("js/bootstrap.js") ?>"></script>
    <script src="<?php echo asset("js/jQuery.js") ?>"></script>
    <script src="<?php echo asset("js/home/index.js") ?>"></script>
</body>

</html>