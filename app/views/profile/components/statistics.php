<?php

/**
 * @var array $total
 */
?>

<div class="row">
    <div class="col-lg-3 col-sm-6  col-md-4  col-md-4">
        <div class="admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center">
            <i class="fa-solid m-auto fa-book m-auto "></i>
            <p class="text-center mt-3">Total Books</p>
            <p class="text-center fw-bolder mb-0 text-success"><?= $total['books'] ?></p>
        </div>
    </div>

    <?php

    if (isAuth('admin')) {
        echo "
          <div class='col-lg-3 col-sm-6  col-md-4 '>
        <div class='admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center'>
            <i class='fa-solid fa-user-group m-auto '></i>
            <p class='text-center mt-3'>Total Authors</p>
            <p class='text-center fw-bolder mb-0 text-success'> {$total['authors']} </p>
        </div>
    </div>
    <div class='col-lg-3 col-sm-6  col-md-4 '>
        <div class='admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center'>
            <i class='fa-solid fa-users m-auto '></i>
            <p class='text-center mt-3'>Total customers</p>
            <p class='text-center fw-bolder mb-0 text-success'> {$total['customers']} </p>
        </div>
    </div>
    <div class='col-lg-3 col-sm-6  col-md-4 '>
        <div class='admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center'>
            <i class='fa-solid fa-pause m-auto '></i>
            <p class='text-center mt-3'>Total Admins</p>
            <p class='text-center fw-bolder mb-0 text-success'> {$total['admins']}</p>
        </div>
    </div>
        ";
    }

    ?>
    <?php

    if (isAuth('customer')) {
        echo "
          <div class='col-lg-3 col-sm-6  col-md-4 '>
        <div class='admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center'>
            <i class='fa-solid fa-user-group m-auto '></i>
            <p class='text-center mt-3'>Total Bought Books</p>
            <p class='text-center fw-bolder mb-0 text-success'> {$total['boughtBooks']} </p>
        </div>
    </div>
        ";
    }

    ?>

    <div class="col-lg-3 col-sm-6  col-md-4  col-md-4">
        <div class="admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center">
            <i class="fa-solid fa-users-gear m-auto "></i>
            <p class="text-center mt-3">Total Ordered Orders</p>
            <p class="text-center fw-bolder mb-0 text-success"><?= $total['orders']['ordered'] ?></p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6  col-md-4  col-md-4">
        <div class="admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center">
            <i class="fa-solid fa-ban m-auto "></i>
            <p class="text-center mt-3">Total Cancelled Orders</p>
            <p class="text-center fw-bolder mb-0 text-success"><?= $total['orders']['cancelled'] ?></p>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6  col-md-4  col-md-4">
        <div class="admins p-3 mb-4 card rounded-4 bg-primary-subtle text-primary-emphasis text-center">
            <i class="fa-solid fa-circle-check m-auto "></i>
            <p class="text-center mt-3">Total Done Orders</p>
            <p class="text-center fw-bolder mb-0 text-success"><?= $total['orders']['done'] ?></p>
        </div>
    </div>

</div>