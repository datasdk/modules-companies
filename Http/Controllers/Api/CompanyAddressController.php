<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\OrionRelationController;
use Orion\Http\Requests\Request as OrionRequest;
use Modules\Companies\Models\Companies;
use Lecturize\Addresses\Models\Address;
use Illuminate\Support\Facades\Schema;
use Modules\Companies\Http\Requests\CompanyAddressRequest;

class CompanyAddressController extends OrionRelationController
{
    protected $model = Companies::class;
    protected $relation = 'addresses';
    protected $request = CompanyAddressRequest::class;

    /**
     * Tilføj en ny adresse til virksomheden.
     */
    public function store(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $addressData = $this->filterAddressData($request->all());

        if (empty($addressData)) {
            return response()->json(['message' => 'Ingen gyldige adressefelter angivet.'], 422);
        }

        // Sæt adresse og generér evt. geodata
        $company->setAddress($addressData);

        return response()->json($company->load('addresses')->toArray(), 201);
    }

    /**
     * Opdater en eksisterende adresse for virksomheden.
     */
    public function update(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $address = $company->addresses()->findOrFail($arg[1]); // Ret $address_id til $arg[1]

        $addressData = $this->filterAddressData($request->all());

        if (empty($addressData)) {
            return response()->json(['message' => 'Ingen gyldige adressefelter angivet.'], 422);
        }

        $company->updateAddress($address, $addressData);

        return response()->json($company->load('addresses')->toArray(), 200);
    }

    /**
     * Slet en adresse fra virksomheden.
     */
    public function destroy(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $address = $company->addresses()->findOrFail($arg[1]); // Ret $address_id til $arg[1]

        $address->delete();

        return response()->json([
            'message' => 'Adresse slettet.',
            'deleted' => true
        ], 200);
    }

    /**
     * Filtrér input og behold kun gyldige felter i addresses-tabellen.
     */
    protected function filterAddressData(array $data): array
    {
        $columns = Schema::getColumnListing('addresses');
        $address = collect($data)->only($columns)->toArray();

        // Sæt defaults
        if (empty($address['country'])) {
            $address['country'] = 'dk';
        }

        if (!isset($address['is_primary'])) {
            $address['is_primary'] = false;
        }

        return $address;
    }
=======
<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\OrionRelationController;
use Orion\Http\Requests\Request as OrionRequest;
use Modules\Companies\Models\Companies;
use Lecturize\Addresses\Models\Address;
use Illuminate\Support\Facades\Schema;
use Modules\Companies\Http\Requests\CompanyAddressRequest;

class CompanyAddressController extends OrionRelationController
{
    protected $model = Companies::class;
    protected $relation = 'addresses';
    protected $request = CompanyAddressRequest::class;

    /**
     * Tilføj en ny adresse til virksomheden.
     */
    public function store(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $addressData = $this->filterAddressData($request->all());

        if (empty($addressData)) {
            return response()->json(['message' => 'Ingen gyldige adressefelter angivet.'], 422);
        }

        // Sæt adresse og generér evt. geodata
        $company->setAddress($addressData);

        return response()->json($company->load('addresses')->toArray(), 201);
    }

    /**
     * Opdater en eksisterende adresse for virksomheden.
     */
    public function update(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $address = $company->addresses()->findOrFail($arg[1]); // Ret $address_id til $arg[1]

        $addressData = $this->filterAddressData($request->all());

        if (empty($addressData)) {
            return response()->json(['message' => 'Ingen gyldige adressefelter angivet.'], 422);
        }

        $company->updateAddress($address, $addressData);

        return response()->json($company->load('addresses')->toArray(), 200);
    }

    /**
     * Slet en adresse fra virksomheden.
     */
    public function destroy(OrionRequest $request, ...$arg)
    {
        $company = Companies::findOrFail($arg[0]);
        $address = $company->addresses()->findOrFail($arg[1]); // Ret $address_id til $arg[1]

        $address->delete();

        return response()->json([
            'message' => 'Adresse slettet.',
            'deleted' => true
        ], 200);
    }

    /**
     * Filtrér input og behold kun gyldige felter i addresses-tabellen.
     */
    protected function filterAddressData(array $data): array
    {
        $columns = Schema::getColumnListing('addresses');
        $address = collect($data)->only($columns)->toArray();

        // Sæt defaults
        if (empty($address['country'])) {
            $address['country'] = 'dk';
        }

        if (!isset($address['is_primary'])) {
            $address['is_primary'] = false;
        }

        return $address;
    }
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
}