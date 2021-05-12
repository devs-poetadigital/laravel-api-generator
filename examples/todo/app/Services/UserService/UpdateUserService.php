<?php
namespace App\Services\UserService;

use Illuminate\Http\Request;

use App\Dto;
use App\Models\User;
use App\Dto\ApiDto\UpdateUserResponseDto;
use App\Dto\ApiDto\UpdateUserRequestDto;

class UpdateUserService
{
    public function handle(Request $request) : ?UpdateUserResponseDto
    {
        $requestDto = UpdateUserRequestDto::fromRequest($request);

        $entity = User::where('id', $requestDto->id)->first();
        if(is_null($entity)) {
            return null;
        }

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

        $res = UpdateUserResponseDto::fromEntity($entity);

        return $res;
    }
}