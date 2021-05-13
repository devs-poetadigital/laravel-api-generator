<?php
namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use App\Dto\ModelDto\UserDto;

class GetAllUserRequestDto extends UserDto
{
    public $current_user;

    public static function fromRequest(Request $request): self
    {
        $result = new self($request->all());

        return $result;
    }
}

/**
 * @OA\Schema(
 *     schema="GetAllUserApiRequest",
 *     type="object",
 *     title="GetAllUserApiRequest",
 *     properties={
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string"),
 *     }
 * )
 */