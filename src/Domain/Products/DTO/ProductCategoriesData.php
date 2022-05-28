<?php

namespace Domain\Products\DTO;

use Domain\Shared\Interfaces\IData;

class ProductCategoriesData implements IData
{
    public function __construct(
        public array $categories,
    ){}
}
