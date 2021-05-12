<?php
namespace App\Dto\ApiDto;
use App\Dto\ModelDto\UserDto;

class SearchUserResponseItem extends UserDto
{
    public UserDto $owner;
}


/**
 * @OA\Schema(
 *     schema="SearchUserResponseItem",
 *     type="object",
 *     title="SearchUserResponseItem",
 *     properties = {
 *                  @OA\Property(property="owner", type="object", ref="#/components/schemas/UserDto"),
 *                  @OA\Property(property="id", type="string"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string"),
 *                  @OA\Property(property="created_at", type="string"),
 *                  @OA\Property(property="updated_at", type="string"),
 *              }
 * )
 */
