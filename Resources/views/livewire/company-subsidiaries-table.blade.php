<section>
    {{-- Loading --}}
    <div wire:loading>
        <div class="text-center p-4">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"></span>
            </div>
            <strong></strong>
        </div>
    </div>

    <div wire:loading.remove>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6">
                        Datterselskaber
                        <button 
                            type="button"
                            class="btn btn-primary float-right"
                            wire:click="$set('showModal', true)">
                            + Tilføj datterselskab
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(!$companies || $companies->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center p-4">
                            <i>Ingen datterselskaber registreret</i>
                        </td>
                    </tr>
                @else
                    <tr>
                        <th></th>
                        <th>Firma</th>
                        <th>CVR</th>
                        <th>Adresse</th>
                        <th>Kontakt</th>
                        <th></th>
                    </tr>

                    @foreach ($companies as $i => $company)
                        <tr wire:key="subsidiary-{{ $company['id'] }}">
                            <td>
                                @if(!empty($company['logo']))
                                    <img src="{{ $company['logo'] }}" width="40" alt="Logo" class="rounded">
                                @endif
                                
                                <!-- Hidden field for company ID -->
                                <input type="hidden" name="subsidiaries[{{ $i }}]" value="{{ $company['id'] }}">
                            </td>
                            <td>
                                {{ $company['name'] ?? '' }}
                                <!-- Hidden field for company name -->
                                <input type="hidden" name="subsidiary_names[{{ $i }}]" value="{{ $company['name'] ?? '' }}">
                            </td>
                            <td>
                                {{ $company['vat'] ?? '' }}
                                <!-- Hidden field for company VAT -->
                                <input type="hidden" name="subsidiary_vats[{{ $i }}]" value="{{ $company['vat'] ?? '' }}">
                            </td>
                            <td>
                                @if(!empty($company['address']))
                                    {{ $company['address']->street ?? '' }}<br>
                                    {{ $company['address']->post_code ?? '' }} {{ $company['address']->city ?? '' }}<br>
                           
                                    
                                    <!-- Hidden fields for address -->
                                    <input type="hidden" name="subsidiary_addresses[{{ $i }}][street]" value="{{ $company['address']->street ?? '' }}">
                                    <input type="hidden" name="subsidiary_addresses[{{ $i }}][post_code]" value="{{ $company['address']->post_code ?? '' }}">
                                    <input type="hidden" name="subsidiary_addresses[{{ $i }}][city]" value="{{ $company['address']->city ?? '' }}">
                                    <input type="hidden" name="subsidiary_addresses[{{ $i }}][country]" value="{{ $company['address']->country ?? '' }}">
                                @endif
                            </td>
                            <td>
                                @if(!empty($company['contact']))
                                    {{ $company['contact']->phone ?? '' }}<br>
                                    {{ $company['contact']->email ?? '' }}<br>
         
                                    
                                    <!-- Hidden fields for contact -->
                                    <input type="hidden" name="subsidiary_contacts[{{ $i }}][phone]" value="{{ $company['contact']->phone ?? '' }}">
                                    <input type="hidden" name="subsidiary_contacts[{{ $i }}][email]" value="{{ $company['contact']->email ?? '' }}">

                                @endif
                            </td>
                            <td width="1">
                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    wire:click="removeSubsidiary({{ $i }})"
                                    title="Fjern datterselskab">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

 
    
    {{-- Modal --}}
    @if($showModal)
        <div class="modal-backdrop fade show"></div>
        <div class="modal fade show d-block" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tilføj Datterselskab</h5>
                        <button 
                            type="button"
                            class="close"
                            wire:click="$set('showModal', false)"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio"
                                       name="subsidiariesOption"
                                       id="option-search"
                                       wire:model="subsidiariesOption"
                                       value="search">
                                <label class="form-check-label" for="option-search">
                                    Søg firma
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio"
                                       name="subsidiariesOption"
                                       id="option-create"
                                       wire:model="subsidiariesOption"
                                       value="create">
                                <label class="form-check-label" for="option-create">
                                    Opret nyt firma
                                </label>
                            </div>
                        </div>

                        <hr>

                        {{-- Search Section --}}
                        @if($subsidiariesOption === 'search')
                            <div>
                                <strong>Søg firma</strong>
                                @error('searchSubsidiary')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <livewire:companies::select-company
                                    wire:model="searchSubsidiary"
                                    :excludes="$excludes"
                                />
                   
                                @if($selectedCompany)
                                    <div class="mt-3 p-2 border rounded bg-light">
                                        <strong>Valgt firma:</strong>
                                        <div class="mt-2">
                                            <strong>{{ $selectedCompany->name }}</strong><br>
                                            CVR: {{ $selectedCompany->vat }}<br>
                                            @if($selectedCompany->address)
                                                {{ $selectedCompany->address->street }}<br>
                                                {{ $selectedCompany->address->post_code }} {{ $selectedCompany->address->city }}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Create Section --}}
                        @if($subsidiariesOption === 'create')
                            <div>
                                <strong>Opret nyt firma</strong>
                                
                                <div class="row">
                                    {{-- Firmanavn --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Firmanavn *</label>
                                            <input type="text"
                                                   class="form-control @error('newSubsidiary.name') is-invalid @enderror"
                                                   wire:model="newSubsidiary.name"
                                                   placeholder="Indtast firmanavn">
                                            @error('newSubsidiary.name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    {{-- CVR --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CVR</label>
                                            <input type="text"
                                                   class="form-control @error('newSubsidiary.vat') is-invalid @enderror"
                                                   wire:model="newSubsidiary.vat"
                                                   placeholder="Indtast CVR nummer">
                                            @error('newSubsidiary.vat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Logo --}}
                                <div class="form-group">
                                    <label>Logo</label>
                                    <livewire:media::file-select wire:model="newSubsidiary.images" multiple="false" />
                                    @error('newSubsidiary.images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Address Section --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <strong>Adresse</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Gade</label>
                                                    <input type="text"
                                                           class="form-control @error('newSubsidiary.address.street') is-invalid @enderror"
                                                           wire:model="newSubsidiary.address.street"
                                                           placeholder="Indtast gade">
                                                    @error('newSubsidiary.address.street')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Postnummer</label>
                                                    <input type="text"
                                                           class="form-control @error('newSubsidiary.address.post_code') is-invalid @enderror"
                                                           wire:model="newSubsidiary.address.post_code"
                                                           placeholder="Postnr">
                                                    @error('newSubsidiary.address.post_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>By</label>
                                                    <input type="text"
                                                           class="form-control @error('newSubsidiary.address.city') is-invalid @enderror"
                                                           wire:model="newSubsidiary.address.city"
                                                           placeholder="Indtast by">
                                                    @error('newSubsidiary.address.city')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Land</label>
                                                    <input type="text"
                                                           class="form-control @error('newSubsidiary.address.country') is-invalid @enderror"
                                                           wire:model="newSubsidiary.address.country"
                                                           placeholder="Indtast land">
                                                    @error('newSubsidiary.address.country')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contact Section --}}
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Kontakt</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Telefon</label>
                                                    <input type="text"
                                                           class="form-control @error('newSubsidiary.contact.phone') is-invalid @enderror"
                                                           wire:model="newSubsidiary.contact.phone"
                                                           placeholder="Telefon">
                                                    @error('newSubsidiary.contact.phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email"
                                                           class="form-control @error('newSubsidiary.contact.email') is-invalid @enderror"
                                                           wire:model="newSubsidiary.contact.email"
                                                           placeholder="Email">
                                                    @error('newSubsidiary.contact.email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button 
                            type="button"
                            class="btn btn-secondary"
                            wire:click="$set('showModal', false)">
                            Annuller
                        </button>
                        <button 
                            type="button"
                            class="btn btn-primary"
                            wire:click="submitSubsidiary"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>Tilføj</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                Tilføjer...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>

<style>
    .modal-backdrop {
        opacity: 0.5;
        background-color: #000;
    }
    .modal {
        z-index: 1050;
    }
    .modal-backdrop {
        z-index: 1040;
    }
    .card {
        margin-bottom: 1rem;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>