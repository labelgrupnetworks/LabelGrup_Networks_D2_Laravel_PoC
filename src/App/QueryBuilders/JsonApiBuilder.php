<?php

namespace App\QueryBuilders;

use Illuminate\Support\Str;

class JsonApiBuilder
{
    public function jsonPaginate(): \Closure
    {
        return function () {
            return
                $this->simplePaginate(
                    perPage:request('per_page'),
                    pageName:'page_number',
                    page:request('page_number')
                )->appends(request()->except('page_number'));
        };
    }

    public function applySorts(): \Closure
    {
        return function () {
            if (!property_exists($this->model, 'allowedSorts'))
                abort(500, 'Please set the public property $allowedSorts inside ' . get_class($this->model));

            if (is_null($sorts = request('sort')))
                return $this;

            $sortFields = Str::of($sorts)->explode(',');

            foreach ($sortFields as $sortField){
                $direction = 'asc';
                if (Str::of($sortField)->startsWith('-')){
                    $direction = 'desc';
                    $sortField = Str::of($sortField)->substr(1);
                }

                if (!collect($this->model->allowedSorts)->contains($sortField))
                    abort(400, "Invalid Query Parameter, '$sortField'");

                $this->orderBy($sortField, $direction);
            }
            return $this;
        };
    }

    public function applyFilters(): \Closure
    {
        return function () {
            foreach (request('filter', []) as $filter => $value){
                if (!$this->hasNamedScope($filter))
                    abort(400, "Filter $filter is not allowed");
                $this->{$filter}($value);
            }
            return $this;
        };
    }
}
