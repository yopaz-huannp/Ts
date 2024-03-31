<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostRequest;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use YopazBase\Repositories\Input\BaseInputDataBuilder;
use YopazBase\Repositories\Output\BaseOutputBuilder;
use YopazBase\Repositories\Query\BaseQueryBuilder;

class PostController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private PostService $postService)
    {
        
    }

    public function index()
    {
        $posts=$this->postService->get(BaseQueryBuilder::emptyQuery(),BaseOutputBuilder::getPaginatedCollectionOutput(2));
        $page = [
            'title' => __('Post List'),
            'breadcrumbs' => [
                [
                    'link' => route('admin.dashboard'),
                    'name' => 'Dashboard',
                ],
                [
                    'link' => route('admin.post.index'),
                    'name' => __('Post List'),
                ],
            ],
        ];
        return $this->intertialRender('Admin/Post/Index',compact('posts','page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
         $this->postService->create(BaseInputDataBuilder::inputFromArray($request->all()));
         return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=$this->postService->get(BaseQueryBuilder::getById($id),BaseOutputBuilder::getFirst());
        $page = [
            'title' => __('Post Edit'),
            'breadcrumbs' => [
                [
                    'link' => route('admin.dashboard'),
                    'name' => 'Dashboard',
                ],
                [
                    'link' => route('admin.post.index'),
                    'name' => __('Post Edit'),
                ],
            ],
        ];
        return $this->intertialRender('Admin/Post/Edit',compact('post','page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $this->postService->update(BaseQueryBuilder::getById($id),BaseInputDataBuilder::inputFromArray($request->all()));
        return Redirect::route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->postService->delete(BaseQueryBuilder::getById($id));
        return back();
    }
}
