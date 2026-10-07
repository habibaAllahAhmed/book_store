<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/author/authorModel.php";

class AuthorController extends controller
{

    public function addAuthor()
    {
        $errors = request::validate([
            'authorName' => ['required'],
            'authorBio' => ['required'],
        ]);

        if (!empty($errors)) {
            response::json($errors, "Unprocessable Entity", 422);
        }

        $newAuthor = AuthorModel::addAuthor();
        response::json($newAuthor, "new author is added");
    }
}
