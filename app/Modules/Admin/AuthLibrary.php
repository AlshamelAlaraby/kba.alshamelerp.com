<?php

namespace App\Modules\Admin;

class AuthLibrary
{
    public function login($data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        $rememberMe = isset($data['remember_me']);

        if (!auth('admin')->attempt($credentials, $rememberMe)) {
            return false;
        }

        return true;
    }
}
