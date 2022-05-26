<?php

namespace Domain\Products\DTO;

use Domain\Shared\Interfaces\IData;

class ProductCategoriesData
{
    public function __construct(
        public string $categories,
    ){}
}
