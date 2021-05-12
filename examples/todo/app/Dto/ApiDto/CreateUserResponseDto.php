<?php
namespace App\Dto\ApiDto;

use App\Dto\ModelDto\UserDto;
use App\Models\User;

class CreateUserResponseDto extends UserDto
{
    public static function fromEntity(User $entity = null): ?self
    {
        if(is_null($entity)) return null;

        $result = new self($entity->attributesToArray());

        return $result;
    }
}

/**
 * @OA\Schema(
 *     schema="CreateUserApiResponse",
 *     type="object",
 *     title="CreateUserApiResponse",
 *     properties={
 *         @OA\Property(property="success", type="string"),
 *         @OA\Property(property="code", type="integer"),
 *         @OA\Property(property="locale", type="string"),
 *         @OA\Property(property="message", type="string"),
 *         @OA\Property(
 *              property="data", 
 *              type="object", 
 *              properties = {
 *                  @OA\Property(property="id", type="string"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string"),
 *                  @OA\Property(property="created_at", type="string"),
 *                  @OA\Property(property="updated_at", type="string"),
 *              }
 *         ),
 *     }
 * )
 */