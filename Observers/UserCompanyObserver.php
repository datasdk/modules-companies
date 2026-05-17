<<<<<<< HEAD
<?php

namespace Modules\Companies\Observers;

use App\Models\User;
use Modules\Companies\Http\Controllers\Api\CompaniesController;

class UserCompanyObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */


    protected $req;

 

    public function __construct(){
       
        $this->req = request();

    }


    public function created(User $user)
    {
        // Handling efter oprettelse af en ny bruger
        // f.eks. logning, udsendelse af email, osv.

        $req = $this->req;




        // Tilføj oplysninger til brugeren
      

    }
}
=======
<?php

namespace Modules\Companies\Observers;

use App\Models\User;
use Modules\Companies\Http\Controllers\Api\CompaniesController;

class UserCompanyObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */


    protected $req;

 

    public function __construct(){
       
        $this->req = request();

    }


    public function created(User $user)
    {
        // Handling efter oprettelse af en ny bruger
        // f.eks. logning, udsendelse af email, osv.

        $req = $this->req;




        // Tilføj oplysninger til brugeren
      

    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
