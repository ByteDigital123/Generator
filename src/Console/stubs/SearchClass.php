<?php

namespace App\SearchFilters;

class SearchClass
{
    public static function apply($builder, $filter, $value)
    {
        return $builder->orWhere(strtolower($filter), 'like', '%' . $value . '%');
    }
}
