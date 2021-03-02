namespace App\Dto\ModelDto;

use Illuminate\Http\Request;

use \Spatie\DataTransferObject\DataTransferObjectCollection;

use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $model_name }}Collection extends DataTransferObjectCollection
{
    public function current(): {{ $model_name }}Dto
    {
        return parent::current();
    }

    public static function create(array $data = null): ?{{ $model_name }}Collection
    {
        if(is_null($data)) return null;

        return new static({{ $model_name }}Dto::arrayOf($data));
    }
}