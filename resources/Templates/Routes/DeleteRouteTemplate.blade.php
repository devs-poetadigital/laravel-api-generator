use Illuminate\Support\Facades\Route;

//use
use App\Http\Controllers\Api\{{ $model_name }}\{{ $action_name }}{{ $model_name }}Controller;
//route
Route::match(array('POST', 'DELETE'), '{{ strtolower($model_name) }}/{{ strtolower($action_name_kebab) }}', ['uses' => {{ $action_name }}{{ $model_name }}Controller::class])->middleware(['jwt.verify']);
