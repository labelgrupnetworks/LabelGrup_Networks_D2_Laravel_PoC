<?php

namespace Domain\Users\DTO;

class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {}
}
