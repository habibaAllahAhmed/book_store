<?php

require_once __DIR__ . "/create_apiTokens_table.php";
require_once __DIR__ . "/create_authors_table.php";
require_once __DIR__ . "/create_books_table.php";
require_once __DIR__ . "/create_orders_table.php";
require_once __DIR__ . "/create_users_table.php";
require_once __DIR__ . "/create_ordersItems_table.php";

create_users_table::up();
create_authors_table::up();
create_books_table::up();
create_orders_table::up();
create_ordersItems_table::up();
create_apiTokens_table::up();
