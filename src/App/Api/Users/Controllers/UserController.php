<?php

namespace App\Api\Users\Controllers;

use App\Api\Users\Requests\CreateUserRequest;
use App\Api\Users\Requests\UpdateUserRequest;
use App\Api\Users\Resources\UserCollection;
use App\Api\Users\Resources\UserResource;
use App\Http\Controllers\Controller;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\Actions\UpdateUserAction;
use Domain\Users\DTO\UserData;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function index(): UserCollection
    {
        $products = User::applySorts(request('sort'))
            ->applyFilters()
            ->jsonPaginate();

        return UserCollection::make($products);
    }

    public function store(CreateUserRequest $request, CreateUserAction $createProductAction): UserResource
    {
        $data = new UserData(...$request->validated());
        $product = ($createProductAction)($data);
        return UserResource::make($product);
    }

    public function show(User $user): UserResource
    {
        return UserResource::make($user);
    }

    public function update(
        UpdateUserRequest  $request,
        User               $user,
        UpdateUserAction   $updateUserAction
    ): UserResource
    {
        $data = new UserData(...$request->validated());
        $product = ($updateUserAction)($data, $user);
        return UserResource::make($product);
    }

    /**
     * @throws Throwable
     */
    public function destroy(User $user): JsonResponse
    {
        $user->deleteOrFail();
        return response()->json([
            'message' => 'User has been deleted',
        ]);
    }
}
