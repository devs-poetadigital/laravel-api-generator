namespace App\Services\{{ $model_name }}Service;

use Illuminate\Http\Request;

use App\Services\Share\SearchService;
use App\Models\{{ $model_name }};
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}RequestDto;
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}ResponseDto;

class {{ $action_name }}{{ $model_name }}Service
{
    public function handle(Request $request) : ?{{ $action_name }}{{ $model_name }}ResponseDto
    {
        $requestDto = {{ $action_name }}{{ $model_name }}RequestDto::fromRequest($request);

        $queryStr = "
        select * from (
            select *
            from {{ strtolower($table_name) }}
        )
        ";
        
        $data = SearchService::handleRawQuery($queryStr, $requestDto, [], ['created_at','updated_at']);
        $res = {{ $action_name }}{{ $model_name }}ResponseDto::fromSearchResult($data);
        return $res;
    }
}