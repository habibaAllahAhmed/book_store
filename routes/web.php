<?php

require_once __DIR__ . "/../core/route.php";
require_once __DIR__ . "/../app/controllers/web/HomeController.php";
require_once __DIR__ . "/../app/controllers/web/auth/loginController.php";
require_once __DIR__ . "/../app/controllers/web/cart/CartController.php";
require_once __DIR__ . "/../app/controllers/web/auth/registerController.php";
require_once __DIR__ . "/../app/controllers/web/user/userController.php";
require_once __DIR__ . "/../app/controllers/web/admin/AdminController.php";
require_once __DIR__ . "/../app/controllers/web/profile/ProfileController.php";
require_once __DIR__ . "/../app/controllers/web/author/AuthorController.php";
require_once __DIR__ . "/../app/controllers/web/books/BookController.php";
require_once __DIR__ . "/../app/middleware/AuthMiddleware.php";
require_once __DIR__ . "/../app/middleware/guestMiddleware.php";
require_once __DIR__ . "/../app/middleware/registerMiddleware.php";


route::get("/", HomeController::class, "index");
route::get("/auth/login", loginController::class, "index", [GuestMiddleware::class]);
route::post("/auth/login", loginController::class, "login");
route::get("/auth/logout", loginController::class, "logout", [AuthMiddleware::class]);
route::get("/profile", ProfileController::class, "index", [AuthMiddleware::class]);

// ======== Edit User ===========
route::post("/profile/editName", UserController::class, "editName", [AuthMiddleware::class]);
route::post("/profile/editEmail", UserController::class, "editEmail", [AuthMiddleware::class]);
route::post("/profile/editPhone", UserController::class, "editPhone", [AuthMiddleware::class]);
route::post("/profile/editPassword", UserController::class, "editPassword", [AuthMiddleware::class]);
route::post("/profile/editGender", UserController::class, "editGender", [AuthMiddleware::class]);
route::POST("/profile/filterBooks", BookController::class, "filterBooks", [AuthMiddleware::class]);

// ======== Admin  ===========
route::POST("/profile/addBook", BookController::class, "addBook", ["AuthMiddleware:admin"]);
route::POST("/profile/banUser", AdminController::class, "banUser", ["AuthMiddleware:admin"]);
route::POST("/profile/addAuthor", AuthorController::class, "addAuthor", ["AuthMiddleware:admin"]);
route::POST("/profile/doneOrder", AdminController::class, "doneOrder", ["AuthMiddleware:admin"]);
route::POST("/profile/cancelOrder", AdminController::class, "cancelOrder", ["AuthMiddleware:admin"]);

// ========= Register ============
route::get("/auth/register", registerController::class, "index", [RegisterMiddleware::class]);
route::POST("/auth/register", registerController::class, "register", [RegisterMiddleware::class]);

// ======== customer  ===========
route::POST("/profile/addToCart", CartController::class, "addToCart", ["AuthMiddleware:customer"]);
route::POST("/profile/getItemsIntoCart", CartController::class, "getItemsIntoCart", [AuthMiddleware::class]);
route::POST("/profile/increaseOrderItem", CartController::class, "increaseOrderItem", ["AuthMiddleware:customer"]);
route::POST("/profile/decreaseOrderItem", CartController::class, "decreaseOrderItem", ["AuthMiddleware:customer"]);
route::POST("/profile/deleteOrderItem", CartController::class, "deleteOrderItem", ["AuthMiddleware:customer"]);
route::POST("/profile/fireOrder", CartController::class, "fireOrder", ["AuthMiddleware:customer"]);
