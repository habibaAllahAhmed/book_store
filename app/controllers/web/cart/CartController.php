
<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/cart/cartModel.php";

class CartController extends controller
{
    public function addToCart()
    {
        $errors = request::validate([
            'bookId' => ['required', ['exists', 'books', 'id']],
            'quantity' => ['required'],
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        CartModel::addToCart();
        $totalItems = CartModel::totalItemsIntoOrder();

        response::json([
            'totalItems' => $totalItems
        ]);
    }

    public function getItemsIntoCart()
    {
        if (request::input('orderId') != null) {
            $errors = request::validate([
                'orderId' => ['required', ['exists', 'orders', 'id']]
            ]);
        }

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = CartModel::getItemsIntoCart(request::input('orderId'));
        response::json($data);
    }

    public function increaseOrderItem()
    {
        $errors = request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }


        $data = CartModel::increaseOrderItem();

        response::json($data);
    }

    public function decreaseOrderItem()
    {
        $errors = request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = CartModel::decreaseOrderItem();

        response::json($data);
    }

    public function deleteOrderItem()
    {
        $errors = request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = CartModel::deleteOrderItem();

        response::json($data);
    }

    public function fireOrder()
    {
        $errors = request::validate([
            'orderId' => ['required', ['exists', 'orders', 'id']],
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = CartModel::fireOrder();

        response::json($data);
    }
}
