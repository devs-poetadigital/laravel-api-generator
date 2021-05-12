<?php
namespace App\Dto\ModelDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

use App\Models\User;

class UserDto extends FlexibleDataTransferObject
{
    public $id;
    public $name;
    public $email;
    public $password;
    
    public $created_at;
    public $updated_at;
}

/**
 * @OA\Schema(
 *     schema="UserDto",
 *     type="object",
 *     title="UserDto",
 *     properties={
 *         @OA\Property(property="id", type="string"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string"),
 *         @OA\Property(property="created_at", type="string"),
 *         @OA\Property(property="updated_at", type="string")
 *     }
 * )
 */