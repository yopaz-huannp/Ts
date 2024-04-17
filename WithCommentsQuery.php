<?php

namespace App\Repositories\Comments\Query;

use Illuminate\Database\Eloquent\Builder;
use YopazBase\Repositories\Query\QueryInterface;

class WithCommentsQuery implements QueryInterface
{

    public function __construct(private readonly array $columns = ['*'])
    {
    }

    public function buildQuery(Builder $query): Builder
    {
        return $query->with('comments', function ($q) {
            $q->select($this->columns)->with('users')->latest('id');
        });
    }
}
