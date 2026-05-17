<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExistingUserInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sørg for at query params (GET) også bliver en del af input til validatoren.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->query('user_id', $this->input('user_id')),
            'vat' => $this->route('vat'),
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'vat' => 'required|exists:companies,vat',
            'description' => 'sometimes|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Bruger-ID skal angives.',
            'user_id.exists' => 'Den valgte bruger findes ikke.',
            'vat.required' => 'CVR-nummer skal angives.',
            'vat.exists' => 'Den valgte virksomhed findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }

    /**
     * Optional helper til at returnere data til TeamInvitationService
     */
    public function invitationData(): array
    {
        return [
            'user_id' => $this->user_id,
            'vat' => $this->vat,
            'description' => $this->description,
        ];
    }
}
=======
<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExistingUserInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sørg for at query params (GET) også bliver en del af input til validatoren.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->query('user_id', $this->input('user_id')),
            'vat' => $this->route('vat'),
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'vat' => 'required|exists:companies,vat',
            'description' => 'sometimes|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Bruger-ID skal angives.',
            'user_id.exists' => 'Den valgte bruger findes ikke.',
            'vat.required' => 'CVR-nummer skal angives.',
            'vat.exists' => 'Den valgte virksomhed findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }

    /**
     * Optional helper til at returnere data til TeamInvitationService
     */
    public function invitationData(): array
    {
        return [
            'user_id' => $this->user_id,
            'vat' => $this->vat,
            'description' => $this->description,
        ];
    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
