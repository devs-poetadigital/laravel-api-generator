<?php
namespace App\Services\UserService;

use Illuminate\Http\Request;

use App\Models\User;
use App\Dto\ApiDto\GetAllUserResponseDto;
use App\Dto\ApiDto\GetAllUserRequestDto;

class GetAllUserService
{
    public function handle(Request $request) : ?GetAllUserResponseDto
    {
        $requestDto = GetAllUserRequestDto::fromRequest($request);

        $entity = User::where('id', $requestDto->id)->first();

        $res = GetAllUserResponseDto::fromEntity($entity);

        return $res;
    }
}