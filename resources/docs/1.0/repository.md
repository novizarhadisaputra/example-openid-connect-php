# Repository Pattern

---

# Create a User Repository Interface
Start by defining an interface that outlines the methods your repository will implement. This interface will act as a contract for all repositories in your application.

```php
namespace App\Domain\V2\InPatient\Repositories\Contracts;

interface UserInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
```
<br />

# Create a User Repository
Next, create a base repository class that implements the interface. This class will contain common methods shared among all repositories.
```php
namespace App\Domain\V2\InPatient\Repositories;

use App\Domain\V2\InPatient\Entities\InPatientEntity;

class UserRepository implements UserInterface
{
    protected $inPatientEntity;

    public function __construct(InPatientEntity $inPatientEntity)
    {
        $this->inPatientEntity = $inPatientEntity;
    }

    public function all()
    {
        return $this->inPatientEntity->all();
    }

    public function find($id)
    {
        return $this->inPatientEntity->find($id);
    }

    public function create(array $data)
    {
        return $this->inPatientEntity->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->inPatientEntity->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        return $this->inPatientEntity->destroy($id);
    }
}
```
<br />

# Bind the Repositories in Service Providers
In the AppServiceProvider (app/Providers/AppServiceProvider.php) or a dedicated service provider, you can bind your interfaces to their corresponding implementations. This allows you to use dependency injection in your controllers or services.

```php
use App\Repositories\Contracts\UserInterface;
use App\Repositories\UserRepository;

public function register()
{
    $this->app->bind(UserInterface::class, UserRepository::class);
}
```
<br />
