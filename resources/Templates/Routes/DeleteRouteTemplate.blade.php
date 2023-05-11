use Illuminate\Support\Facades\Route;

//use
use App\Http\Controllers\Api\{{ $model_name }}\{{ $action_name }}{{ $model_name }}Controller;
//route
Route::match(array('DELETE'), '{{ strtolower($model_name_kebab) }}/{id}', ['uses' => {{ $action_name }}{{ $model_name }}Controller::class])->middleware(['jwt.verify']);
