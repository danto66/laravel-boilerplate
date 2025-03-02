<?php

namespace App\DataTransferObjects\User;

use App\DataTransferObjects\Contracts\FromRequest;
use App\DataTransferObjects\Contracts\ToArray;
use Illuminate\Http\Request;

readonly class FilterUserDto implements FromRequest, ToArray
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->query('name'),
            email: $request->query('email'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
