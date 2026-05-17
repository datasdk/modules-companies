<?php

namespace Modules\Companies\Http\Controllers\Api;

use App\Http\Controllers\OrionBaseController;
use Illuminate\Http\Request as LaravelRequest;
use Orion\Http\Requests\Request;
use Modules\Companies\Http\Requests\CompanyRequest;
use Modules\Companies\Models\Companies;

class CompaniesController extends OrionBaseController
{

    protected $model = Companies::class;

    protected $request = CompanyRequest::class;
    
    
    protected $includes = [
        "addresses",
        "address",
        "contacts",
        "contact",
        "images",
        "team",
        "team.members",
        "team.members.roles",
        "team.groups",
        "owners",
        "members",
        "members.roles",
        "subsidiaries",
        "subsidiaries.address",
        "subsidiaries.contact",
        "subsidiaries.members",
     
    ];

    protected $exposedScopes = [
        "ownedBy"
    ];


    public function store(Request $req)
    {

        $data = $req->all();
        
        $company = Companies::create([
            "name" => ucfirst($data['name'] ?? ''),
            "vat" => $data['vat'] ?? null,
            "is_primary" => $data['is_primary'] ?? true,
        ]);

        // members and new_members will be added in 
        

        if ($req->has('members')) {
            $this->team->addUsersToTeam($req->members);
        }
 
        if ($req->has('new_members')) {
            $this->team->addNewMembers($company, $req->new_members);
        }

        if ($req->has('subsidiaries')) {
            $company->setSubsidiaries($req->subsidiaries);
        }


        return response()->json($company->refresh()->load($this->includes), 201);


    }


    public function update(Request $req, ...$args)
    {

        $id = $args[0];

        $company = Companies::findOrFail($id);

        $company->update($req->only(['name','vat','is_primary']));

      
        // Handle members
        if ($req->has('members')) {
            $this->syncMembers($company, $req->members);
        }

        // Handle new_members (append to existing members)
        if ($req->has('new_members')) {
            $this->addNewMembers($company, $req->new_members);
        }

        // Handle subsidiaries
        if ($req->has('subsidiaries')) {
            $company->setSubsidiaries($req->subsidiaries);
        }

        return $company->refresh()->load($this->includes);

    }


    /**
     * Sync members with roles for a company
     */
    protected function syncMembers(Companies $company, array $membersData)
    {
        // First, detach all current members
        $company->members()->detach();
        
        // Then attach new members with roles
        foreach ($membersData as $memberData) {
            if (isset($memberData['id'])) {
                $roleIds = $memberData['roles'] ?? [];
                
                $company->members()->attach($memberData['id'], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Sync roles for this member
                if (!empty($roleIds) && method_exists($company->members()->first(), 'roles')) {
                    $user = $company->members()->find($memberData['id']);
                    if ($user) {
                        $user->roles()->sync($roleIds);
                    }
                }
            }
        }
    }

    /**
     * Add new members to existing members
     */
    protected function addNewMembers(Companies $company, array $newMembersData)
    {

        foreach ($newMembersData as $memberData) {

            if (isset($memberData['id']) && !$company->members()->where('user_id', $memberData['id'])->exists()) {

                $roleIds = $memberData['roles'] ?? [];
                
                $company->members()->attach($memberData['id'], [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                // Sync roles for this member
                if (!empty($roleIds)) {

                    $user = $company->members()->find($memberData['id']);

                    if ($user && method_exists($user, 'roles')) {
                        $user->roles()->sync($roleIds);
                    }

                }

            }

        }

    }


    public function exists(Request $req, $vat)
    {

        return [
            "exists" => boolval(Companies::findByVat($vat))
        ];

    }

}
