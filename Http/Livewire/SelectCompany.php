<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;
use Modules\Companies\Models\Companies as Company;

class SelectCompany extends Component
{
    public $searchSubsidiary = null;
    public $excludes = [];
    public $searchtext = '';
    public $companies = [];
    public $loading = false;
    public $main_loading = false;
    public $company = null;
    public $notFound = false;
    public $minChars = 2;

    // For Livewire 2.x
    protected $listeners = ['updateSelectedCompany' => 'updateSelectedCompany'];

    public function mount($searchSubsidiary = null, $excludes = [])
    {
        $this->searchSubsidiary = $searchSubsidiary;
        $this->excludes = $excludes;
        
        if ($searchSubsidiary) {
            $this->main_loading = true;
            $this->loadCompanyById($searchSubsidiary);
        }
    }

    public function updatedSearchSubsidiary($value)
    {
        if ($value && !$this->company) {
            $this->main_loading = true;
            $this->loadCompanyById($value);
        } elseif (!$value && $this->company) {
            $this->resetCompany();
        }
    }

    public function updateSelectedCompany($companyId)
    {
        if ($companyId) {
            $this->loadCompanyById($companyId);
        } else {
            $this->resetCompany();
        }
    }

    public function loadCompanyById($id)
    {
        $company = Company::find($id);
        
        if ($company) {
            $this->company = $company;
            $this->searchSubsidiary = $company->id;
            $this->notFound = false;
        } else {
            $this->notFound = true;
            $this->company = null;
            $this->searchSubsidiary = null;
        }
        
        $this->main_loading = false;
    }

    public function updatedSearchtext($value)
    {
        if (strlen($value) < $this->minChars) {
            $this->companies = [];
            return;
        }

        $this->loading = true;
        
        $query = Company::query();
        
        if (!empty($this->excludes)) {
            $query->whereNotIn('id', $this->excludes);
        }
        
        $this->companies = $query->where(function($q) use ($value) {
                $q->where('name', 'like', "%{$value}%")
                  ->orWhere('vat', 'like', "%{$value}%");
            })
            ->limit(10)
            ->get();
        
        $this->loading = false;
    }

    public function choose($id)
    {
        $company = Company::find($id);
        
        if ($company) {
            $this->company = $company;
            $this->searchSubsidiary = $company->id;
            $this->searchtext = '';
            $this->companies = [];
            $this->notFound = false;
            
            // Livewire 2.x: Brug $this->emit()
            $this->emit('companySelected', $company->id);
        }
    }

    public function remove()
    {
        $this->resetCompany();
        // Livewire 2.x: Brug $this->emit()
        $this->emit('companyRemoved');
    }

    public function resetCompany()
    {
        $this->company = null;
        $this->searchSubsidiary = null;
        $this->searchtext = '';
        $this->companies = [];
        $this->notFound = false;
    }

    public function render()
    {
        return view('companies::livewire.select-company');
    }
=======
<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;
use Modules\Companies\Models\Companies as Company;

class SelectCompany extends Component
{
    public $searchSubsidiary = null;
    public $excludes = [];
    public $searchtext = '';
    public $companies = [];
    public $loading = false;
    public $main_loading = false;
    public $company = null;
    public $notFound = false;
    public $minChars = 2;

    // For Livewire 2.x
    protected $listeners = ['updateSelectedCompany' => 'updateSelectedCompany'];

    public function mount($searchSubsidiary = null, $excludes = [])
    {
        $this->searchSubsidiary = $searchSubsidiary;
        $this->excludes = $excludes;
        
        if ($searchSubsidiary) {
            $this->main_loading = true;
            $this->loadCompanyById($searchSubsidiary);
        }
    }

    public function updatedSearchSubsidiary($value)
    {
        if ($value && !$this->company) {
            $this->main_loading = true;
            $this->loadCompanyById($value);
        } elseif (!$value && $this->company) {
            $this->resetCompany();
        }
    }

    public function updateSelectedCompany($companyId)
    {
        if ($companyId) {
            $this->loadCompanyById($companyId);
        } else {
            $this->resetCompany();
        }
    }

    public function loadCompanyById($id)
    {
        $company = Company::find($id);
        
        if ($company) {
            $this->company = $company;
            $this->searchSubsidiary = $company->id;
            $this->notFound = false;
        } else {
            $this->notFound = true;
            $this->company = null;
            $this->searchSubsidiary = null;
        }
        
        $this->main_loading = false;
    }

    public function updatedSearchtext($value)
    {
        if (strlen($value) < $this->minChars) {
            $this->companies = [];
            return;
        }

        $this->loading = true;
        
        $query = Company::query();
        
        if (!empty($this->excludes)) {
            $query->whereNotIn('id', $this->excludes);
        }
        
        $this->companies = $query->where(function($q) use ($value) {
                $q->where('name', 'like', "%{$value}%")
                  ->orWhere('vat', 'like', "%{$value}%");
            })
            ->limit(10)
            ->get();
        
        $this->loading = false;
    }

    public function choose($id)
    {
        $company = Company::find($id);
        
        if ($company) {
            $this->company = $company;
            $this->searchSubsidiary = $company->id;
            $this->searchtext = '';
            $this->companies = [];
            $this->notFound = false;
            
            // Livewire 2.x: Brug $this->emit()
            $this->emit('companySelected', $company->id);
        }
    }

    public function remove()
    {
        $this->resetCompany();
        // Livewire 2.x: Brug $this->emit()
        $this->emit('companyRemoved');
    }

    public function resetCompany()
    {
        $this->company = null;
        $this->searchSubsidiary = null;
        $this->searchtext = '';
        $this->companies = [];
        $this->notFound = false;
    }

    public function render()
    {
        return view('companies::livewire.select-company');
    }
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
}