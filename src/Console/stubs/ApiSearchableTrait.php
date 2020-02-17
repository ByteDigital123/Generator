<?php

namespace App\Http\SearchFilters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait ApiSearchableTrait
{

    public static function apply(Request $filters, $with = [])
    {
        $model = new self::$model;
        $query = static::applyDecoratorsFromRequest($filters, $model);

        return $query->with($with)->paginate($filters->pagination);
    }

    private static function applyDecoratorsFromRequest(Request $request, $model)
    {
        $primary_key = $model->getKeyName();

        $query = $model->newQuery();
        $query = static::applySearchDecorators($request, $query);
        $query = static::applyFilterDecorators($request, $query);

        $query->orderBy($request->sort ? $request->sort : $primary_key, $request->order ? $request->order : 'desc');

        return $query;
    }

    public static function applySearchDecorators(Request $request, Builder $query)
    {
        if ($value = $request->search) {
            foreach ((new self::$model)->searchable as $filterName) {
                $decorator = static::createSearchDecorator();
                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::apply($query, $filterName, $request->search);
                }
            }
        }

        return $query;
    }

    public static function applyFilterDecorators(Request $request, Builder $query)
    {

        if ($request->filters) {
            foreach ($request->filters as $filterName => $value) {
                if ($value) {
                    $decorator = static::createFilterDecorator($filterName);

                    if (static::isValidDecorator($decorator)) {

                        $query = $decorator::apply($query, $value);
                    }
                }
            }
        }

        return $query;
    }

    public static function createSearchDecorator()
    {
        return SearchClass::class;

    }

    private static function createFilterDecorator($name)
    {
        return self::$namespace . '\\Filters\\' .
        str_replace(' ', '', mb_convert_case($name, MB_CASE_TITLE, "UTF-8"));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
