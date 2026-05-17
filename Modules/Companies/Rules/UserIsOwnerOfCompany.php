<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Companies\Models\Companies;


class UserIsOwnerOfCompany implements Rule
{
    protected $companyId;
    protected $userId;

    public function __construct($companyId,$userId)
    {
        $this->companyId = $companyId;
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
       return true;
        // $value repræsenterer user_id i denne sammenhæng.
        $company = Companies::find($this->companyId);

        if (!$company) {
            return false; // Return false hvis virksomheden ikke findes.
        }

        return $company->hasOwner($this->userId);

    }

    public function message()
    {
        return 'The selected user is not an owner of the specified company.';
    }
}
