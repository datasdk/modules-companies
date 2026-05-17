<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Requests;

use Orion\Http\Requests\Request;

class UserCompanyRequest extends Request
{
    public function storeRules(): array
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",

            "password" => "required_without:random_password|min:6",

            "role" => "sometimes|exclude_if:role,0|int|exists:roles,id",

            "address.street" => "sometimes|nullable",
            "address.post_code" => "required_with:street|nullable",
            "address.city" => "required_with:street|nullable",
            "address.country" => "sometimes",

            "contact" => "sometimes|nullable|array",
            "contact.email" => "sometimes|email",
            "contact.phone" => "sometimes",
        ];
    }

    public function updateRules(): array
    {
        // Antager at 'user' er route-parameteren med brugerens ID
        $userId = $this->route('user');

        return [
            "first_name" => "sometimes",
            "last_name" => "sometimes",
            // Exkluder nuværende bruger ID i unique validering
            "email" => "sometimes|email|unique:users,email," . $userId,

            "password" => "sometimes|min:6",

            "role" => "sometimes|exclude_if:role,0|int|exists:roles,id",

            "address.street" => "sometimes|nullable",
            "address.post_code" => "required_with:street|nullable",
            "address.city" => "required_with:street|nullable",
            "address.country" => "sometimes",

            "contact" => "sometimes|nullable|array",
            "contact.email" => "sometimes|email",
            "contact.phone" => "sometimes",
        ];
    }
}
=======
<?php

namespace Modules\Companies\Http\Requests;

use Orion\Http\Requests\Request;

class UserCompanyRequest extends Request
{
    public function storeRules(): array
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",

            "password" => "required_without:random_password|min:6",

            "role" => "sometimes|exclude_if:role,0|int|exists:roles,id",

            "address.street" => "sometimes|nullable",
            "address.post_code" => "required_with:street|nullable",
            "address.city" => "required_with:street|nullable",
            "address.country" => "sometimes",

            "contact" => "sometimes|nullable|array",
            "contact.email" => "sometimes|email",
            "contact.phone" => "sometimes",
        ];
    }

    public function updateRules(): array
    {
        // Antager at 'user' er route-parameteren med brugerens ID
        $userId = $this->route('user');

        return [
            "first_name" => "sometimes",
            "last_name" => "sometimes",
            // Exkluder nuværende bruger ID i unique validering
            "email" => "sometimes|email|unique:users,email," . $userId,

            "password" => "sometimes|min:6",

            "role" => "sometimes|exclude_if:role,0|int|exists:roles,id",

            "address.street" => "sometimes|nullable",
            "address.post_code" => "required_with:street|nullable",
            "address.city" => "required_with:street|nullable",
            "address.country" => "sometimes",

            "contact" => "sometimes|nullable|array",
            "contact.email" => "sometimes|email",
            "contact.phone" => "sometimes",
        ];
    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
