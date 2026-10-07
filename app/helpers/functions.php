<?php

function pr(mixed $data, bool $die = false)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if ($die) {
        exit;
    }
}

function prJson(mixed $data, bool $die = false)
{
    echo "<pre>";
    print_r(json_encode($data));
    echo "</pre>";

    if ($die) {
        exit;
    }
}

function asset(string $path)
{
    return BASE_URL . "/assets/" . ltrim($path, '/');
}

function session(string $key, mixed $value = null): mixed
{
    if (func_num_args() === 1) {
        return $_SESSION[$key] ?? null;
    }

    return $_SESSION[$key] = $value;
}


function old(string $key, mixed $default = ''): mixed
{
    $result = $_SESSION['_old'][$key] ?? $default;
    unset($_SESSION['_old'][$key]);
    return $result;
}

function oldSelect(string $key, mixed $selectedOption = '', bool $isLast = false): mixed
{
    $result = (isset($_SESSION['_old'][$key]) && $_SESSION['_old'][$key] == $selectedOption) ? 'selected' : "";
    if ($isLast) {
        unset($_SESSION['_old'][$key]);
    }
    return $result;
}

function isSelected(string $value, mixed $selectedOption = ''): mixed
{
    $result = ($value == $selectedOption) ? 'selected' : "";

    return $result;
}

function isAuth(?string $key = null): bool
{
    if (!isset($_SESSION['user'])) {
        return false;
    }

    if ($key === null) {
        return true;
    }

    $currentAuthRole = $_SESSION['user']['role'] ?? null;

    return $currentAuthRole === $key;
}

function auth(?string $key = null): mixed
{
    $user = $_SESSION['user'] ?? null;

    if ($key === null) {
        return $user;
    }

    return $user[$key] ?? null;
}

function isGuest(): bool
{
    return !isAuth();
}

function redirect(string $path)
{
    $url = BASE_URL . $path;

    header("Location: {$url}");
    exit;
}

function route(string $path)
{
    return BASE_URL . $path;
}

function back(?string $key = null, string | array $msg = "")
{
    $path = $_SERVER['HTTP_REFERER'];
    if ($key !== null) {
        $_SESSION[$key] = $msg;
    }

    header("Location: {$path}");
    exit;
}

function getErr(string $key)
{
    $htmlErr = "";

    if (isset($_SESSION['_errors'][$key])) {
        $htmlErr = "<p class='alert alert-danger mt-2'>{$_SESSION['_errors'][$key][0]}</p>";
        unset($_SESSION['_errors'][$key]);
    }

    return $htmlErr;
}

function getSessionMsg(string $key, bool $isError = true)
{
    $htmlErr = "";

    $className = ($isError) ? 'alert-danger' : 'alert-success';
    if (isset($_SESSION[$key])) {
        $htmlErr = "<p class='alert {$className} mt-2'>{$_SESSION[$key]}</p>";
        unset($_SESSION[$key]);
    }

    return $htmlErr;
}
