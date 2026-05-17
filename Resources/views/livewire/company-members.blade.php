<<<<<<< HEAD
<div>

    @if($submitLoading)
        <div class="text-center p-3">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"></span>
            </div>
    
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th colspan="6">
                    Roller
                    <button 
                        type="button"
                        class="btn btn-primary float-right" 
                        wire:click="$set('showMemberModal', true)">
                        + Tilføj rolle
                    </button>
                </th>
            </tr>
        </thead>

        @if(!$this->hasMembers)
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">
                        <i>Ingen roller tilføjet</i>
                    </td>
                </tr>
            </tbody>
        @else
            <thead>
                <tr>
                    <th>Navn</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th width="300">Rolle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $index => $member)
                    <tr wire:key="member-{{ $member['id'] ?? $index }}">
                        <td>
                            {{ $member['first_name'] }} {{ $member['middle_name'] ?? '' }} {{ $member['last_name'] }}
                            @if($member['is_new'] ?? false)
                                <span class="badge badge-success ml-2">Ny</span>
                            @endif
                            
                            <!-- Hidden fields for form submission -->
                            <input type="hidden" name="members[{{ $index }}][id]" value="{{ $member['id'] }}">
                            <input type="hidden" name="members[{{ $index }}][first_name]" value="{{ $member['first_name'] }}">
                            <input type="hidden" name="members[{{ $index }}][middle_name]" value="{{ $member['middle_name'] ?? '' }}">
                            <input type="hidden" name="members[{{ $index }}][last_name]" value="{{ $member['last_name'] }}">
                            <input type="hidden" name="members[{{ $index }}][email]" value="{{ $member['email'] }}">
                            <input type="hidden" name="members[{{ $index }}][phone]" value="{{ $member['phone'] ?? '' }}">
                    
                            <input type="hidden" name="members[{{ $index }}][invite]" value="{{ $member['invite'] ?? 0 }}">
                        </td>

                        <td>
                            @if($member['email'])
                                <a href="mailto:{{ $member['email'] }}">{{ $member['email'] }}</a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($member['phone'] ?? null)
                                <a href="tel:{{ $member['phone'] }}">{{ $member['phone'] }}</a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <!-- Role select med hidden input -->
                        
                          

                            <livewire:role-select 
                                wire:key="role-{{ $member['id'] ?? $index }}"
                                name="members[{{ $index }}][role_id]"
                                :role_id="$member['role_id'] ?? null" 
                                :wrapper="false"
                            />
                            
                       
                        </td>

                        <td width="100" align="right">
                            <button 
                                type="button"
                                class="btn btn-danger btn-sm"
                                wire:click="removeExisting('{{ $member['id'] }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>

    {{-- Modal --}}
    @if($showMemberModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,.5); z-index: 1050;" wire:key="member-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Tilføj Medlem</h5>
                        <button 
                            type="button"
                            class="close" 
                            wire:click="resetForm">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="createtype" 
                                       value="search" 
                                       id="option-search"
                                       wire:model="memberOption">
                                <label class="form-check-label" for="option-search">Søg eksisterende bruger</label>
                            </div>
                            <div class="form-check form-check-inline">

                           
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="createtype" 
                                       value="create" 
                                       id="option-create"
                                       wire:model="memberOption">
                                <label class="form-check-label" for="option-create">Opret ny bruger</label>

                           
                            </div>
                        </div>

                        <hr>

                        {{-- Search Section --}}
                        @if($memberOption === 'search')
                            <div>
                                <strong>Søg efter eksisterende bruger</strong>
                                @error('searchMember')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <div wire:key="search-section">
                                    <!-- Søgefelt med loading - kun vises hvis ingen bruger er valgt -->
                                    @if($showSearchField && !$searchMember)
                                        <div class="form-group position-relative">
                                            <div class="input-group">
                                                <input 
                                                    type="text" 
                                                    class="form-control"
                                                    placeholder="Søg efter navn eller email..."
                                                    wire:model.live.debounce.500ms="searchQuery"
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @if($isSearching)
                                                            <div class="spinner-border spinner-border-sm" role="status">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        @else
                                                            <i class="fas fa-search"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Søgeresultater -->
                                            @if(strlen($searchQuery) >= 2)
                                                <div class="w-100" style="z-index: 1000;">
                                                    <div class="card shadow-sm">
                                                        <div class="card-body p-0">
                                                            @if(count($searchResults) > 0)
                                                                <ul class="list-group list-group-flush">
                                                                    @foreach($searchResults as $result)
                                                                        <li class="list-group-item list-group-item-action cursor-pointer"
                                                                            wire:click="selectUser({{ $result['id'] }})"
                                                                            style="cursor: pointer;">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <strong>{{ $result['first_name'] }}</strong><br>
                                                                                    <small class="text-muted">{{ $result['email'] }}</small><br>
                                                                                    @if($result['phone'])
                                                                                        <small class="text-muted">{{ $result['phone'] }}</small>
                                                                                    @endif
                                                                                </div>
                                                                                <i class="fas fa-plus text-success"></i>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @elseif($isSearching)
                                                                <div class="p-3 text-center">
                                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                                        <span class="sr-only"></span>
                                                                    </div>
                                                                    <span class="ml-2">Søger...</span>
                                                                </div>
                                                            @else
                                                                <div class="p-3 text-center text-muted">
                                                                    Ingen brugere fundet
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        @if(strlen($searchQuery) < 2 && !$isSearching)
                                            <div class="mt-2 text-muted">
                                                <small>Skriv mindst 2 tegn for at søge</small>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <!-- Valgt bruger - vises altid når en bruger er valgt -->
                                    @if($searchMember)

                                        <div class="mt-3 p-3 border rounded bg-light">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>
                                                    <strong>Valgt bruger:</strong><br>
                                                    {{ $searchMember["first_name"] }} {{ $searchMember["last_name"] }}<br>
                                                    {{ $searchMember["email"] }}<br>
                                                    {{ $searchMember["phone"] ?? 'Ingen telefon' }}
                                                </div>

                                                <div>
                                                    <button 
                                                        type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        wire:click="clearSelectedUser">
                                                        <i class="fas fa-times"></i> Fjern valg
                                                    </button>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        
                                        <!-- Knap til at vise søgefeltet igen -->
                                        <div class="mt-3">
                                            <button 
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                wire:click="$set('showSearchField', true)">
                                                <i class="fas fa-search"></i> Søg efter en anden bruger
                                            </button>
                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endif


                        {{-- Create Section --}}
                        @if($memberOption === 'create')

                            <div wire:key="create-section">

                                <strong>Opret ny bruger</strong>
                                

                                <div class="form-group">
                                    <label>Fornavn *</label>
                                    <input type="text" 
                                           class="form-control @error('newmember.first_name') is-invalid @enderror"
                                           wire:model="newmember.first_name"
                                           placeholder="Indtast fornavn">
                                    @error('newmember.first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                                
                                <div class="form-group">

                                    <label>Mellemnavn</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.middle_name"
                                           placeholder="Indtast mellemnavn (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Efternavn</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.last_name"
                                           placeholder="Indtast efternavn (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" 
                                           class="form-control @error('newmember.email') is-invalid @enderror"
                                           wire:model.live.debounce.500ms="newmember.email"
                                           placeholder="Indtast email">
                                    @error('newmember.email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Telefon</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.phone"
                                           placeholder="Indtast telefonnummer (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Adgangskode (kun hvis ikke invitation)</label>
                                    <input type="text" 
                                           class="form-control password"
                                           wire:model="newmember.password"
                                           placeholder="Lad stå tomt for at generere en tilfældig adgangskode">
                                    <small class="text-muted">Hvis feltet er tomt, genereres en tilfældig adgangskode og brugeren får tilsendt en invitation</small>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" 
                                           class="form-check-input"
                                           wire:model="newmember.invite"
                                           id="invite-check">
                                    <label class="form-check-label" for="invite-check">
                                        Send invitation til brugeren
                                    </label>
                                    <small class="text-muted d-block">Hvis afkrydset, skal brugeren bekræfte sin email. Hvis ikke, kan brugeren logge ind med den indtastede adgangskode.</small>
                                </div>
                            </div>
                        @endif
                    </div>

                    
                    <div class="modal-footer">
                        <button 
                            type="button"
                            class="btn btn-primary"
                            wire:click="submitMember"
                            wire:target="submitMember">
                            <span wire:loading.remove wire:target="submitMember">Tilføj medlem</span>
                            <span wire:loading wire:target="submitMember">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Tilføjer...
                            </span>
                        </button>

                        <button 
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            wire:click="resetForm">
                            Annuller
                        </button>
                        
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>

@push('styles')
<style>
    .cursor-pointer {
        cursor: pointer;
    }
    
    .list-group-item-action:hover {
        background-color: #f8f9fa;
    }
    
    body.modal-open {
        overflow: hidden;
    }
    
    .position-relative {
        position: relative;
    }
    
    .position-absolute {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 5px;
    }
    
    .badge-success {
        background-color: #28a745;
        color: white;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 3px;
    }
    
    /* Forbedrer dropdown visning */
    .card.shadow-sm {
        max-height: 300px;
        overflow-y: auto;
    }
    
    /* Gemmer hidden inputs */
    input[type="hidden"] {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Livewire hook for at opdatere hidden role fields
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            succeed(() => {
                // Når Livewire opdaterer role_id, opdateres også hidden field
                setTimeout(() => {
                    const roleSelects = document.querySelectorAll('[wire\\:model^="members."]');
                    roleSelects.forEach((select, index) => {
                        if (select.name && select.name.includes('role_id')) {
                            const hiddenInput = select.closest('td').querySelector('input[type="hidden"][name*="role_id"]');
                            if (hiddenInput) {
                                hiddenInput.value = select.value;
                            }
                        }
                    });
                }, 100);
            });
        });
    });
</script>
=======
<div>

    @if($submitLoading)
        <div class="text-center p-3">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"></span>
            </div>
    
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th colspan="6">
                    Roller
                    <button 
                        type="button"
                        class="btn btn-primary float-right" 
                        wire:click="$set('showMemberModal', true)">
                        + Tilføj rolle
                    </button>
                </th>
            </tr>
        </thead>

        @if(!$this->hasMembers)
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">
                        <i>Ingen roller tilføjet</i>
                    </td>
                </tr>
            </tbody>
        @else
            <thead>
                <tr>
                    <th>Navn</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th width="300">Rolle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $index => $member)
                    <tr wire:key="member-{{ $member['id'] ?? $index }}">
                        <td>
                            {{ $member['first_name'] }} {{ $member['middle_name'] ?? '' }} {{ $member['last_name'] }}
                            @if($member['is_new'] ?? false)
                                <span class="badge badge-success ml-2">Ny</span>
                            @endif
                            
                            <!-- Hidden fields for form submission -->
                            <input type="hidden" name="members[{{ $index }}][id]" value="{{ $member['id'] }}">
                            <input type="hidden" name="members[{{ $index }}][first_name]" value="{{ $member['first_name'] }}">
                            <input type="hidden" name="members[{{ $index }}][middle_name]" value="{{ $member['middle_name'] ?? '' }}">
                            <input type="hidden" name="members[{{ $index }}][last_name]" value="{{ $member['last_name'] }}">
                            <input type="hidden" name="members[{{ $index }}][email]" value="{{ $member['email'] }}">
                            <input type="hidden" name="members[{{ $index }}][phone]" value="{{ $member['phone'] ?? '' }}">
                    
                            <input type="hidden" name="members[{{ $index }}][invite]" value="{{ $member['invite'] ?? 0 }}">
                        </td>

                        <td>
                            @if($member['email'])
                                <a href="mailto:{{ $member['email'] }}">{{ $member['email'] }}</a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($member['phone'] ?? null)
                                <a href="tel:{{ $member['phone'] }}">{{ $member['phone'] }}</a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <!-- Role select med hidden input -->
                        
                          

                            <livewire:role-select 
                                wire:key="role-{{ $member['id'] ?? $index }}"
                                name="members[{{ $index }}][role_id]"
                                :role_id="$member['role_id'] ?? null" 
                                :wrapper="false"
                            />
                            
                       
                        </td>

                        <td width="100" align="right">
                            <button 
                                type="button"
                                class="btn btn-danger btn-sm"
                                wire:click="removeExisting('{{ $member['id'] }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>

    {{-- Modal --}}
    @if($showMemberModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,.5); z-index: 1050;" wire:key="member-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Tilføj Medlem</h5>
                        <button 
                            type="button"
                            class="close" 
                            wire:click="resetForm">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="createtype" 
                                       value="search" 
                                       id="option-search"
                                       wire:model="memberOption">
                                <label class="form-check-label" for="option-search">Søg eksisterende bruger</label>
                            </div>
                            <div class="form-check form-check-inline">

                           
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="createtype" 
                                       value="create" 
                                       id="option-create"
                                       wire:model="memberOption">
                                <label class="form-check-label" for="option-create">Opret ny bruger</label>

                           
                            </div>
                        </div>

                        <hr>

                        {{-- Search Section --}}
                        @if($memberOption === 'search')
                            <div>
                                <strong>Søg efter eksisterende bruger</strong>
                                @error('searchMember')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <div wire:key="search-section">
                                    <!-- Søgefelt med loading - kun vises hvis ingen bruger er valgt -->
                                    @if($showSearchField && !$searchMember)
                                        <div class="form-group position-relative">
                                            <div class="input-group">
                                                <input 
                                                    type="text" 
                                                    class="form-control"
                                                    placeholder="Søg efter navn eller email..."
                                                    wire:model.live.debounce.500ms="searchQuery"
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        @if($isSearching)
                                                            <div class="spinner-border spinner-border-sm" role="status">
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        @else
                                                            <i class="fas fa-search"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Søgeresultater -->
                                            @if(strlen($searchQuery) >= 2)
                                                <div class="w-100" style="z-index: 1000;">
                                                    <div class="card shadow-sm">
                                                        <div class="card-body p-0">
                                                            @if(count($searchResults) > 0)
                                                                <ul class="list-group list-group-flush">
                                                                    @foreach($searchResults as $result)
                                                                        <li class="list-group-item list-group-item-action cursor-pointer"
                                                                            wire:click="selectUser({{ $result['id'] }})"
                                                                            style="cursor: pointer;">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <strong>{{ $result['first_name'] }}</strong><br>
                                                                                    <small class="text-muted">{{ $result['email'] }}</small><br>
                                                                                    @if($result['phone'])
                                                                                        <small class="text-muted">{{ $result['phone'] }}</small>
                                                                                    @endif
                                                                                </div>
                                                                                <i class="fas fa-plus text-success"></i>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @elseif($isSearching)
                                                                <div class="p-3 text-center">
                                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                                        <span class="sr-only"></span>
                                                                    </div>
                                                                    <span class="ml-2">Søger...</span>
                                                                </div>
                                                            @else
                                                                <div class="p-3 text-center text-muted">
                                                                    Ingen brugere fundet
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        @if(strlen($searchQuery) < 2 && !$isSearching)
                                            <div class="mt-2 text-muted">
                                                <small>Skriv mindst 2 tegn for at søge</small>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <!-- Valgt bruger - vises altid når en bruger er valgt -->
                                    @if($searchMember)

                                        <div class="mt-3 p-3 border rounded bg-light">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>
                                                    <strong>Valgt bruger:</strong><br>
                                                    {{ $searchMember["first_name"] }} {{ $searchMember["last_name"] }}<br>
                                                    {{ $searchMember["email"] }}<br>
                                                    {{ $searchMember["phone"] ?? 'Ingen telefon' }}
                                                </div>

                                                <div>
                                                    <button 
                                                        type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        wire:click="clearSelectedUser">
                                                        <i class="fas fa-times"></i> Fjern valg
                                                    </button>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        
                                        <!-- Knap til at vise søgefeltet igen -->
                                        <div class="mt-3">
                                            <button 
                                                type="button"
                                                class="btn btn-sm btn-outline-secondary"
                                                wire:click="$set('showSearchField', true)">
                                                <i class="fas fa-search"></i> Søg efter en anden bruger
                                            </button>
                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endif


                        {{-- Create Section --}}
                        @if($memberOption === 'create')

                            <div wire:key="create-section">

                                <strong>Opret ny bruger</strong>
                                

                                <div class="form-group">
                                    <label>Fornavn *</label>
                                    <input type="text" 
                                           class="form-control @error('newmember.first_name') is-invalid @enderror"
                                           wire:model="newmember.first_name"
                                           placeholder="Indtast fornavn">
                                    @error('newmember.first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                                
                                <div class="form-group">

                                    <label>Mellemnavn</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.middle_name"
                                           placeholder="Indtast mellemnavn (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Efternavn</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.last_name"
                                           placeholder="Indtast efternavn (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" 
                                           class="form-control @error('newmember.email') is-invalid @enderror"
                                           wire:model.live.debounce.500ms="newmember.email"
                                           placeholder="Indtast email">
                                    @error('newmember.email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Telefon</label>
                                    <input type="text" 
                                           class="form-control"
                                           wire:model="newmember.phone"
                                           placeholder="Indtast telefonnummer (valgfrit)">
                                </div>
                                
                                <div class="form-group">
                                    <label>Adgangskode (kun hvis ikke invitation)</label>
                                    <input type="text" 
                                           class="form-control password"
                                           wire:model="newmember.password"
                                           placeholder="Lad stå tomt for at generere en tilfældig adgangskode">
                                    <small class="text-muted">Hvis feltet er tomt, genereres en tilfældig adgangskode og brugeren får tilsendt en invitation</small>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input type="checkbox" 
                                           class="form-check-input"
                                           wire:model="newmember.invite"
                                           id="invite-check">
                                    <label class="form-check-label" for="invite-check">
                                        Send invitation til brugeren
                                    </label>
                                    <small class="text-muted d-block">Hvis afkrydset, skal brugeren bekræfte sin email. Hvis ikke, kan brugeren logge ind med den indtastede adgangskode.</small>
                                </div>
                            </div>
                        @endif
                    </div>

                    
                    <div class="modal-footer">
                        <button 
                            type="button"
                            class="btn btn-primary"
                            wire:click="submitMember"
                            wire:target="submitMember">
                            <span wire:loading.remove wire:target="submitMember">Tilføj medlem</span>
                            <span wire:loading wire:target="submitMember">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Tilføjer...
                            </span>
                        </button>

                        <button 
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            wire:click="resetForm">
                            Annuller
                        </button>
                        
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>

@push('styles')
<style>
    .cursor-pointer {
        cursor: pointer;
    }
    
    .list-group-item-action:hover {
        background-color: #f8f9fa;
    }
    
    body.modal-open {
        overflow: hidden;
    }
    
    .position-relative {
        position: relative;
    }
    
    .position-absolute {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 5px;
    }
    
    .badge-success {
        background-color: #28a745;
        color: white;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 3px;
    }
    
    /* Forbedrer dropdown visning */
    .card.shadow-sm {
        max-height: 300px;
        overflow-y: auto;
    }
    
    /* Gemmer hidden inputs */
    input[type="hidden"] {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Livewire hook for at opdatere hidden role fields
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            succeed(() => {
                // Når Livewire opdaterer role_id, opdateres også hidden field
                setTimeout(() => {
                    const roleSelects = document.querySelectorAll('[wire\\:model^="members."]');
                    roleSelects.forEach((select, index) => {
                        if (select.name && select.name.includes('role_id')) {
                            const hiddenInput = select.closest('td').querySelector('input[type="hidden"][name*="role_id"]');
                            if (hiddenInput) {
                                hiddenInput.value = select.value;
                            }
                        }
                    });
                }, 100);
            });
        });
    });
</script>
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
@endpush