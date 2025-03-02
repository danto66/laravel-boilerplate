<?php

namespace App\DataTransferObjects\User;

use App\DataTransferObjects\Contracts\FromRequest;
use App\DataTransferObjects\Contracts\ToArray;
use App\Enums\User\UserGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

readonly class StoreUserDto implements FromRequest, ToArray
{
    public function __construct(
        public string $name,
        public string $email,
        public UserGender $gender,
        public string $password,
    ) {}

    public static function fromRequest(Request $request): FromRequest
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            gender: UserGender::from($request->input('gender')),
            password: $request->input('password'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender->value,
            'password' => Hash::make($this->password),
        ];
    }
}
