<?php

function login($email, $password)
{
    $user = getUserByEmail($email);
    if (is_null($user)) {
        return false;
    }
    //var_dump($user);
    #check password
    if (password_verify($password, $user->password)) {
        # login is succesfull
         $user->imag ="https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->$email)));
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

function Logout(){
    unset($_SESSION['login']);
}

function isLoggedIn()
{
    return isset($_SESSION['login']) ? true : false;
}

function getLoggedInUser()
{
    return $_SESSION['login'] ?? null;
}

function register($data)
{
    global $PDO;
    #valid Email , valid userNmae
    $passhash = password_hash($data['password'], PASSWORD_BCRYPT);
    try {
        $sql = "INSERT INTO `users` (`name`, `email`,`password`) VALUES (:name, :email, :password);";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([':name' => $data['username'], ':email' => $data['email'], ':password' => $passhash]);
    } catch (Exception $e) {
        return false;
        diePage($e->getMessage(), "Operation Faile");
    }
    return $stmt->rowCount() ? true : false;
}

function getCurrentUserId()
{



    return getLoggedInUser()->id ?? 0;
}

function getUserByEmail($email)
{
    global $PDO;
    try {
        $sql = "SELECT * FROM `users` WHERE email = :email";

        $stmt = $PDO->prepare($sql);
        $stmt->execute([':email' => $email]);
    } catch (Exception $e) {
        diePage($e->getMessage(), "get user Faile");
    }
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}
