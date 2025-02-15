<?php

namespace App\DataTransferObjects\Contracts;

use Illuminate\Http\Request;

interface FromRequest
{
    public static function fromRequest(Request $request): self;
}
