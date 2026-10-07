<?php

/**
 * @var array $orders
 */
?>


<div class='table-responsive'>
    <table class='table rounded-3 overflow-hidden px-4 table-info table-striped table-hover'>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Total price</th>
                <th>Details</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty($orders['cancelled']['data'])) {
                foreach ($orders['cancelled']['data'] as $order) {
                    echo "
            <tr>
                <th>{$order['id']}</th>
                <td>{$order['user_name']}</td>
                <td>{$order['total_price']}</td>
                <td><a href='#' onclick='getItemsIntoCart({$order['id']} , \"showOrder\")'>show</a></td>
                <td>{$order['created_at']}</td>
            </tr>

";
                }
            } else {
                echo "<p class='m-auto mb-3 text-center alert alert-danger'>there are no canceled orders </p>";
            }

            ?>

        </tbody>
    </table>
</div>



<?php
preparePagination($orders['cancelled'], 'Cancelled');
?>