<?php
namespace App\Dto\ApiDto;
use App\Dto\ModelDto\UserDto;

class SearchUserResponseItem extends UserDto
{

}


/**
 * @OA\Schema(
 *     schema="SearchUserResponseItem",
 *     type="object",
 *     title="SearchUserResponseItem",
 *     properties = {
 *         @OA\Property(property="id", type="string"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string"),
 *         @OA\Property(property="created_at", type="string"),
 *         @OA\Property(property="updated_at", type="string")
 *     }
 * )
 */
