<?php

/**
 * @var array $authors
 */
?>


<div class="row">

    <?php

    if (!empty($authors['data'])) {
        foreach ($authors['data'] as $author) {

            $authorImg = asset('images/author.png');
            $shrotBio = substr($author['bio'], 0, 100);
            echo "
 <div class='col-lg-4 col-sm-6 col-xl-4'>
                        <div class='authors p-3  bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center' style=''>
                          <img src='{$authorImg}' style='width: 6rem;' class=' mx-auto card-img-top'>
                            <div class='card-body'>
                                <h5 class='card-title mb-4'>{$author['name']}</h5>
                                <div class='row'>
                                    <div class='col-4'>
                                        <p> Bio :</p>
                                  </div>
                                    <div class='col-8 text-start'>
                                        <p>{$shrotBio}...</p>
                                    </div>
                                <button class='btn btn-success' onclick='openAddBookPopup({$author['id']} , \"{$author['name']}\")'  data-bs-toggle='modal' data-bs-target='#addBook'>Add Book</button>
                                </div>
                            </div>
                      </div>
                  </div>

";
        }
    } else {
        echo "<p class='m-auto text-center alert alert-danger'>there are no authors </p>";
    }

    ?>


</div>

<?php
preparePagination($authors, 'Authors');
?>