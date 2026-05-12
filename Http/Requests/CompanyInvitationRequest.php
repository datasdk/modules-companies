<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Tillad alle autoriserede brugere — kan justeres efter behov
        return true;
    }

    /**
     * Sørg for at query params (GET) som ?vat=12345678&email=... 
     * også bliver medtaget ved validering.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'vat' => $this->route('vat'),
            'email' => $this->query('email', $this->input('email')),
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'vat' => 'required|string|max:20|exists:companies,vat',
            'description' => 'sometimes|nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            // Email
            'email.required' => 'E-mail skal angives.',
            'email.email' => 'E-mail skal være en gyldig adresse.',
            'email.max' => 'E-mail må højst være 255 tegn lang.',

            // CVR / VAT
            'vat.required' => 'CVR-nummer skal angives.',
            'vat.string' => 'CVR-nummer skal være tekst.',
            'vat.max' => 'CVR-nummer må højst være 20 tegn langt.',
            'vat.exists' => 'Den angivne virksomhed findes ikke i systemet.',

            // Beskrivelse
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 500 tegn.',
        ];
    }
}
