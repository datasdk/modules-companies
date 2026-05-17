<<<<<<< HEAD
@if($subsidiaries && count($subsidiaries))
    <ul class="list-disc pl-4 text-sm">
        @foreach($subsidiaries as $subsidiary)
            @php
                // Hent data baseret på om det er et objekt eller array
                $subsidiaryId = $subsidiary->id ?? $subsidiary['id'] ?? null;
                $subsidiaryName = $subsidiary->name ?? $subsidiary['name'] ?? '-';
                $subsidiaryVat = $subsidiary->vat ?? $subsidiary['vat'] ?? null;
                $createdAt = $subsidiary->created_at ?? $subsidiary['created_at'] ?? null;
                
                // Hent relationer hvis tilgængelige
                $address = null;
                $contacts = [];
                $tags = [];
                $parentCompany = null;
                
                if (is_object($subsidiary)) {
                    // Hent adresse
                    if (method_exists($subsidiary, 'address')) {
                        $address = $subsidiary->address ?? $subsidiary->address()->first();
                    }
                    
                    // Hent kontakter
                    if (method_exists($subsidiary, 'contacts')) {
                        $contacts = $subsidiary->contacts ?? $subsidiary->contacts()->get() ?? [];
                    }
                    
                    // Hent tags
                    if (method_exists($subsidiary, 'tags')) {
                        $tags = $subsidiary->tags ?? $subsidiary->tags()->get() ?? [];
                    }
                    
                    // Hent moderfirma
                    if (method_exists($subsidiary, 'parent')) {
                        $parentCompany = $subsidiary->parent ?? $subsidiary->parent()->first();
                    }
                    
                    // Hent media/logo
                    $logoUrl = null;
                    if (method_exists($subsidiary, 'getFirstMediaUrl')) {
                        $logoUrl = $subsidiary->getFirstMediaUrl('logo');
                    }
                }
                
                // Formatér dato
                $formattedDate = $createdAt ? $createdAt->format('d-m-Y H:i') : ($createdAt ?? 'Ikke tilgængelig');
                
                // Hent land (fra din model)
                $country = $subsidiary->country->name ?? null;
            @endphp
            
            <li>
                <a href="javascript:void(0)" 
                   class="text-blue-600 hover:text-blue-800 hover:underline cursor-pointer"
                   data-toggle="modal" 
                   data-target="#subsidiaryModal{{ $loop->index }}"
                   onclick="openSubsidiaryModal('{{ $loop->index }}')">
                    {{ $subsidiaryName }}
                </a>
                @if($subsidiaryVat)
                    (CVR: {{ $subsidiaryVat }})
                @endif
            </li>
            
            <!-- Modal for dette datterselskab -->
            <div class="modal fade" id="subsidiaryModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="subsidiaryModalLabel{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subsidiaryModalLabel{{ $loop->index }}">
                                Datterselskab: {{ $subsidiaryName }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Logo og grundlæggende info -->
                                @if(isset($logoUrl) && $logoUrl)
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $logoUrl }}" alt="{{ $subsidiaryName }} logo" class="img-fluid rounded">
                                </div>
                                <div class="col-md-10">
                                @else
                                <div class="col-md-12">
                                @endif
                                    <div class="row">
                                        <!-- Virksomhedsoplysninger -->
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold mb-3">Virksomhedsoplysninger</h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="text-muted" width="120">Navn:</td>
                                                    <td><strong>{{ $subsidiaryName ?: '-' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">CVR:</td>
                                                    <td>{{ $subsidiaryVat ?: '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Land:</td>
                                                    <td>{{ strtoupper($country) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Oprettet:</td>
                                                    <td>{{ $formattedDate }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <!-- Moderfirma -->
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold mb-3">Moderfirma</h6>
                                            @if($parentCompany)
                                                @php
                                                    $parentName = is_object($parentCompany) ? $parentCompany->name : ($parentCompany['name'] ?? '');
                                                    $parentVat = is_object($parentCompany) ? $parentCompany->vat : ($parentCompany['vat'] ?? '');
                                                @endphp
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td class="text-muted" width="120">Navn:</td>
                                                        <td>{{ $parentName ?: '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">CVR:</td>
                                                        <td>{{ $parentVat ?: '-' }}</td>
                                                    </tr>
                                                </table>
                                            @else
                                                <p class="text-muted">Intet moderfirma</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Adresse -->
                            @if($address && (is_object($address) || is_array($address)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Adresse</h6>
                                    <table class="table table-sm table-borderless">
                                        @if(is_object($address))
                                            <tr>
                                                <td class="text-muted" width="120">Vej:</td>
                                                <td>{{ $address->street ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Postnr:</td>
                                                <td>{{ $address->post_code ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">By:</td>
                                                <td>{{ $address->city ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Land:</td>
                                                <td>{{ $address->country->name ?? null }}</td>
                                            </tr>
                                        @elseif(is_array($address))
                                            <tr>
                                                <td class="text-muted" width="120">Vej:</td>
                                                <td>{{ $address['street'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Postnr:</td>
                                                <td>{{ $address['post_code'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">By:</td>
                                                <td>{{ $address['city'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Land:</td>
                                                <td>{{ $address['country'] ?? 'Danmark' }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Kontakter -->
                            @if(!empty($contacts) && (is_array($contacts) || (is_object($contacts) && count($contacts) > 0)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Kontakter</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Navn</th>
                                                    <th>Email</th>
                                                    <th>Telefon</th>
                                                    <th>Rolle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contacts as $contact)
                                                    @php
                                                        $contactName = is_object($contact) ? ($contact->first_name . ' ' . $contact->last_name) : 
                                                            (($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? ''));
                                                        $contactEmail = is_object($contact) ? $contact->email : ($contact['email'] ?? '');
                                                        $contactPhone = is_object($contact) ? $contact->phone : ($contact['phone'] ?? '');
                                                        $contactRole = '';
                                                        
                                                        if (is_object($contact) && isset($contact->pivot)) {
                                                            $contactRole = $contact->pivot->role ?? '';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ trim($contactName) ?: '-' }}</td>
                                                        <td>
                                                            @if($contactEmail)
                                                                <a href="mailto:{{ $contactEmail }}" class="text-primary">
                                                                    {{ $contactEmail }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($contactPhone)
                                                                <a href="tel:{{ $contactPhone }}" class="text-primary">
                                                                    {{ $contactPhone }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $contactRole ?: '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Tags -->
                            @if(!empty($tags) && (is_array($tags) || (is_object($tags) && count($tags) > 0)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Tags</h6>
                                    <div class="d-flex flex-wrap">
                                        @foreach($tags as $tag)
                                            @php
                                                $tagName = is_object($tag) ? $tag->name : ($tag['name'] ?? '');
                                                $tagColor = is_object($tag) ? $tag->color : ($tag['color'] ?? 'secondary');
                                            @endphp
                                            <span class="badge badge-{{ $tagColor }} mr-2 mb-2">
                                                {{ $tagName }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Yderligere information -->
                            @if($subsidiaryId)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="pt-3 border-top text-right">
                                        <small class="text-muted">Virksomhed ID: {{ $subsidiaryId }}</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                            @if($subsidiaryId)
                            <a href="{{ route('companies.edit', $subsidiaryId) }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i> Rediger virksomhed
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
@else
    <span class="text-gray-400">-</span>
@endif

<!-- JavaScript for at håndtere modals -->
@push('scripts')
<script>
// Funktion til at åbne modal med specifikt index
function openSubsidiaryModal(index) {
    $('#subsidiaryModal' + index).modal('show');
}

// Håndter Bootstrap modal lukning
$(document).ready(function() {
    $('.modal').on('hidden.bs.modal', function () {
        // Optional: Ryd data eller reset form hvis nødvendigt
    });
});
</script>
@endpush

<!-- Bootstrap CSS og JS (hvis ikke allerede inkluderet) -->
@push('styles')
<style>
    .modal-lg {
        max-width: 900px;
    }
    .table-sm td {
        padding: 0.3rem;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .badge {
        font-size: 85%;
    }
</style>
=======
@if($subsidiaries && count($subsidiaries))
    <ul class="list-disc pl-4 text-sm">
        @foreach($subsidiaries as $subsidiary)
            @php
                // Hent data baseret på om det er et objekt eller array
                $subsidiaryId = $subsidiary->id ?? $subsidiary['id'] ?? null;
                $subsidiaryName = $subsidiary->name ?? $subsidiary['name'] ?? '-';
                $subsidiaryVat = $subsidiary->vat ?? $subsidiary['vat'] ?? null;
                $createdAt = $subsidiary->created_at ?? $subsidiary['created_at'] ?? null;
                
                // Hent relationer hvis tilgængelige
                $address = null;
                $contacts = [];
                $tags = [];
                $parentCompany = null;
                
                if (is_object($subsidiary)) {
                    // Hent adresse
                    if (method_exists($subsidiary, 'address')) {
                        $address = $subsidiary->address ?? $subsidiary->address()->first();
                    }
                    
                    // Hent kontakter
                    if (method_exists($subsidiary, 'contacts')) {
                        $contacts = $subsidiary->contacts ?? $subsidiary->contacts()->get() ?? [];
                    }
                    
                    // Hent tags
                    if (method_exists($subsidiary, 'tags')) {
                        $tags = $subsidiary->tags ?? $subsidiary->tags()->get() ?? [];
                    }
                    
                    // Hent moderfirma
                    if (method_exists($subsidiary, 'parent')) {
                        $parentCompany = $subsidiary->parent ?? $subsidiary->parent()->first();
                    }
                    
                    // Hent media/logo
                    $logoUrl = null;
                    if (method_exists($subsidiary, 'getFirstMediaUrl')) {
                        $logoUrl = $subsidiary->getFirstMediaUrl('logo');
                    }
                }
                
                // Formatér dato
                $formattedDate = $createdAt ? $createdAt->format('d-m-Y H:i') : ($createdAt ?? 'Ikke tilgængelig');
                
                // Hent land (fra din model)
                $country = $subsidiary->country->name ?? null;
            @endphp
            
            <li>
                <a href="javascript:void(0)" 
                   class="text-blue-600 hover:text-blue-800 hover:underline cursor-pointer"
                   data-toggle="modal" 
                   data-target="#subsidiaryModal{{ $loop->index }}"
                   onclick="openSubsidiaryModal('{{ $loop->index }}')">
                    {{ $subsidiaryName }}
                </a>
                @if($subsidiaryVat)
                    (CVR: {{ $subsidiaryVat }})
                @endif
            </li>
            
            <!-- Modal for dette datterselskab -->
            <div class="modal fade" id="subsidiaryModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="subsidiaryModalLabel{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subsidiaryModalLabel{{ $loop->index }}">
                                Datterselskab: {{ $subsidiaryName }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Logo og grundlæggende info -->
                                @if(isset($logoUrl) && $logoUrl)
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $logoUrl }}" alt="{{ $subsidiaryName }} logo" class="img-fluid rounded">
                                </div>
                                <div class="col-md-10">
                                @else
                                <div class="col-md-12">
                                @endif
                                    <div class="row">
                                        <!-- Virksomhedsoplysninger -->
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold mb-3">Virksomhedsoplysninger</h6>
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td class="text-muted" width="120">Navn:</td>
                                                    <td><strong>{{ $subsidiaryName ?: '-' }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">CVR:</td>
                                                    <td>{{ $subsidiaryVat ?: '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Land:</td>
                                                    <td>{{ strtoupper($country) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Oprettet:</td>
                                                    <td>{{ $formattedDate }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <!-- Moderfirma -->
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold mb-3">Moderfirma</h6>
                                            @if($parentCompany)
                                                @php
                                                    $parentName = is_object($parentCompany) ? $parentCompany->name : ($parentCompany['name'] ?? '');
                                                    $parentVat = is_object($parentCompany) ? $parentCompany->vat : ($parentCompany['vat'] ?? '');
                                                @endphp
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td class="text-muted" width="120">Navn:</td>
                                                        <td>{{ $parentName ?: '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">CVR:</td>
                                                        <td>{{ $parentVat ?: '-' }}</td>
                                                    </tr>
                                                </table>
                                            @else
                                                <p class="text-muted">Intet moderfirma</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Adresse -->
                            @if($address && (is_object($address) || is_array($address)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Adresse</h6>
                                    <table class="table table-sm table-borderless">
                                        @if(is_object($address))
                                            <tr>
                                                <td class="text-muted" width="120">Vej:</td>
                                                <td>{{ $address->street ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Postnr:</td>
                                                <td>{{ $address->post_code ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">By:</td>
                                                <td>{{ $address->city ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Land:</td>
                                                <td>{{ $address->country->name ?? null }}</td>
                                            </tr>
                                        @elseif(is_array($address))
                                            <tr>
                                                <td class="text-muted" width="120">Vej:</td>
                                                <td>{{ $address['street'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Postnr:</td>
                                                <td>{{ $address['post_code'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">By:</td>
                                                <td>{{ $address['city'] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Land:</td>
                                                <td>{{ $address['country'] ?? 'Danmark' }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Kontakter -->
                            @if(!empty($contacts) && (is_array($contacts) || (is_object($contacts) && count($contacts) > 0)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Kontakter</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Navn</th>
                                                    <th>Email</th>
                                                    <th>Telefon</th>
                                                    <th>Rolle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contacts as $contact)
                                                    @php
                                                        $contactName = is_object($contact) ? ($contact->first_name . ' ' . $contact->last_name) : 
                                                            (($contact['first_name'] ?? '') . ' ' . ($contact['last_name'] ?? ''));
                                                        $contactEmail = is_object($contact) ? $contact->email : ($contact['email'] ?? '');
                                                        $contactPhone = is_object($contact) ? $contact->phone : ($contact['phone'] ?? '');
                                                        $contactRole = '';
                                                        
                                                        if (is_object($contact) && isset($contact->pivot)) {
                                                            $contactRole = $contact->pivot->role ?? '';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ trim($contactName) ?: '-' }}</td>
                                                        <td>
                                                            @if($contactEmail)
                                                                <a href="mailto:{{ $contactEmail }}" class="text-primary">
                                                                    {{ $contactEmail }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($contactPhone)
                                                                <a href="tel:{{ $contactPhone }}" class="text-primary">
                                                                    {{ $contactPhone }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $contactRole ?: '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Tags -->
                            @if(!empty($tags) && (is_array($tags) || (is_object($tags) && count($tags) > 0)))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h6 class="font-weight-bold mb-3">Tags</h6>
                                    <div class="d-flex flex-wrap">
                                        @foreach($tags as $tag)
                                            @php
                                                $tagName = is_object($tag) ? $tag->name : ($tag['name'] ?? '');
                                                $tagColor = is_object($tag) ? $tag->color : ($tag['color'] ?? 'secondary');
                                            @endphp
                                            <span class="badge badge-{{ $tagColor }} mr-2 mb-2">
                                                {{ $tagName }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Yderligere information -->
                            @if($subsidiaryId)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="pt-3 border-top text-right">
                                        <small class="text-muted">Virksomhed ID: {{ $subsidiaryId }}</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                            @if($subsidiaryId)
                            <a href="{{ route('companies.edit', $subsidiaryId) }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i> Rediger virksomhed
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
@else
    <span class="text-gray-400">-</span>
@endif

<!-- JavaScript for at håndtere modals -->
@push('scripts')
<script>
// Funktion til at åbne modal med specifikt index
function openSubsidiaryModal(index) {
    $('#subsidiaryModal' + index).modal('show');
}

// Håndter Bootstrap modal lukning
$(document).ready(function() {
    $('.modal').on('hidden.bs.modal', function () {
        // Optional: Ryd data eller reset form hvis nødvendigt
    });
});
</script>
@endpush

<!-- Bootstrap CSS og JS (hvis ikke allerede inkluderet) -->
@push('styles')
<style>
    .modal-lg {
        max-width: 900px;
    }
    .table-sm td {
        padding: 0.3rem;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .badge {
        font-size: 85%;
    }
</style>
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
@endpush