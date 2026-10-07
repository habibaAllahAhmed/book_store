<div class="modal fade" id="editEmail" tabindex="-1" aria-labelledby="editEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= getErr('email') ?>
                <form method="POST" action="<?= route('/profile/editEmail') ?>">
                    <input type="Email" class="form-control mb-4" id="Email" name="email"
                        value="<?= auth('email') ?>" aria-label="default input example"
                        autocomplete="off">
                    <button type="submit" class="btn btn-info text-light ms-auto d-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editGender" tabindex="-1" aria-labelledby="editGenderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Gender</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= getErr('gender') ?>
                <form method="POST" action="<?= route('/profile/editGender') ?>">
                    <div class="input-group mb-4">
                        <select name="gender" id="Gender" class="form-select">
                            <option <?= isSelected(auth('gender'), '') ?> hidden></option>
                            <option value="male" <?= isSelected(auth('gender'), 'male') ?>>male</option>
                            <option value="female" <?= isSelected(auth('gender'), 'female') ?>>female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info text-light ms-auto d-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPassword" tabindex="-1" aria-labelledby="editPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= getErr('password') ?>
                <form method="POST" action="<?= route('/profile/editPassword') ?>">
                    <input type="password" name="password" id="Password" class="form-control mb-4"
                        aria-label="default input example" autocomplete="off">
                    <button type="submit" class="btn btn-info text-light ms-auto d-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editName" tabindex="-1" aria-labelledby="editNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Name</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= getErr('name') ?>
                <form method="POST" action="<?= route('/profile/editName') ?>">
                    <input class="form-control mb-4" name="name" id="Name" type="text" aria-label="default input example" value="<?= auth('name') ?>" autocomplete="off">
                    <button type="submit" class="btn btn-info text-light ms-auto d-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhone" tabindex="-1" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Edit Phone</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= getErr('phone') ?>
                <form method="POST" action="<?= route('/profile/editPhone') ?>">
                    <input type="Phone" class="form-control mb-4" id="Phone" name="phone"
                        value="<?= auth('phone') ?>" aria-label="default input example"
                        autocomplete="off">
                    <button type="submit" class="btn btn-info text-light ms-auto d-block">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAuthor" tabindex="-1" aria-labelledby="addAuthorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Author</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="AddAuthorForm">
                    <label for="authorName" id="AuthorName">Name :</label>
                    <input type="text" class="form-control mb-4" id="authorName" name="authorName"
                        aria-label="default input example"
                        autocomplete="off">
                    <p class="alert alert-danger mt-3 d-none" data-error-name="authorName"></p>
                    <label for="AuthorBio" id="AuthorBio">Bio :</label>
                    <textarea class="form-control mb-4" rows='10' style="resize: none;" id="AuthorBio" name="authorBio"
                        aria-label="default input example"
                        autocomplete="off"></textarea>
                    <p class="alert alert-danger mt-3 d-none" data-error-name="authorBio"></p>
                    <button type="submit" class="btn btn-success text-light w-100 ms-auto d-block">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBook" tabindex="-1" aria-labelledby="addBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="AddBookForm">
                    <input type="hidden" value="" id="AuthorIdOfBook" name="bookAuthorId">
                    <label class='mb-2' for="Author">Author :</label>
                    <select class="form-control mb-4" id="AuthorId" disabled>
                        <option value="" selected hidden></option>
                    </select>
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookAuthorId"></p>

                    <label class='mb-2' for="BookTitle">Title :</label>
                    <input type="text" class="form-control mb-4" id="BookTitle" name="bookTitle"
                        aria-label="default input example"
                        autocomplete="off">
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookTitle"></p>

                    <label class='mb-2' for="BookImage">Image :</label>
                    <input type="file" class="form-control mb-4" id="BookImage" name="bookImage"
                        aria-label="default input example"
                        autocomplete="off">
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookImage"></p>

                    <label class='mb-2' for="BookDescription">Description :</label>
                    <textarea class="form-control mb-4" style="resize: none;" rows="10" id="BookDescription" name="bookDescription"
                        aria-label="default input example"
                        autocomplete="off"></textarea>
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookDescription"></p>

                    <label class='mb-2' for="BookPrice">Price :</label>
                    <input type="text" class="form-control mb-4" id="BookPrice" name="bookPrice"
                        aria-label="default input example"
                        autocomplete="off">
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookPrice"></p>

                    <label class='mb-2' for="BookStock">Stock :</label>
                    <input type="text" class="form-control mb-4" id="BookStock" name="bookStock"
                        aria-label="default input example"
                        autocomplete="off">
                    <p class="alert alert-danger mt-3 d-none" data-error-name="bookStock"></p>

                    <button type="submit" class="btn btn-success text-light w-100 ms-auto d-block">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="Cart" tabindex="-1" aria-labelledby="CartLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Cart</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>