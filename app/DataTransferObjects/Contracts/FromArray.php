<?php

namespace App\DataTransferObjects\Contracts;

interface FromArray
{
    public static function fromArray(array $data): self;
}
