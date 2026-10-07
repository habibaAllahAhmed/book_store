<?php

require_once __DIR__ . "/create_apiTokens_table.php";
require_once __DIR__ . "/create_authors_table.php";
require_once __DIR__ . "/create_books_table.php";
require_once __DIR__ . "/create_orders_table.php";
require_once __DIR__ . "/create_users_table.php";
require_once __DIR__ . "/create_ordersItems_table.php";

create_apiTokens_table::down();
create_ordersItems_table::down();
create_orders_table::down();
create_books_table::down();
create_authors_table::down();
create_users_table::down();
