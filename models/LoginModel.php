<?php

class LoginModel extends Model
{

    public function checkUser($login, $password)
    {

        // затычка
        if ($login == 'admin' && $password == md5('123')) {
            return true;
        } else {
            return false;
        }
    }

}
