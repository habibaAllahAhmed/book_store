<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/books/booksModel.php";

class BookController extends controller
{
    public function filterBooks()
    {

        $minPrice = request::input('minPrice', '') == '' ? 0 : request::input('minPrice');
        $maxPrice = request::input('maxPrice', '') == '' ? null : request::input('maxPrice');
        $stock = request::input('stock', '') == '' ? null : request::input('stock');

        $wheres = [
            ['authors.name', 'LIKE', '%' . request::input('author', '') . '%'],
            ['books.title', 'LIKE', '%' . request::input('bookTitle', '') . '%'],
            ['books.price', '>=', $minPrice],
        ];

        if ($maxPrice != null) {
            array_push($wheres, ['books.price', '<=', $maxPrice]);
        }

        if ($stock != null) {
            array_push($wheres, ['books.stock', '=', $stock]);
        }

        $books = BookModel::getDataOfBooks($wheres, request::input('sort', 'DESC'), (int)request::input('page', 1));

        response::json($books);
    }

    public function addBook()
    {
        $errors = request::validate([
            'bookAuthorId' => ['required', ['exists', 'authors', 'id']],
            'bookTitle' => ['required'],
            'bookDescription' => ['required'],
            'bookPrice' => ['required'],
            'bookStock' => ['required'],
        ]);

        if (!empty($errors)) {
            response::json($errors, "", 422);
        }

        $newBook = BookModel::addBook();

        response::json($newBook);
    }
}
