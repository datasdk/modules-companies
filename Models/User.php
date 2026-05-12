<?php

namespace Modules\Companies\Models;

use App\Models\User as OrigUser;
use Modules\Teams\Support\Pivot\TeamUser;
use Modules\Companies\Models\Companies;
use Modules\Teams\Models\User as OrigTeamUser;

class User extends OrigTeamUser
{


    /**
     * 🔗 Alle virksomheder brugeren er tilknyttet via teams_users
     */
    public function companies()
    {

        return $this->hasManyThrough(
            Companies::class,   // Endelig model
            TeamUser::class,    // Pivot/through-model
            'user_id',          // teams_users.user_id → users.id
            'team_id',          // companies.team_id → teams_users.team_id
            'id',               // local key på users
            'team_id'           // local key på teams_users
        );

    }


    /**
     * 🔗 Én virksomhed (første aktive)
     */
    public function company()
    {

        return $this->hasOneThrough(
            Companies::class,
            TeamUser::class,
            'user_id',     // teams_users.user_id → users.id
            'team_id',     // companies.team_id → teams_users.team_id
            'id',          // local key på users
            'team_id'      // local key på teams_users
        )->where('companies.active', true);

    }


    /**
     * Fjern en virksomhed fra brugeren
     */
    public function detachCompany($company)
    {
        TeamUser::where('user_id', $this->id)
                ->where('team_id', $company->team_id)
                ->delete();
    }


    /**
     * Tilføj en virksomhed (tilknytning)
     */
    public function attachCompany($company, ?int $role_id = null)
    {
        TeamUser::firstOrCreate([
            'user_id' => $this->id,
            'team_id' => $company->team_id,
        ], [
            'role_id' => $role_id,
        ]);
    }


}
