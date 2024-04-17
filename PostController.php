<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\Comments\Query\CommentsQueryBuilder;
use App\Repositories\User\Query\UserQueryBuilder;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use YopazBase\Repositories\Input\BaseInputDataBuilder;
use YopazBase\Repositories\Output\BaseOutputBuilder;
use YopazBase\Repositories\Query\BaseQueryBuilder;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }
    public function index()
    {
        $posts = $this->postService->get(
            query: [
                CommentsQueryBuilder::withCommentsQuery(),
                UserQueryBuilder::withUserQuery()
            ],
            output: BaseOutputBuilder::getPaginatedCollectionOutput(3)
        );
        return response()->json($posts);
    }
}
