sudo apt-get install php8.1-curl php8.1-mysql php8.1-xml php8.1-gd php8.1-mbstring php8.1-zip php8.1-intl
sudo dpkg -i 

composer require tymon/jwt-auth –ignore-platform-reqs


sudo systemctl restart nginx

sa


<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use YopazBase\Repositories\Input\BaseInputDataBuilder;
use YopazBase\Repositories\Output\BaseOutputBuilder;
use YopazBase\Repositories\Output\FirstOutput;
use YopazBase\Repositories\Query\BaseQueryBuilder;
use YopazBase\Repositories\Query\GetByIdQuery;

class AuthController extends Controller
{
public function __construct(private UserService $userService)
{
}
public function index()
{
$user=$this->userService->get(BaseQueryBuilder::emptyQuery(),BaseOutputBuilder::getPaginatedCollectionOutput());
return response()->json([
"status"=>$user
]);
}
public function show(string $id){
$user=$this->userService->get(BaseQueryBuilder::getById($id),BaseOutputBuilder::getFirst());
return response()->json([
"status"=>$user
]);
}
public function update(string $id, Request $request)
{
$this->userService->update(BaseQueryBuilder::getById($id),BaseInputDataBuilder::inputFromArray($request->all()));
return response()->json([
"status"=>"Created Success"
]);
}
public function register(RegisterRequest $request)
{
$this->userService->create(BaseInputDataBuilder::inputFromArray($request->all()));
return response()->json([
"status"=>"Created Success"
]);
}
}

