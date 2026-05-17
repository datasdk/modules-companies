<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Models\Companies;
use App\Models\User;

class ExistingUserApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Valider company via route parameter - bruger 'vat' som i route definition
            $vat = $this->route('vat');
            
            // Valider user via route parameter - bruger 'user_id' som i route definition
            $userId = $this->route('user_id'); // Ændret fra 'userId' til 'user_id'
            
            // Debug hvis nødvendigt
            // dd([
            //     'vat' => $vat,
            //     'user_id' => $userId,
            //     'all_params' => $this->route()->parameters()
            // ]);
            
            // Valider company
            if ($vat) {
                $company = Companies::findByVat($vat);
                if (!$company) {
                    $validator->errors()->add('vat', 'CVR-nummeret findes ikke.');
                }
            }
            
            // Valider user
            if ($userId) {
                $user = User::find($userId);
                if (!$user) {
                    $validator->errors()->add('user_id', 'Brugeren findes ikke.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'vat' => 'CVR-nummeret findes ikke.',
            'user_id' => 'Brugeren findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }
=======
<?php

namespace Modules\Companies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Models\Companies;
use App\Models\User;

class ExistingUserApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Valider company via route parameter - bruger 'vat' som i route definition
            $vat = $this->route('vat');
            
            // Valider user via route parameter - bruger 'user_id' som i route definition
            $userId = $this->route('user_id'); // Ændret fra 'userId' til 'user_id'
            
            // Debug hvis nødvendigt
            // dd([
            //     'vat' => $vat,
            //     'user_id' => $userId,
            //     'all_params' => $this->route()->parameters()
            // ]);
            
            // Valider company
            if ($vat) {
                $company = Companies::findByVat($vat);
                if (!$company) {
                    $validator->errors()->add('vat', 'CVR-nummeret findes ikke.');
                }
            }
            
            // Valider user
            if ($userId) {
                $user = User::find($userId);
                if (!$user) {
                    $validator->errors()->add('user_id', 'Brugeren findes ikke.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'vat' => 'CVR-nummeret findes ikke.',
            'user_id' => 'Brugeren findes ikke.',
            'description.string' => 'Beskrivelsen skal være tekst.',
            'description.max' => 'Beskrivelsen må højst være 1000 tegn.',
        ];
    }
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
}