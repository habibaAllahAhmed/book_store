<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";

class BookModel extends Model
{
    public static function getDataOfBooks(array $wheres = [], string $sort = "DESC", int $page = 1): array
    {
        $DB = database::getConnection();

        $whereQuery = Model::prepareWhereQuery($wheres);


        $offset = ($page * 10) - 10;

        $stmt = $DB->query("SELECT books.* ,
        authors.name AS author_name
        FROM books
        LEFT JOIN authors
        ON books.author_id = authors.id
        {$whereQuery}
        ORDER BY books.id {$sort}
        LIMIT 10 OFFSET {$offset} ;");

        $data = $stmt->fetchAll();

        $stmt = $DB->query("SELECT COUNT(*) AS total FROM books
                LEFT JOIN authors
        ON books.author_id = authors.id
        {$whereQuery} ;");


        $total = $stmt->fetch()['total'];

        return [
            'data' => $data,
            'total' => $total,
            'currentPage' => $page
        ];
    }

    public static function filterBooks()
    {
        $DB = database::getConnection();
    }

    public static function hasFile(string $fileName)
    {
        return isset($_FILES[$fileName]) && $_FILES[$fileName]['tmp_name'] != '';
    }

    public static function addBook()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("INSERT INTO books 
        (author_id , title, image , description , price , stock)
        VALUES
        (:author_id , :title, :image , :description , :price , :stock);
        ");

        $image = self::uploadImage('bookImage');

        $stmt->execute([
            "author_id" => request::input('bookAuthorId'),
            "title" => request::input('bookTitle'),
            "image" => $image,
            "description" => request::input('bookDescription'),
            "price" => request::input('bookPrice'),
            "stock" => request::input('bookStock')
        ]);

        $newBookId = $DB->lastInsertId();

        $newBook = self::getDataOfBooks([
            ['books.id', '=', $newBookId]
        ])['data'][0];

        return $newBook;
    }

    private static function uploadImage(string $fileName): ?string
    {
        if (self::hasFile('bookImage')) {

            $file = $_FILES[$fileName];
            $fileName = $file['name'];
            $fileOriginalName =  pathinfo($fileName, PATHINFO_FILENAME);
            $fileTmp =  $file['tmp_name'];
            $fileOriginalExtension =  strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtension =  ['png', 'jpg'];

            if (!in_array($fileOriginalExtension,  $allowedExtension)) {
                response::error("file extension not allowed", 403);
            }

            $fileNewName = $fileOriginalName . "_" . time() . "." . $fileOriginalExtension;

            $uploadDir = __DIR__ . "/../../../public/assets/images/uploads";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $uploadPath = $uploadDir . "/" . $fileNewName;

            if (!move_uploaded_file($fileTmp, $uploadPath)) {
                response::error("error to upload photo", 403);
            }

            return $fileNewName;
        } else {
            return null;
        }
    }
}
