<?php
namespace App\Services\UserService;

use Illuminate\Http\Request;

use App\Models\User;
use App\Dto\ApiDto\CreateUserResponseDto;
use App\Dto\ApiDto\CreateUserRequestDto;

class CreateUserService
{
    public function handle(Request $request) : ?CreateUserResponseDto
    {
        $requestDto = CreateUserRequestDto::fromRequest($request);

        $entity = new User();
        if ($request->has('name')) {
            $entity->name = $requestDto->name;
        }
        if ($request->has('email')) {
            $entity->email = $requestDto->email;
        }
        if ($request->has('password')) {
            $entity->password = $requestDto->password;
        }

        $entity->save();
        
        $res = CreateUserResponseDto::fromEntity($entity);

        return $res;
    }
}