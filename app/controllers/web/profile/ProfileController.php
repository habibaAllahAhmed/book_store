<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/user/userModel.php";
require_once __DIR__ . "/../../../models/db/DBModel.php";
require_once __DIR__ . "/../../../models/books/booksModel.php";
require_once __DIR__ . "/../../../models/orders/orderModel.php";

class ProfileController extends controller
{

    public function index()
    {
        $data = null;
        if (isAuth('admin')) {
            $data = $this->getAdminData();
        } else if (isAuth('customer')) {
            $data = $this->getCustomerData();
        }

        $this->view(("profile/profile"), $data);
    }

    private function getAdminData(): array
    {

        $total = [
            'books' => DBModel::getTotalOfTable('books'),
            'authors' => DBModel::getTotalOfTable('authors'),
            'customers' => DBModel::getTotalOfTable('users', [['role', '=', 'customer']]),
            'admins' => DBModel::getTotalOfTable('users', [['role', '=', 'admin']]),
            'orders' => [
                'ordered' => DBModel::getTotalOfTable('orders', [['status', '=', 'ordered']]),
                'cancelled' => DBModel::getTotalOfTable('orders', [['status', '=', 'canceled']]),
                'done' => DBModel::getTotalOfTable('orders', [['status', '=', 'done']]),
            ]
        ];

        $admins = DBModel::getDataOfTable('users', [
            ['role', '=', 'admin'],
            ['id', '!=', auth('id')]
        ], request::input('Admins-page', 1));
        $customers = DBModel::getDataOfTable('users', [['role', '=', 'customer']], request::input('Customers-page', 1));
        $authors = DBModel::getDataOfTable('authors', [], request::input('Authors-page', 1));
        $books = BookModel::getDataOfBooks(page: request::input('Books-page', 1));
        $orders = [
            'ordered' => OrderModel::getDataOfOrders([['status', '=', 'ordered']], request::input('Ordered-page', 1)),
            'cancelled' => OrderModel::getDataOfOrders([['status', '=', 'canceled']], request::input('Cancelled-page', 1)),
            'done' => OrderModel::getDataOfOrders([['status', '=', 'done']], request::input('Done-page', 1)),
        ];

        return [
            'total' => $total,
            'admins' => $admins,
            'customers' => $customers,
            'authors' => $authors,
            'books' => $books,
            'orders' => $orders,
        ];
    }

    private function getCustomerData(): array
    {
        $total = [
            'books' => DBModel::getTotalOfTable('books'),
            'boughtBooks' => DBModel::getTotalBoughtBooksOfCustomer(),
            'totalItemsIntoCart' => CartModel::totalItemsIntoOrder(),
            'orders' => [
                'ordered' => DBModel::getTotalOfTable('orders', [
                    ['status', '=', 'ordered'],
                    ['customer_id', '=', auth('id')]
                ]),
                'cancelled' => DBModel::getTotalOfTable('orders', [
                    ['status', '=', 'canceled'],
                    ['customer_id', '=', auth('id')]
                ]),
                'done' => DBModel::getTotalOfTable('orders', [
                    ['status', '=', 'done'],
                    ['customer_id', '=', auth('id')]
                ]),
            ]
        ];


        $books = BookModel::getDataOfBooks(page: request::input('Books-page', 1));
        $boughtBooks = DBModel::getTotalBoughtBooksOfCustomer();
        $totalItemsIntoCart =  CartModel::totalItemsIntoOrder();
        $orders = [
            'ordered' => OrderModel::getDataOfOrders([
                ['status', '=', 'ordered'],
                ['customer_id', '=', auth('id')]
            ], request::input('Ordered-page', 1)),
            'cancelled' => OrderModel::getDataOfOrders([
                ['status', '=', 'canceled'],
                ['customer_id', '=', auth('id')]
            ], request::input('Cancelled-page', 1)),
            'done' => OrderModel::getDataOfOrders([
                ['status', '=', 'done'],
                ['customer_id', '=', auth('id')]
            ], request::input('Done-page', 1)),
        ];

        return [
            'total' => $total,
            'books' => $books,
            'boughtBooks' => $boughtBooks,
            'totalItemsIntoCart' => $totalItemsIntoCart,
            'orders' => $orders,
        ];
    }
}
