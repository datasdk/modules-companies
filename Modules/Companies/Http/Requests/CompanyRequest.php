<?php

namespace Modules\Companies\Http\Requests;

use Orion\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CompanyRequest extends Request
{
    /**
     * Klargør data før validering
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('new_members') && is_array($this->new_members)) {
            $members = collect($this->new_members)->map(function ($member) {
                // Fjern password, hvis invite=true
                if (!empty($member['invite']) && $member['invite'] === true) {
                    unset($member['password']);
                }
                return $member;
            });
            $this->merge(['new_members' => $members->toArray()]);
        }
    }

    /**
     * Store validation rules
     */
    public function storeRules(): array
    {
        return [
            // Logo
            'logo_file' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'sometimes|nullable|exists:media,original_media_id',

            // Company
            'name' => 'required|string',
            'vat' => 'required|unique:companies,vat',

            // Single Address (optional)
            'address' => 'sometimes|nullable|array',
            'address.street' => 'required_with:address',
            'address.post_code' => 'required_with:address',
            'address.city' => 'required_with:address',
            //'address.country_id' => 'required_with:address',

            // Single Contact (optional)
            'contact' => 'sometimes|nullable|array',
            'contact.email' => 'required_with:contact|email',
            'contact.phone' => 'required_with:contact|string',

            // Owners
            'owner' => 'sometimes|nullable|int|exists:users,id',

            // Members (existing)
            'members' => 'sometimes|array',
            'members.*.id' => 'required|int|exists:users,id',
            'members.*.role_id' => 'sometimes|nullable|exists:roles,id',

            // New Members
            'new_members' => 'sometimes|array',
            'new_members.*.first_name' => 'required|string',
            'new_members.*.last_name' => 'required|string',
            'new_members.*.email' => 'required|email|unique:users,email',
            'new_members.*.phone' => 'sometimes|string',
            'new_members.*.invite' => 'sometimes|boolean',
            'new_members.*.password' => 'required_unless:new_members.*.invite,true|string|min:6',
            'new_members.*.role_id' => 'sometimes|nullable|exists:roles,id',

            // Other
            'settings' => 'sometimes',
            'subsidiaries' => 'sometimes|array',
            'subsidiaries.*' => [
                'required',
                Rule::notIn([$this->route('company')]),
                Rule::exists('companies', 'id')->whereNull('parent_id')
            ],

            'is_primary' => 'sometimes|int',
            'active' => 'sometimes|int',
        ];
    }

    /**
     * Update validation rules
     */
    public function updateRules(): array
    {
        $id = $this->route('company');

        return [
            // Logo
            'logo_file' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'sometimes|nullable|exists:media,original_media_id',

            // Company
            'name' => 'sometimes|filled|string',
            'vat' => 'sometimes|filled|unique:companies,vat,' . $id . ',id',

            // Single Address
            'address' => 'sometimes|nullable|array',
            'address.street' => 'required_with:address',
            'address.post_code' => 'required_with:address',
            'address.city' => 'required_with:address',
           // 'address.country_id' => 'required_with:address',

            // Single Contact
            'contact' => 'sometimes|nullable|array',
            'contact.email' => 'sometimes',
            'contact.phone' => 'sometimes',

            // Owners
            'owner' => 'sometimes|nullable|int|exists:users,id',

            // Members (existing)
            'members' => 'sometimes|array',
            'members.*.id' => 'required|int|exists:users,id',
            'members.*.role_id' => 'sometimes|nullable|exists:roles,id',

            // New Members
            'new_members' => 'sometimes|array',
            'new_members.*.first_name' => 'required|string',
            'new_members.*.last_name' => 'required|string',
            'new_members.*.email' => 'required|email|unique:users,email',
            'new_members.*.phone' => 'sometimes|string',
            'new_members.*.invite' => 'sometimes|boolean',
            'new_members.*.password' => 'required_unless:new_members.*.invite,true|string|min:6',
            'new_members.*.role_id' => 'sometimes|nullable|exists:roles,id',

            // Other
            'settings' => 'sometimes',
            'user_id' => 'sometimes',
            'subsidiaries' => 'sometimes|array',
            'subsidiaries.*' => [
                'required',
                Rule::notIn([$id]),
                Rule::exists('companies', 'id')->where(function ($query) use ($id) {
                    $query->whereNull('parent_id')->orWhere('parent_id', $id);
                }),
            ],

            'is_primary' => 'sometimes|int',
            'active' => 'sometimes|int',
        ];
    }

    /**
     * Validation messages
     */
    public function messages(): array
    {
        return [
            'logo_file.image' => 'Logoet skal være et billede (jpeg, png eller jpg).',
            'logo_file.mimes' => 'Logoet skal være i formatet jpeg, png eller jpg.',
            'logo_file.max' => 'Logoet må højst fylde 2MB.',
            'logo.exists' => 'Det valgte logo findes ikke i mediearkivet.',

            'name.required' => 'Firmanavnet skal angives.',
            'name.unique' => 'Firmanavnet er allerede i brug.',
            'vat.required' => 'CVR-nummeret skal angives.',
            'vat.unique' => 'Dette CVR-nummer er allerede registreret.',

            'address.street.required_with' => 'Gadenavn skal angives, når address er udfyldt.',
            'address.post_code.required_with' => 'Postnummer skal angives, når address er udfyldt.',
            'address.city.required_with' => 'By skal angives, når address er udfyldt.',
           // 'address.country_id.required_with' => 'Land skal angives, når address er udfyldt.',

            'contact.email.required_with' => 'E-mail skal angives.',
            'contact.email.email' => 'Indtast en gyldig e-mailadresse.',
            'contact.phone.required_with' => 'Telefonnummer skal angives, når contact er udfyldt.',

            'owner.int' => 'Owner skal være et ID.',
            'owner.exists' => 'Den valgte ejer findes ikke.',

            'members.array' => 'Medlemmer skal angives som en liste.',
            'members.*.id.required' => 'Hvert medlem skal have et ID.',
            'members.*.id.exists' => 'Et eller flere valgte medlemmer findes ikke.',
            'members.*.role_id.required' => 'Hvert medlem skal have en rolle.',
            'members.*.role_id.exists' => 'Den valgte rolle findes ikke.',

            'new_members.array' => 'Nye medlemmer skal angives som en liste.',
            'new_members.*.first_name.required' => 'Fornavn skal angives for alle nye medlemmer.',
            'new_members.*.last_name.required' => 'Efternavn skal angives for alle nye medlemmer.',
            'new_members.*.email.required' => 'E-mail skal angives for alle nye medlemmer.',
            'new_members.*.email.email' => 'Indtast en gyldig e-mailadresse for nye medlemmer.',
            'new_members.*.email.unique' => 'Denne e-mail er allerede registreret.',
            'new_members.*.invite.boolean' => 'Feltet "invite" skal være sandt eller falsk.',
            'new_members.*.password.required_unless' => 'Adgangskode er påkrævet, medmindre brugeren selv skal vælge adgangskode (invite = true).',
            'new_members.*.password.min' => 'Adgangskoden skal mindst være 6 tegn.',
            'new_members.*.role_id.exists' => 'Den valgte rolle findes ikke.',

            'subsidiaries.array' => 'Dattervirksomheder skal angives som en liste.',
            'subsidiaries.*.required' => 'Hver dattervirksomhed skal angives.',
            'subsidiaries.*.exists' => 'En eller flere valgte dattervirksomheder findes ikke eller har allerede en overordnet virksomhed.',
            'subsidiaries.*.not_in' => 'En virksomhed kan ikke være datterselskab til sig selv.',

            'is_primary.integer' => 'Primærstatus skal være et tal.',
            'active.integer' => 'Aktivstatus skal være et tal.',
        ];
    }
}
