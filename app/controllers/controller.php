<?php

class controller
{
    protected function view(string $viewPath, array $data = []): void
    {

        extract($data);

        require_once __DIR__ . "/../views/{$viewPath}.php";
    }
}
