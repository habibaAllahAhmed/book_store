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
                <?php
                if (isAuth('admin')) {
                    echo "<th>options</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty($orders['ordered']['data'])) {
                foreach ($orders['ordered']['data'] as $order) {

                    $additionalCol = "";

                    if (isAuth('admin')) {
                        $additionalCol = "<td>
                                <div class='buttons d-flex flex-nowrap'>
                                    <button class='btn text-light me-3 btn-danger'  onclick='cancelOrder({$order['id']} , this)'>Cancelled</button>
                                    <button class='btn btn-success'  onclick='doneOrder({$order['id']} , this)'>Done</button>
                                </div>
                            </td>";
                    }

                    echo "
            <tr class='tr'>
                <th>{$order['id']}</th>
                <td>{$order['user_name']}</td>
                <td>{$order['total_price']}</td>
                <td><a href='#' onclick='getItemsIntoCart({$order['id']} , \"showOrder\")'>show</a></td>
                <td>{$order['created_at']}</td>
                {$additionalCol}
            </tr>
";
                }
            } else {
                echo "<p class='m-auto mb-3 text-center alert alert-danger'>there are no ordered orders </p>";
            }

            ?>

        </tbody>
    </table>
</div>

<?php
preparePagination($orders['ordered'], 'Ordered');
?>