<?php

namespace Modules\Companies\Http\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\User;

trait CompanyScopes
{
    /**
     * Begræns til virksomheder ejet af brugeren.
     */
    public static function scopeOwnedBy(Builder $query, int $user_id): Builder
    {
      
        return $query->whereHas('members', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        });
    }

 
    /**
     * Returner kun den primære virksomhed.
     */
    public static function primary(Builder $query): Builder
    {
        return $query->where('is_primary', 1);
    }

}
