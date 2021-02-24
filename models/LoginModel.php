<?php

class LoginModel extends Model
{

    public function checkUser($login, $password)
    {

        // затычка
        if ($login == 'main' && $password == md5('123')) {
            return true;
        } else {
            return false;
        }
    }

}
