<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;

class MemberFormCreateUser extends Component
{
    public $user = [
        'first_name' => '',
        'middle_name' => '',
        'last_name' => '',
        'email' => '',
        'invite' => false,
        'password' => '',
        'contact' => [
            'phone' => ''
        ],
    ];

    public function mount($value = [])
    {
        $this->user = array_replace_recursive($this->user, $value);
    }

    public function updatedUser()
    {
        $this->emitUp('update:user', $this->user);
    }

    public function getShowPasswordProperty()
    {
        return !$this->user['invite'];
    }

    public function render()
    {
        return view('companies::livewire.member-form-create-user');
    }
}
