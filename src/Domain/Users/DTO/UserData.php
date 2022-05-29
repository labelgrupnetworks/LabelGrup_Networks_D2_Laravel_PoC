<?php

namespace Domain\Users\DTO;

use Domain\Shared\Interfaces\IData;

class UserData implements IData
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?string $role = null,
    ){}
}
