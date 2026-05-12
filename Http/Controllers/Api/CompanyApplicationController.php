<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Modules\Companies\Http\Requests\NewUserApplicationRequest;

use Modules\Companies\Http\Requests\ExistingUserApplicationRequest;

use Modules\Teams\Services\TeamApplicationService;

use Modules\Companies\Models\Companies;


class CompanyApplicationController extends Controller
{


    /**
     * Opret ny bruger + teamansøgning
     */
    public function newUser(NewUserApplicationRequest $request, string $vat)
    {

        $company = Companies::findByVat($vat);
        
        $team = $company->ensureHasTeam();

        $team_id = $team->id;


        $result = app(TeamApplicationService::class)->createForNewUser($request->all(), $$this->hasVat($company));


        return response()->json($result, $result['status']);

    }

    /**
     * Opret ansøgning for eksisterende bruger
     */
    public function existingUser(ExistingUserApplicationRequest $request, string $vat, int $userId)
    {


        $company = Companies::findByVat($vat);
        
        $team = $company->ensureHasTeam();

        $team_id = $team->id;


        $result = app(TeamApplicationService::class)->createForExistingUser($userId, $team_id, $request->input('description'));


        return response()->json($result, $result['status']);

    }

}
