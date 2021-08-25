<?php


use Illuminate\Database\Eloquent\Model;

function check($model, $column, $values)
{

    $result = $model::query()
        ->where($column, '=', $values)
        ->first();

    return $result;
}