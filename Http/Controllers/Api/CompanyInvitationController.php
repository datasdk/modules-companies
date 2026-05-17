<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Companies\Http\Requests\NewUserInvitationRequest;
use Modules\Companies\Http\Requests\ExistingUserInvitationRequest;
use Modules\Companies\Models\Companies;
use Modules\Teams\Services\TeamInvitationService;

class CompanyInvitationController extends Controller
{
    /**
     * Inviter en ny bruger via e-mail (ny bruger).
     */
    public function newUser(NewUserInvitationRequest $request): JsonResponse
    {
        try {

            $data = $request->invitationData();

            $company = Companies::findByVat($data['vat']);

            if (!$company) {
                return response()->json([
                    'message' => 'Virksomhed med det angivne CVR findes ikke.'
                ], 404);
            }

            $team = $company->ensureHasTeam();

            $service = app(TeamInvitationService::class);

            $result = $service->invite([
                'email' => $data['email'],
                'first_name' => $data['first_name'] ?? null,
                'middle_name' => $data['middle_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'team_id' => $team->id,
                'description' => $data['description'] ?? null,
            ]);

            return response()->json($result, $result['status']);

        } catch (\Exception $e) {

            Log::error('Fejl ved invitation af ny bruger', [
                'user_id' => Auth::id(),
                'data' => $request->all(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved invitation af ny bruger.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }


    /**
     * Inviter eksisterende bruger via e-mail.
     */
    public function existingUser(ExistingUserInvitationRequest $request): JsonResponse
    {
        try {

            $data = $request->invitationData();

            $company = Companies::findByVat($data['vat']);

            if (!$company) {
                return response()->json([
                    'message' => 'Virksomhed med det angivne CVR findes ikke.'
                ], 404);
            }

            $team = $company->ensureHasTeam();

            $service = app(TeamInvitationService::class);

            $result = $service->invite([
                'email' => null,
                'user_id' => $data['user_id'],
                'team_id' => $team->id,
                'description' => $data['description'] ?? null,
            ]);

            return response()->json($result, $result['status']);

        } catch (\Exception $e) {

            Log::error('Fejl ved invitation af eksisterende bruger', [
                'user_id' => Auth::id(),
                'invited_user_id' => $request->input('user_id'),
                'vat' => $request->input('vat'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved invitation af eksisterende bruger.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }


    /**
     * Vis en invitation ud fra UID (fx til accept-side)
     */
    public function showByUid(string $uid): JsonResponse
    {
        try {

            $service = app(TeamInvitationService::class);

            $invitation = $service->findByUid($uid);

            if (!$invitation) {
                return response()->json([
                    'message' => 'Invitationen blev ikke fundet.'
                ], 404);
            }

            return response()->json([
                'invitation' => $invitation,
                'team' => $invitation->team ?? null,
            ]);

        } catch (\Exception $e) {

            Log::error('Fejl ved hentning af invitation', [
                'uid' => $uid,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved hentning af invitation.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
=======
<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Companies\Http\Requests\NewUserInvitationRequest;
use Modules\Companies\Http\Requests\ExistingUserInvitationRequest;
use Modules\Companies\Models\Companies;
use Modules\Teams\Services\TeamInvitationService;

class CompanyInvitationController extends Controller
{
    /**
     * Inviter en ny bruger via e-mail (ny bruger).
     */
    public function newUser(NewUserInvitationRequest $request): JsonResponse
    {
        try {

            $data = $request->invitationData();

            $company = Companies::findByVat($data['vat']);

            if (!$company) {
                return response()->json([
                    'message' => 'Virksomhed med det angivne CVR findes ikke.'
                ], 404);
            }

            $team = $company->ensureHasTeam();

            $service = app(TeamInvitationService::class);

            $result = $service->invite([
                'email' => $data['email'],
                'first_name' => $data['first_name'] ?? null,
                'middle_name' => $data['middle_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'team_id' => $team->id,
                'description' => $data['description'] ?? null,
            ]);

            return response()->json($result, $result['status']);

        } catch (\Exception $e) {

            Log::error('Fejl ved invitation af ny bruger', [
                'user_id' => Auth::id(),
                'data' => $request->all(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved invitation af ny bruger.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }


    /**
     * Inviter eksisterende bruger via e-mail.
     */
    public function existingUser(ExistingUserInvitationRequest $request): JsonResponse
    {
        try {

            $data = $request->invitationData();

            $company = Companies::findByVat($data['vat']);

            if (!$company) {
                return response()->json([
                    'message' => 'Virksomhed med det angivne CVR findes ikke.'
                ], 404);
            }

            $team = $company->ensureHasTeam();

            $service = app(TeamInvitationService::class);

            $result = $service->invite([
                'email' => null,
                'user_id' => $data['user_id'],
                'team_id' => $team->id,
                'description' => $data['description'] ?? null,
            ]);

            return response()->json($result, $result['status']);

        } catch (\Exception $e) {

            Log::error('Fejl ved invitation af eksisterende bruger', [
                'user_id' => Auth::id(),
                'invited_user_id' => $request->input('user_id'),
                'vat' => $request->input('vat'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved invitation af eksisterende bruger.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }


    /**
     * Vis en invitation ud fra UID (fx til accept-side)
     */
    public function showByUid(string $uid): JsonResponse
    {
        try {

            $service = app(TeamInvitationService::class);

            $invitation = $service->findByUid($uid);

            if (!$invitation) {
                return response()->json([
                    'message' => 'Invitationen blev ikke fundet.'
                ], 404);
            }

            return response()->json([
                'invitation' => $invitation,
                'team' => $invitation->team ?? null,
            ]);

        } catch (\Exception $e) {

            Log::error('Fejl ved hentning af invitation', [
                'uid' => $uid,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Der opstod en fejl ved hentning af invitation.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
