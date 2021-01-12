<?php
namespace App\Validation;

use App\Entity\User;
class UserValidation {
    public static function isValidUser($userRepository, $user) : bool {
        if(!UserValidation::isValidUsername($userRepository, $user['username']))
            return false;
        if(!UserValidation::isValidEmail($userRepository, $user['email']))
            return false;
        if(!UserValidation::isValidName($user['firstName']))
            return false;
        if(!UserValidation::isValidName($user['lastName']))
            return false;
        if(!UserValidation::isValidPhone($user['phone']))
            return false;
        if(!UserValidation::isValidName($user['city']))
            return false;
        if(!UserValidation::isValidName($user['country']))
            return false;
        return true;
    }

    public static function isValidUsername($userRepository, $username) : bool {
        if(empty($username)) return true;
        if(preg_match("/[a-zA-Z][a-zA-Z0-9\.\_]{3,}/", $username)) {
            $user = $userRepository->findOneBy(['username' => $username]);
            return $user == null;
        }
        return false;
    }

    public static function isValidEmail($userRepository, $email) : bool {
    if(empty($email)) return true;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user = $userRepository->findOneBy(['email' => $email]);
        return $user == null;
    }
    return false;
}

    public static function isValidName($name): bool {
        if(empty($name)) return true;
        return preg_match("/^([a-zA-Z' ]+)$/", $name) > 0;
    }

    public static function isValidPhone($phone) : bool {
        if(empty($phone)) return true;
        return preg_match("/[0-9]{10}/", $phone) > 0;
    }
}