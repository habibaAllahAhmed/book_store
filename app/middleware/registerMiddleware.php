<?php
require_once __DIR__ . "/middleware.php";

class RegisterMiddleware implements middleware
{
    public function handle(string ...$roles): void
    {
        if (isAuth('customer')) {
            redirect('/profile');
        }
    }
}
