<?php

/**
 * @var array $customers
 */
?>

<div class="row">

    <?php
    if (!empty($customers['data'])) {
        foreach ($customers['data'] as $customer) {

            $customerImg = asset('images/customer.png');
            $isCustomerBanned = ($customer['is_banned']) ? "<span class='badge text-bg-danger position-absolute' style='top:10px; right : 10px '>banned</span>" : '';
            $isButtonBanned = ($customer['is_banned']) ? "<button class='btn btn-danger w-100' onclick='banUser({$customer['id']}, \"unban\")'>Unban</button>" :
                "<button class='btn btn-success w-100' onclick='banUser({$customer['id']}, \"ban\")'>Ban</button>";

            echo "
                        <div class='col-lg-4 col-sm-6 '>
                        <div class='p-3  bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center'  data-user-id='{$customer['id']}'>
                        {$isCustomerBanned}
                        <img src='{$customerImg}' style='width: 6rem;' class=' mx-auto card-img-top'>
                                <div class='card-body'>
                                <h5 class='card-title mb-4'>{$customer['name']}</h5>
                                <div class='row'>
                                    <div class='col-4'>
                                        <p> Email :</p>
                                    </div>
                                    <div class='col-8 text-start'>
                                        <p>{$customer['email']}</p>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-4'>
                                        <p>Gender :</p>
                                    </div>
                                    <div class='col-8 text-start'>
                                        <p>{$customer['gender']}</p>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-4'>
                                        <p>Phone :</p>
                                    </div>
                                    <div class='col-8 text-start'>
                                        <p>{$customer['phone']}</p>
                                    </div>
                                </div>
                                {$isButtonBanned}
                                </div>
                        </div>
                        </div>
                ";
        }
    } else {
        echo "<p class='m-auto text-center alert alert-danger'>there are no customers </p>";
    }

    ?>

</div>

<?php
preparePagination($customers, 'Customers');
?>