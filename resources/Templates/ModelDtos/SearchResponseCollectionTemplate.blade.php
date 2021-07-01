namespace App\Dto\ApiDto;
use \Spatie\DataTransferObject\DataTransferObjectCollection;

class {{ $action_name }}{{ $model_name }}ResponseCollection extends DataTransferObjectCollection
{
    public function current(): {{ $action_name }}{{ $model_name }}ResponseItem
    {
        return parent::current();
    }

    public static function create($data = null): ?{{ $action_name }}{{ $model_name }}ResponseCollection
    {
        if(is_null($data)) return null;

        $items = [];
        foreach($data as $srcItem) {
            $destItem = is_object($srcItem) ? $srcItem->toArray() : (array) $srcItem;
            array_push($items, $destItem);
        }

        return new static({{ $action_name }}{{ $model_name }}ResponseItem::arrayOf($items));
    }
}