<?php

namespace App\DataTransferObjects\User;

use App\DataTransferObjects\Contracts\FromRequest;
use App\DataTransferObjects\Contracts\ToArray;
use Illuminate\Http\Request;

readonly class PatchUserDto implements FromRequest, ToArray
{
    public function __construct(
        public ?string $name,
        public ?string $email,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
        ], fn($value) => !is_null($value));
    }
}
