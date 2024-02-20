# Routing

---

# Basic Routing
The most basic Laravel routes accept a URI and a closure, providing a very simple and expressive method of defining routes and behavior without complicated routing configuration files:
```php
use Illuminate\Support\Facades\Route;
 
Route::get('/greeting', function () {
    return 'Hello World';
});
Route::get('/user', [UserController::class, 'index']);
```
<br />

# Available Router Methods
The router allows you to register routes that respond to any HTTP verb:
```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```
<br />

# The Route List
The route:list Artisan command can easily provide an overview of all of the routes that are defined by your application:
```php
php artisan route:list
```
