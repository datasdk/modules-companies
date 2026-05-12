<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sørg for at query params (GET) også bliver taget med i valideringen.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'vat' => $this->route('vat'),
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'sometimes|nullable|string|max:255',
            'middle_name' => 'sometimes|nullable|string|max:200',
            'last_name' => 'sometimes|nullable|string|max:255',
            'vat' => 'required|exists:companies,vat',
            'description' => 'sometimes|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'E-mail skal angives.',
            'email.email' => 'E-mail skal være gyldig.',
            'email.unique' => 'Denne e-mail er allerede registreret i systemet.',
            'first_name.string' => 'Fornavn skal være tekst.',
            'first_name.max' => 'Fornavn må højst være 255 tegn.',
            'middle_name.string' => 'Mellemnavn skal være tekst.',
            'middle_name.max' => 'Mellemnavn må højst være 200 tegn.',
            'last_name.string' => 'Efternavn skal være tekst.',
            'last_name.max' => 'Efternavn må højst være 255 tegn.',
            'vat.required' => 'CVR-nummer skal angives.',
            'vat.exists' => 'Den valgte virksomhed findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }

    /**
     * Optional: helper til at returnere data, som kan sendes til TeamInvitationService.
     */
    public function invitationData(): array
    {
        return [
            'email' => $this->email,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'description' => $this->description,
            'vat' => $this->vat,
        ];
    }
}
