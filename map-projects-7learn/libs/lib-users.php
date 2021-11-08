<?php

function isLoggedin()
{
    return isset($_SESSION['login']);
}

function login($userName, $password)
{
    global $admins;
    if (
        array_key_exists($userName, $admins) &&
        password_verify($password,$admins[$userName]) 
    ) {
        $_SESSION['login'] = true;
        return true;
    }
    return false;
}

function logout()
{
    unset($_SESSION['login']);
}
