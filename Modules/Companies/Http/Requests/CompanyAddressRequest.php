<?php

namespace Modules\Companies\Http\Requests;

use Orion\Http\Requests\Request;

class CompanyAddressRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'street'      => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'state'       => 'sometimes|nullable|string|max:255',
            'post_code'   => 'required|string|max:20',
            'country'     => 'sometimes|nullable|string|max:2',
            'note'        => 'sometimes|nullable|string|max:500',
            'lat'         => 'sometimes|nullable|numeric',
            'lng'         => 'sometimes|nullable|numeric',
            'is_public'   => 'sometimes|boolean',
            'is_primary'  => 'sometimes|boolean',
            'is_billing'  => 'sometimes|boolean',
            'is_shipping' => 'sometimes|boolean',
        ];
    }

    public function updateRules(): array
    {
        return [
            'street'      => 'sometimes|string|max:255',
            'city'        => 'sometimes|string|max:255',
            'state'       => 'sometimes|nullable|string|max:255',
            'post_code'   => 'sometimes|string|max:20',
            'country'     => 'sometimes|nullable|string|max:2',
            'note'        => 'sometimes|nullable|string|max:500',
            'lat'         => 'sometimes|nullable|numeric',
            'lng'         => 'sometimes|nullable|numeric',
            'is_public'   => 'sometimes|boolean',
            'is_primary'  => 'sometimes|boolean',
            'is_billing'  => 'sometimes|boolean',
            'is_shipping' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'street.required' => 'Gadenavn skal angives.',
            'street.string'   => 'Gadenavn skal være tekst.',
            'city.required'   => 'By skal angives.',
            'city.string'     => 'By skal være tekst.',
            'post_code.required' => 'Postnummer skal angives.',
            'post_code.string'   => 'Postnummer skal være tekst.',
            'country.string'     => 'Landekode skal være tekst (fx DK).',
            'country.max'        => 'Landekoden må højst være 2 tegn.',
            'lat.numeric'        => 'Latitude skal være et tal.',
            'lng.numeric'        => 'Longitude skal være et tal.',
            'note.max'           => 'Noten må højst være 500 tegn lang.',
            'is_public.boolean'  => 'Offentlig status skal være sand eller falsk.',
            'is_primary.boolean' => 'Primær status skal være sand eller falsk.',
            'is_billing.boolean' => 'Faktura-status skal være sand eller falsk.',
            'is_shipping.boolean'=> 'Leverings-status skal være sand eller falsk.',
        ];
    }
}
