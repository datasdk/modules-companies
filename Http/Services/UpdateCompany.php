<?php

namespace Modules\Companies\Services;

use Modules\Companies\Models\Companies;

class CompanyUpdateService
{
    public function updateCompany(Companies $company, array $requestData)
    {
        $company->update([
            'name' => $requestData['name'],
            'vat' => $requestData['vat'],
            'is_primary' => isset($requestData['is_primary']) ? $requestData['is_primary'] : false,
        ]);

        // Opdater billedebehandling, adresseopsætning, kontaktinformation, osv.

        return $company;
    }
}
