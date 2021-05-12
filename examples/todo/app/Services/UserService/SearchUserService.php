<?php
namespace App\Services\UserService;

use Illuminate\Http\Request;

use App\Services\Share\SearchService;
use App\Models\User;
use App\Dto\ApiDto\SearchUserRequestDto;
use App\Dto\ApiDto\SearchUserResponseDto;

class SearchUserService
{
    public function handle(Request $request) : ?SearchUserResponseDto
    {
        $requestDto = SearchUserRequestDto::fromRequest($request);

        $query = User::query();
        if ($request->has('name')) {
            $query->where('name', $requestDto->name);
        }
        if ($request->has('email')) {
            $query->where('email', $requestDto->email);
        }
        if ($request->has('password')) {
            $query->where('password', $requestDto->password);
        }

        $data = SearchService::handleQuery($query, $requestDto);
        $res = SearchUserResponseDto::fromSearchResult($data);

        return $res;
    }
}