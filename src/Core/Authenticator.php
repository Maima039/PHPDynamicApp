<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // find the user
        $user = App::resolve(Database::class)
            ->query('select * from user where email= :email', [
                'email' => $email
            ])->find();
        // log in if credentials matches
        if ($user) {
            // pwd matches
            if (password_verify($password, $user['password'])) {
                $this->login(['email' => $email]);
                return true;
            }
        }
        // email and pwd not match
        return false;
    }


    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];
        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
