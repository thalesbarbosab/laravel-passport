<?php

namespace App\Tools;

use Illuminate\Support\Str;

class Sanitize
{
    public function generateUniqueId()
    {
        return Str::uuid();
    }

}
