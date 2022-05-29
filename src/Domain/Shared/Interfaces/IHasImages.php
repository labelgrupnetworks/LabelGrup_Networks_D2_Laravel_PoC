<?php

namespace Domain\Shared\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface IHasImages{
    public function images(): MorphToMany;
    public function directoryForImages(): string;
}
