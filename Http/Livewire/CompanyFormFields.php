<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;
use Modules\Companies\Models\Companies;

class CompanyFormFields extends Component
{
    public $company = [
        'name' => '',
        'vat' => '',
        'images' => [],
    ];

    protected $rules = [
        'company.name' => 'required|string',
        'company.vat' => 'nullable|string',
        'company.images' => 'nullable|array',
    ];

    public function mount(Companies $company = null)
    {
        $this->company = [
            'name' => old('name') ?? ($company->name ?? ''),
            'vat' => old('vat') ?? ($company->vat ?? ''),
            'images' => old('images') ?? ($company->images ?? []),
        ];
    }

    public function updatedCompany($value, $key)
    {
        // Evt. auto-save eller log
    }

    public function save()
    {
        $this->validate();

        if (isset($this->company['id'])) {
            $model = Companies::find($this->company['id']);
            $model->update([
                'name' => $this->company['name'],
                'vat' => $this->company['vat'],
                'images' => $this->company['images'],
            ]);
        } else {
            $model = Companies::create([
                'name' => $this->company['name'],
                'vat' => $this->company['vat'],
                'images' => $this->company['images'],
            ]);
        }

        session()->flash('success', 'Firma gemt!');
        $this->emit('companySaved', $model->id);
    }

    public function render()
    {
        return view('companies::livewire.company-form-fields');
    }
}
