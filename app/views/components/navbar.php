   <nav class="navbar navbar-expand-lg bg-body-tertiary">
     <div class="container">
       <a class="navbar-brand" href="#">
         <img src="<?= asset("images/logo.png") ?>" alt="" class="img-fluid">
       </a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
           <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="<?= route("") ?>">Home</a>
           </li>

           <?php
            if (isAuth('admin')) {
              $userName = auth('name');
              $profileLink = route('/profile');
              $registerLink = route('/auth/register');
              $logoutLink = route('/auth/logout');
              echo "
          <li class='nav-item dropdown'>
             <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
              {$userName}
             </a>
             <ul class='dropdown-menu'>
               <li><a class='dropdown-item' href='{$profileLink}'>profile</a></li>
               <li><a class='dropdown-item' href='{$registerLink}'>Register</a></li>
               <li><a class='dropdown-item' href='{$logoutLink}'>Logout</a></li>
             </ul>
             </li>
   ";
            } else if (isAuth('customer')) {
              $userName = auth('name');
              $profileLink = route('/profile');
              $logoutLink = route('/auth/logout');
              echo "
          <li class='nav-item dropdown'>
             <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
              {$userName}
             </a>
             <ul class='dropdown-menu'>
               <li><a class='dropdown-item' href='{$profileLink}'>profile</a></li>
               <li><a class='dropdown-item' href='{$logoutLink}'>Logout</a></li>
             </ul>
                 </li>
   ";
            } else {
              $loginLink = route('/auth/login');
              $registerLink = route('/auth/register');

              echo "
          <li class='nav-item dropdown'>
             <a class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
               Account
             </a>
             <ul class='dropdown-menu'>
               <li><a class='dropdown-item' href='{$loginLink}'>Login</a></li>
               <li><a class='dropdown-item' href='{$registerLink}'>Register</a></li>
             </ul>
           </li>
";
            }

            ?>

         </ul>
       </div>
     </div>
   </nav>