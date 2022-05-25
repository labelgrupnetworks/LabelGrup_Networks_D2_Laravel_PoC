<?php

namespace Domain\Categories\DTO;

use Domain\Shared\Interfaces\IData;

class CategoryData implements IData
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
    ){}
}
