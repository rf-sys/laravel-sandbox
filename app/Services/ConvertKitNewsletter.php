<?php

namespace App\Services;

class ConvertKitNewsletter implements Newsletter
{
    public function subscribe(string $email, string $list = null): mixed
    {
        // subscribe the user with ConvertKit specific implementation

        return null;
    }
}
