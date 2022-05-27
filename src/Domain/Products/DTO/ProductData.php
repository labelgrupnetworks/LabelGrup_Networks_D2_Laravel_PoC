<?php

namespace Domain\Products\DTO;

use Domain\Shared\Interfaces\IData;

class ProductData implements IData
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?float $price = null,
        public ?int $stock = null,
        public ?array $images = null,
    ){}
}
