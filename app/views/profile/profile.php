<?php
require_once __DIR__ . "/components/pagination.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?= ucfirst(auth('role')); ?></title>

    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/index.responsive.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/all.min.css"); ?>">
</head>

<body>

    <?php include __DIR__ . "/../components/navbar.php"; ?>


    <div id="Profile">

        <div class="container w-100 mt-5">
            <div class="row w-100">
                <div class="col-xl-3 content">
                    <div class="item">
                        <div class="card rounded-4 text-center" style="width: fit-content;">
                            <img src="<?php echo asset("images/admin.png"); ?>" class="w-25 mx-auto mt-4 card-img-top ">
                            <div class="card-body">
                                <h5 class=" mb-4 card-title"><i class="fa-regular fa-pen-to-square text-info"
                                        data-bs-toggle="modal" data-bs-target="#editName"></i>
                                    <?= auth('name') ?></h5>
                                <div class="row">
                                    <div class="col-4">
                                        <p><i class="fa-regular fa-pen-to-square text-info"
                                                data-bs-toggle="modal" data-bs-target="#editEmail"></i> Email :</p>
                                    </div>
                                    <div class="col-8 text-start">
                                        <p> <?= auth('email') ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p><i class="fa-regular fa-pen-to-square text-info"
                                                data-bs-toggle="modal" data-bs-target="#editPhone"></i> Phone :</p>
                                    </div>
                                    <div class="col-8 text-start">
                                        <p> <?= auth('phone') ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p><i class="fa-regular fa-pen-to-square text-info"
                                                data-bs-toggle="modal" data-bs-target="#editGender"></i>Gender :</p>
                                    </div>
                                    <div class="col-8 text-start">
                                        <p> <?= auth('gender') ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 p-0">
                                        <p><i class="fa-regular fa-pen-to-square text-info"
                                                data-bs-toggle="modal" data-bs-target="#editPassword"></i>Password</p>
                                    </div>
                                    <div class="col-8 text-start">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 rounded-4 content bg-light">

                    <?php

                    if (isAuth('admin')) {
                        include __DIR__ . "/components/admin_links.php";
                    } else if (isAuth('customer')) {
                        include __DIR__ . "/components/customer_links.php";
                    }
                    ?>



                </div>
            </div>
        </div>

    </div>

    <?php include __DIR__ . "/components/EditPopups.php" ?>
    <script src="<?php echo asset("js/sweetalerts.js") ?>"></script>
    <script src="<?php echo asset("js/bootstrap.js") ?>"></script>
    <script src="<?php echo asset("js/jQuery.js") ?>"></script>
    <script src="<?php echo asset("js/profile/profile.js") ?>"></script>
    <script src="<?php echo asset("js/profile/functions.js") ?>"></script>

    <?php

    if (isAuth('customer')) {
        echo "<script src='" . asset("js/profile/customer.js") . "'>
        </script>";
    }
    ?>
    <?php

    if (isAuth('admin')) {
        echo "<script src='" . asset("js/profile/admin.js") . "'>
        </script>";
    }
    ?>


    <script>
        <?php
        $editAlert = $_SESSION['editAlert'] ?? null;
        unset($_SESSION['editAlert']);
        ?>

        showAlert(<?= json_encode($editAlert) ?>);
    </script>

</body>

</html>