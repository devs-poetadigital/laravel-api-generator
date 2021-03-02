namespace App\Services\{{ $model_name }}Service;

use Illuminate\Http\Request;

use App\Services\Share\SearchService;
use App\Dto;
use App\Models\{{ $model_name }};
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}RequestDto;
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}ResponseDto;

class {{ $action_name }}{{ $model_name }}Service
{
    public function handle(Request $request) : ?{{ $action_name }}{{ $model_name }}ResponseDto
    {
        $requestDto = {{ $action_name }}{{ $model_name }}RequestDto::fromRequest($request);

        $query = {{ $model_name }}::query();
@foreach ($fillable as $field)
        if ($request->has('{{ $field }}')) {
            $query->where('{{ $field }}', $requestDto->{{ $field }});
        }
@endforeach

        $data = SearchService::handleQuery($query, $requestDto);
        $res = {{ $action_name }}{{ $model_name }}ResponseDto::fromSearchResult($data);

        return $res;
    }
}