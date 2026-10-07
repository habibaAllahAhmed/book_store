<?php

/**
 * @var array $books
 */
?>
<div class="item2 p-2 pt-4 ">
    <div class="row">
        <?php
        if (!empty($books['data'])) {
            foreach ($books['data'] as $book) {

                $bookImg = ($book['image'] == null) ? asset('images/book.png') : asset("images/uploads/{$book['image']}");
                $shrotDesc = substr($book['description'], 0, 100);
                $buttonStock = "";

                if (isAuth('customer')) {
                    $buttonStock = "
            <div class='input-group'>
            <input type='number' min='1' class='form-control' placeholder='Quantity' id='input-quantity-{$book['id']}'>
  <button class='btn btn-outline-success' type='button' onclick='addToCart({$book['id']},this)' id='button-addon1'>Add to cart</button>
</div>
";
                }
                
                echo "
 <div class='col-lg-4 col-sm-6  books-items '>
                      <div class='books p-3  bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center' >
                          <img src='{$bookImg}' style='width: 6rem;' class=' mx-auto card-img-top'>
                          <div class='card-body pb-0'>
                              <h5 class='card-title mb-4'>{$book['title']}</h5>
                             <div class='row'>
                    <div class='col-5'>
                        <p> Author :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>{$book['author_name']}</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-5'>
                        <p>Description :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>{$shrotDesc}</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-5'>
                        <p>Price :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>{$book['price']}</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-5'>
                        <p>stock :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>{$book['stock']}</p>
                    </div>
                </div>
                {$buttonStock}
                          </div>
                      </div>
                  </div>


";
            }
        } else {
            echo "<p class='m-auto text-center alert alert-danger'>there are no books </p>";
        }

        ?>

    </div>
</div>


<?php
preparePagination($books, 'Books');
?>