<?php
namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

class SearchUserRequestDto extends SearchCriteriaDto
{
    public $name;
    public $email;
    public $password;

    public static function fromRequest(Request $request): self
    {
        $result = new self($request->all());

        return $result;
    }
}

/**
 * @OA\Schema(
 *     schema="SearchUserApiRequest",
 *     type="object",
 *     title="SearchUserApiRequest",
 *     properties={
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string"),
 *     }
 * )
 */