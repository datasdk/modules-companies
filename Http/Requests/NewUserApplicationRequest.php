<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserApplicationRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'sometimes|nullable|string|max:200',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'vat' => 'required|exists:companies,vat',
            'description' => 'sometimes|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Fornavn skal angives.',
            'first_name.string' => 'Fornavn skal være tekst.',
            'first_name.max' => 'Fornavn må højst være 255 tegn.',
            'middle_name.string' => 'Mellemnavn skal være tekst.',
            'middle_name.max' => 'Mellemnavn må højst være 200 tegn.',
            'last_name.required' => 'Efternavn skal angives.',
            'last_name.string' => 'Efternavn skal være tekst.',
            'last_name.max' => 'Efternavn må højst være 255 tegn.',
            'email.required' => 'E-mail skal angives.',
            'email.email' => 'E-mail skal være gyldig.',
            'email.unique' => 'E-mailen er allerede i brug.',
            'password.required' => 'Kodeord skal angives.',
            'password.min' => 'Kodeord skal være mindst 8 tegn.',
            'password.confirmed' => 'Kodeordet matcher ikke bekræftelsen.',
            'vat.required' => 'CVR-nummer skal angives.',
            'vat.exists' => 'Den valgte virksomhed findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }

    /**
     * Optional: helper til at returnere samlet array til UserService.
     */
    public function userData(): array
    {
        return [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
