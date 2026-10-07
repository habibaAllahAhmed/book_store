<?php

/**
 * @var array $admins
 */
?>


<div class="row">
    <?php

    if (!empty($admins['data'])) {
        foreach ($admins['data'] as $admin) {

            $adminImg = asset('images/admin.png');
            $isAdminBanned = ($admin['is_banned']) ?
                "<span class='badge text-bg-danger position-absolute' style='top:10px; right : 10px '>banned</span>" : '';
            $isButtonBanned = ($admin['is_banned']) ? "<button class='btn btn-danger w-100' onclick='banUser({$admin['id']}, \"unban\")'>Unban</button>" :
                "<button class='btn btn-success w-100' onclick='banUser({$admin['id']}, \"ban\")'>Ban</button>";
            echo "
 <div class='col-lg-4 col-sm-6'>
                      <div class='admins p-3 bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center' 
                       data-user-id='{$admin['id']}'>
                         {$isAdminBanned}
                      <img src='{$adminImg}' style='width: 6rem;' class=' mx-auto card-img-top'>
                          <div class='card-body'>
                              <h5 class='card-title mb-4'>{$admin['name']}</h5>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p> Email :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>{$admin['email']}</p>
                                  </div>
                              </div>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p>Gender :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>{$admin['gender']}</p>
                                  </div>
                              </div>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p>Phone :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>{$admin['phone']}</p>
                                  </div>
                              </div>
                              {$isButtonBanned}
                          </div>
                      </div>
                  </div>
";
        }
    } else {
        echo "<p class='m-auto text-center alert alert-danger'>there are no admins </p>";
    }

    ?>



</div>

<?php
preparePagination($admins, 'Admins');
?>