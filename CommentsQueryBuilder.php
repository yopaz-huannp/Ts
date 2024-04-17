<?php

namespace App\Repositories\Comments\Query;

use YopazBase\Repositories\Query\QueryInterface;

class CommentsQueryBuilder
{
    public static function withCommentsQuery(): QueryInterface
    {
        return new WithCommentsQuery();
    }
   
}
