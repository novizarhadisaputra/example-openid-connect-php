# Controllers

---

# Basic Controllers
To quickly generate a new controller, you may run the make:controller Artisan command. By default, all of the controllers for your application are stored in the app/Http/Controllers directory:
```php
php artisan make:controller InPatientController
```

```php
<?php
 
namespace App\Domain\V2\InPatient\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Domain\V2\InPatient\Services\InPatientService;
use App\Domain\V2\InPatient\Http\Requests\ShowInPatientRequest;
use App\Domain\V2\InPatient\Http\Requests\StoreInPatientRequest;
use App\Domain\V2\InPatient\Http\Resources\InPatientResource;
use App\Interfaces\Http\Controllers\ResponseTrait;
use Illuminate\Http\Request;
 
class InPatientController extends Controller
{
   use ResponseTrait;

    protected InPatientService $inPatientService;

    public function __construct(InPatientService $inPatientService)
    {
        $this->inPatientService = $inPatientService;
    }

    public function index(Request $request): InPatientResource
    {
        return $this->inPatientService->find($request->id);
    }

    public function show(ShowInPatientRequest $request): InPatientResource
    {
        return $this->inPatientService->findById($request->id);
    }

    public function store(StoreInPatientRequest $request): InPatientResource
    {
        return $this->inPatientService->create($request->input());
    }
}
```
Once you have written a controller class and method, you may define a route to the controller method like so:
```php
use App\Domain\V2\InPatient\Http\Controllers\InPatientController;
 
Route::get('/inpatient/{id}', [InPatientController::class, 'show']);
```
<br />

# Controller Middleware
Middleware may be assigned to the controller's routes in your route files:
```php
Route::get('inpatient/{id}', [InPatientController::class, 'show'])->middleware('auth');
```
<br />

# Resource Controllers
Laravel resource routing assigns the typical create, read, update, and delete ("CRUD") routes to a controller with a single line of code. To get started, we can use the make:controller Artisan command's --resource option to quickly create a controller to handle these actions:
```php
php artisan make:controller InPatientController --resource
```
This command will generate a controller at app/Http/Controllers/InPatientController.php. The controller will contain a method for each of the available resource operations. Next, you may register a resource route that points to the controller:
```php
use App\Domain\V2\InPatient\Http\Controllers\InPatientController;
 
Route::resource('photos', InPatientController::class);
```
<br />
