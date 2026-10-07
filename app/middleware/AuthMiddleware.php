<?php

require_once __DIR__ . "/middleware.php";
class AuthMiddleware implements middleware
{
    public function handle(string ...$roles): void
    {
        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
        }

        if (empty($roles)) {
            return;
        }

        $currentRoleAuth = $_SESSION['user']['role'];

        if (!in_array($currentRoleAuth, $roles)) {
            response::error("forbidden", 403);
        }
    }
}
