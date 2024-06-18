<?php

namespace App\Repositories\User\Query;

use Illuminate\Database\Eloquent\Builder;
use YopazBase\Repositories\Query\QueryInterface;
class WhereEmailQuery implements QueryInterface
{
    private string $email;

    public function __construct(
        string $email
    ) {
        $this->email = $email;
    }

    public function buildQuery(Builder $query): Builder
    {
        return $query->where('email', $this->email);
    }
}
