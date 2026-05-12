<?php

namespace Modules\Companies\Services;

use Modules\Companies\Models\Companies;

class CompanyCreationService
{
    public function createCompany(array $requestData)
    {
       

         $c = Companies::create(
            $req->only("name","vat","is_primary")
         );
         
   


        $c->setAddress( $req->address ); 

        $c->setContact( $req->contact );         
            

        return $c->load("address","contact");
    }
}
