<?php

/**
 * @var array $total
 */
?>

<ul class="nav nav-tabs p-2" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="Statistics-tab" data-bs-toggle="tab" data-bs-target="#Statistics-tab-pane" type="button" role="tab" aria-controls="Statistics-tab-pane" aria-selected="true">Statistics</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="Books-tab" data-bs-toggle="tab" data-bs-target="#Books-tab-pane" type="button" role="tab" aria-controls="Books-tab-pane" aria-selected="false">Books</button>
    </li>
    <li class="nav-item" role="presentation">
        <div class="dropdown">
            <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Orders
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="Ordered-tab" data-bs-toggle="tab" data-bs-target="#Ordered-tab-pane"
                        type="button" role="tab" aria-controls="Ordered-tab-pane" aria-selected="false">Ordered</a></li>
                <li><a class="dropdown-item" href="#" id="Cancelled-tab" data-bs-toggle="tab" data-bs-target="#Cancelled-tab-pane"
                        type="button" role="tab" aria-controls="Cancelled-tab-pane" aria-selected="false">Cancelled</a></li>
                <li><a class="dropdown-item" href="#" id="Done-tab" data-bs-toggle="tab" data-bs-target="#Done-tab-pane"
                        type="button" role="tab" aria-controls="Done-tab-pane" aria-selected="false">Done</a></li>
            </ul>
        </div>
    </li>
</ul>
<div class="tab-content position-relative" id="myTabContent">

    <button type="button " id="CartBtn" class="btn bg-primary-subtle text-primary-emphasis position-absolute" onclick="getItemsIntoCart()" style="top: -45px; right: 20px;">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <span id="TotalItems"> <?= $total['totalItemsIntoCart'] ?></span>
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>

    <div class="tab-pane fade show active" id="Statistics-tab-pane" role="tabpanel" aria-labelledby="Statistics-tab" tabindex="0">
        <div class="item2 p-2 pt-4 ">
            <?php include __DIR__ . "/statistics.php"; ?>
        </div>
    </div>

    <div class="tab-pane fade p-2 pt-4 " id="Books-tab-pane" role="tabpanel" aria-labelledby="Books-tab" tabindex="0">
        <form id="BooksFilter">
            <input type="hidden" name="page" id="ChangePage" value="1">
            <div class="row">
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookTitle" class="input-group-text"><i class="fa-solid fa-book"></i></label>
                            <input type="text" id="FilterBookTitle" class="form-control" name="bookTitle" placeholder="Title...">
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookAuthor" class="input-group-text"><i class="fa-solid fa-user"></i></label>
                            <input type="text" class="form-control" name="author" placeholder="author...">
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookMinPice" class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></label>
                            <input type="text" class="form-control" name="minPrice" placeholder="Min Price...">
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookMaxPrice" class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></label>
                            <input type="text" class="form-control" name="maxPrice" placeholder="Max price...">
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookStock" class="input-group-text"><i class="fa-solid fa-hashtag"></i></label>
                            <input type="text" class="form-control" name="stock" placeholder="stock...">
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <div class="input-group mb-3">
                            <label for="FilterBookSort" class="input-group-text"><i class="fa-solid fa-up-down"></i></label>
                            <select class="form-control" name="sort" id="FilterBookSort">
                                <option value="DESC">↑ DESC</option>
                                <option value="ASC">↓ ASC</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success mb-3 w-100">Filter</button>
        </form>
        <?php include __DIR__ . "/books.php"; ?>
    </div>


    <div class="tab-pane fade" id="Ordered-tab-pane" role="tabpanel" aria-labelledby="Ordered-tab" tabindex="0">
        <div class="item2 p-2 pt-4 ">
            <?php include __DIR__ . "/ordered.php"; ?>
        </div>
    </div>

    <div class="tab-pane fade" id="Cancelled-tab-pane" role="tabpanel" aria-labelledby="Cancelled-tab" tabindex="0">
        <div class="item2 p-2 pt-4 ">
            <?php include __DIR__ . "/cancelled.php"; ?>
        </div>
    </div>

    <div class="tab-pane fade" id="Done-tab-pane" role="tabpanel" aria-labelledby="Done-tab" tabindex="0">
        <div class="item2 p-2 pt-4 ">
            <?php include __DIR__ . "/done.php"; ?>
        </div>
    </div>
</div>