<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;
use Modules\Companies\Services\CompanyService;
use Modules\Companies\Models\Companies as Company;
use Modules\Companies\Models\Companies;

class CompanySubsidiariesTable extends Component
{

    public $subsidiaries = null;
    public $excludes = [];
    public $companies = []; 
    public $loading = true;
    public $selectedCompany = null;


    public $showModal = false;

    public $subsidiariesOption = 'search';

    public $searchSubsidiary = null;

    public $newSubsidiary = [
        'name' => '',
        'vat' => '',
        'images' => [],
        'address' => [
            'street' => '',
            'post_code' => '',
            'city' => '',
            'country' => '',
        ],
        'contact' => [
            'phone' => '',
            'email' => '',
            'website' => '',
            'fax' => '',
        ],
    ];


    protected $rules = [
        'newSubsidiary.name' => 'required_if:subsidiariesOption,create|min:2|max:255',
        'newSubsidiary.vat' => 'nullable|max:50',
        'newSubsidiary.images' => 'nullable|array',
        'newSubsidiary.address.street' => 'nullable|max:255',
        'newSubsidiary.address.post_code' => 'nullable|max:20',
        'newSubsidiary.address.city' => 'nullable|max:100',
        'newSubsidiary.address.country' => 'nullable|max:100',
        'newSubsidiary.contact.phone' => 'nullable|max:50',
        'newSubsidiary.contact.email' => 'nullable|email|max:255',
        'newSubsidiary.contact.website' => 'nullable|url|max:255',
        'newSubsidiary.contact.fax' => 'nullable|max:50',
    ];


    protected $validationAttributes = [
        'newSubsidiary.name' => 'firmanavn',
        'newSubsidiary.vat' => 'CVR',
        'newSubsidiary.address.street' => 'gade',
        'newSubsidiary.address.post_code' => 'postnummer',
        'newSubsidiary.address.city' => 'by',
        'newSubsidiary.address.country' => 'land',
        'newSubsidiary.contact.phone' => 'telefon',
        'newSubsidiary.contact.email' => 'email',
        'newSubsidiary.contact.website' => 'hjemmeside',
        'newSubsidiary.contact.fax' => 'fax',
    ];


    protected $companyService;


    // Livewire 2.x: Tilføj event listeners
    protected $listeners = [
        'companySelected' => 'handleCompanySelected',
        'companyRemoved' => 'handleCompanyRemoved'
    ];


    public function boot()
    {

        $this->companyService = app(CompanyService::class);

    }


    public function mount($subsidiaries = null, $excludes = [])
    {

        $this->subsidiaries = $subsidiaries;

        $this->excludes = $excludes;

        $this->loadCompanies();

    }


    public function loadCompanies()
    {

        if (empty($this->subsidiaries)) {
            $this->companies = collect();
            $this->loading = false;
            return;
        }


        $this->companies = $this->subsidiaries;


        $this->loading = false;

    }


    public function removeSubsidiary($index)
    {

        if (!isset($this->subsidiaries[$index])) return;

        unset($this->subsidiaries[$index], $this->companies[$index]);

        $this->subsidiaries = collect();

        $this->companies =  collect();

        $this->emit('subsidiariesUpdated', $this->subsidiaries);

    }


    public function submitSubsidiary()
    {
        if ($this->subsidiariesOption === 'search') {

            return $this->handleSearchOption();

        }

        if ($this->subsidiariesOption === 'create') {

            return $this->handleCreateOption();

        }
    }


    private function handleSearchOption()
    {

        if (!$this->searchSubsidiary) {

            $this->addError('searchSubsidiary', 'Vælg et firma');

            return;

        }


        $company = Company::with(['address', 'contact'])->find($this->searchSubsidiary);


        if (!$company) {
            $this->addError('searchSubsidiary', 'Firma ikke fundet');
            return;
        }


        if ($this->subsidiaries && $this->subsidiaries->pluck("id")->contains($company->id)) {
            $this->addError('searchSubsidiary', 'Dette firma er allerede tilføjet');
            return;
        }
   

        $this->addCompany($company);

    }


    private function handleCreateOption()
    {

        $this->validate();

        if ($this->newSubsidiary['vat']) {

            $existing = Company::where('vat', $this->newSubsidiary['vat'])->first();

            if ($existing) {

                $this->addError('newSubsidiary.vat', 'Et firma med dette CVR nummer eksisterer allerede');

                return;

            }

        }


        try {


            $company = $this->companyService->createSubsidiary([
                'name' => $this->newSubsidiary['name'],
                'vat' => $this->newSubsidiary['vat'],
                'address' => array_filter($this->newSubsidiary['address']),
                'contact' => array_filter($this->newSubsidiary['contact']),
                'images' => $this->newSubsidiary['images'],
            ]);

            $this->addCompany($company);
            
        } catch (\Exception $e) {
            $this->addError('general', 'Der opstod en fejl under oprettelsen: ' . $e->getMessage());
            \Log::error('Fejl ved oprettelse af datterselskab: ' . $e->getMessage());
        }
    }

    // Event handlers
    public function handleCompanySelected($companyId)
    {
        $this->searchSubsidiary = $companyId;
    }

    public function handleCompanyRemoved()
    {
        $this->searchSubsidiary = null;
    }

    private function addCompany($company)
    {


        $this->companies[] = $company;

    
        $this->subsidiaries[] = $company;

        $this->emit('subsidiariesUpdated', $this->subsidiaries);

        $this->resetModal();

        $this->showModal = false;
   
    }

    public function resetModal()
    {
        $this->newSubsidiary = [
            'name' => '',
            'vat' => '',
            'images' => [],
            'address' => [
                'street' => '',
                'post_code' => '',
                'city' => '',
                'country' => '',
            ],
            'contact' => [
                'phone' => '',
                'email' => '',
                'website' => '',
                'fax' => '',
            ],
        ];

        $this->searchSubsidiary = null;
        $this->resetErrorBag();
    }

    public function getSelectedCompanyProperty()
    {
        if (!$this->searchSubsidiary) return null;

        return Company::with(['address', 'contact'])->find($this->searchSubsidiary);
    }

    public function render()
    {
        return view('companies::livewire.company-subsidiaries-table');
    }
=======
<?php

namespace Modules\Companies\Http\Livewire;

use Livewire\Component;
use Modules\Companies\Services\CompanyService;
use Modules\Companies\Models\Companies as Company;
use Modules\Companies\Models\Companies;

class CompanySubsidiariesTable extends Component
{

    public $subsidiaries = null;
    public $excludes = [];
    public $companies = []; 
    public $loading = true;
    public $selectedCompany = null;


    public $showModal = false;

    public $subsidiariesOption = 'search';

    public $searchSubsidiary = null;

    public $newSubsidiary = [
        'name' => '',
        'vat' => '',
        'images' => [],
        'address' => [
            'street' => '',
            'post_code' => '',
            'city' => '',
            'country' => '',
        ],
        'contact' => [
            'phone' => '',
            'email' => '',
            'website' => '',
            'fax' => '',
        ],
    ];


    protected $rules = [
        'newSubsidiary.name' => 'required_if:subsidiariesOption,create|min:2|max:255',
        'newSubsidiary.vat' => 'nullable|max:50',
        'newSubsidiary.images' => 'nullable|array',
        'newSubsidiary.address.street' => 'nullable|max:255',
        'newSubsidiary.address.post_code' => 'nullable|max:20',
        'newSubsidiary.address.city' => 'nullable|max:100',
        'newSubsidiary.address.country' => 'nullable|max:100',
        'newSubsidiary.contact.phone' => 'nullable|max:50',
        'newSubsidiary.contact.email' => 'nullable|email|max:255',
        'newSubsidiary.contact.website' => 'nullable|url|max:255',
        'newSubsidiary.contact.fax' => 'nullable|max:50',
    ];


    protected $validationAttributes = [
        'newSubsidiary.name' => 'firmanavn',
        'newSubsidiary.vat' => 'CVR',
        'newSubsidiary.address.street' => 'gade',
        'newSubsidiary.address.post_code' => 'postnummer',
        'newSubsidiary.address.city' => 'by',
        'newSubsidiary.address.country' => 'land',
        'newSubsidiary.contact.phone' => 'telefon',
        'newSubsidiary.contact.email' => 'email',
        'newSubsidiary.contact.website' => 'hjemmeside',
        'newSubsidiary.contact.fax' => 'fax',
    ];


    protected $companyService;


    // Livewire 2.x: Tilføj event listeners
    protected $listeners = [
        'companySelected' => 'handleCompanySelected',
        'companyRemoved' => 'handleCompanyRemoved'
    ];


    public function boot()
    {

        $this->companyService = app(CompanyService::class);

    }


    public function mount($subsidiaries = null, $excludes = [])
    {

        $this->subsidiaries = $subsidiaries;

        $this->excludes = $excludes;

        $this->loadCompanies();

    }


    public function loadCompanies()
    {

        if (empty($this->subsidiaries)) {
            $this->companies = collect();
            $this->loading = false;
            return;
        }


        $this->companies = $this->subsidiaries;


        $this->loading = false;

    }


    public function removeSubsidiary($index)
    {

        if (!isset($this->subsidiaries[$index])) return;

        unset($this->subsidiaries[$index], $this->companies[$index]);

        $this->subsidiaries = collect();

        $this->companies =  collect();

        $this->emit('subsidiariesUpdated', $this->subsidiaries);

    }


    public function submitSubsidiary()
    {
        if ($this->subsidiariesOption === 'search') {

            return $this->handleSearchOption();

        }

        if ($this->subsidiariesOption === 'create') {

            return $this->handleCreateOption();

        }
    }


    private function handleSearchOption()
    {

        if (!$this->searchSubsidiary) {

            $this->addError('searchSubsidiary', 'Vælg et firma');

            return;

        }


        $company = Company::with(['address', 'contact'])->find($this->searchSubsidiary);


        if (!$company) {
            $this->addError('searchSubsidiary', 'Firma ikke fundet');
            return;
        }


        if ($this->subsidiaries && $this->subsidiaries->pluck("id")->contains($company->id)) {
            $this->addError('searchSubsidiary', 'Dette firma er allerede tilføjet');
            return;
        }
   

        $this->addCompany($company);

    }


    private function handleCreateOption()
    {

        $this->validate();

        if ($this->newSubsidiary['vat']) {

            $existing = Company::where('vat', $this->newSubsidiary['vat'])->first();

            if ($existing) {

                $this->addError('newSubsidiary.vat', 'Et firma med dette CVR nummer eksisterer allerede');

                return;

            }

        }


        try {


            $company = $this->companyService->createSubsidiary([
                'name' => $this->newSubsidiary['name'],
                'vat' => $this->newSubsidiary['vat'],
                'address' => array_filter($this->newSubsidiary['address']),
                'contact' => array_filter($this->newSubsidiary['contact']),
                'images' => $this->newSubsidiary['images'],
            ]);

            $this->addCompany($company);
            
        } catch (\Exception $e) {
            $this->addError('general', 'Der opstod en fejl under oprettelsen: ' . $e->getMessage());
            \Log::error('Fejl ved oprettelse af datterselskab: ' . $e->getMessage());
        }
    }

    // Event handlers
    public function handleCompanySelected($companyId)
    {
        $this->searchSubsidiary = $companyId;
    }

    public function handleCompanyRemoved()
    {
        $this->searchSubsidiary = null;
    }

    private function addCompany($company)
    {


        $this->companies[] = $company;

    
        $this->subsidiaries[] = $company;

        $this->emit('subsidiariesUpdated', $this->subsidiaries);

        $this->resetModal();

        $this->showModal = false;
   
    }

    public function resetModal()
    {
        $this->newSubsidiary = [
            'name' => '',
            'vat' => '',
            'images' => [],
            'address' => [
                'street' => '',
                'post_code' => '',
                'city' => '',
                'country' => '',
            ],
            'contact' => [
                'phone' => '',
                'email' => '',
                'website' => '',
                'fax' => '',
            ],
        ];

        $this->searchSubsidiary = null;
        $this->resetErrorBag();
    }

    public function getSelectedCompanyProperty()
    {
        if (!$this->searchSubsidiary) return null;

        return Company::with(['address', 'contact'])->find($this->searchSubsidiary);
    }

    public function render()
    {
        return view('companies::livewire.company-subsidiaries-table');
    }
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
}