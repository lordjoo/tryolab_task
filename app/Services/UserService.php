<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function getByEmail(mixed $email)
    {
        $user = User::where('email', $email)->first();
        if (! $user) {
            throw new \Exception('User not found');
        }
        return $user;
    }
}
