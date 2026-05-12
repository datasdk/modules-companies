@if($members && count($members))
    <ul class="list-disc pl-4 text-sm">
        @foreach($members as $member)
            @php
                // Hent data baseret på om det er et objekt eller array
                $firstName = $member->first_name ?? $member['first_name'] ?? '';
                $lastName = $member->last_name ?? $member['last_name'] ?? '';
                $fullName = trim("{$firstName} {$lastName}");
                $email = $member->email ?? $member['email'] ?? '';
                $phone = $member->phone ?? $member['phone'] ?? $member['contact']['phone'] ?? '';
                $createdAt = $member->created_at ?? $member['created_at'] ?? null;
                $memberId = $member->id ?? $member['id'] ?? null;
                
                // Hvis det er en Eloquent model, hent relationer
                $companies = [];
                $address = null;
                
                if (is_object($member)) {
                    if (method_exists($member, 'companies')) {
                        $companies = $member->companies ?? $member->companies()->get() ?? [];
                    }
                    if (method_exists($member, 'address')) {
                        $address = $member->address ?? $member->address()->first();
                    }
                }
                
                // Formatér dato
                $formattedDate = $createdAt ? $createdAt->format('d-m-Y H:i') : ($createdAt ?? 'Ikke tilgængelig');
            @endphp
            
            <li>
                <a href="javascript:void(0)" 
                   class="text-blue-600 hover:text-blue-800 hover:underline cursor-pointer"
                   data-toggle="modal" 
                   data-target="#memberModal{{ $loop->index }}"
                   onclick="openMemberModal('{{ $loop->index }}')">
                    {{ $fullName ?: '-' }}
                </a>
                @if(isset($member->pivot->membership_percentage))
                    ({{ $member->pivot->membership_percentage }}%)
                @endif
            </li>
            
            <!-- Modal for denne medlem -->
            <div class="modal fade" id="memberModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel{{ $loop->index }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="memberModalLabel{{ $loop->index }}">
                                Medlemsoplysninger: {{ $fullName ?: 'Ukendt' }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Personlige oplysninger -->
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold mb-3">Personlige oplysninger</h6>
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-muted" width="120">Fornavn:</td>
                                            <td>{{ $firstName ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Efternavn:</td>
                                            <td>{{ $lastName ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Email:</td>
                                            <td>
                                                @if($email)
                                                    <a href="mailto:{{ $email }}" class="text-primary">
                                                        {{ $email }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Telefon:</td>
                                            <td>
                                                @if($phone)
                                                    <a href="tel:{{ $phone }}" class="text-primary">
                                                        {{ $phone }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Oprettet:</td>
                                            <td>{{ $formattedDate }}</td>
                                        </tr>
                                        @if(isset($member->pivot->membership_percentage))
                                        <tr>
                                            <td class="text-muted">Andel:</td>
                                            <td class="font-weight-bold">{{ $member->pivot->membership_percentage }}%</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                                
                                <!-- Adresse -->
                                <div class="col-md-6">
                                    <h6 class="font-weight-bold mb-3">Adresse</h6>
                                    @if($address && (is_object($address) || is_array($address)))
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
                                    @else
                                        <p class="text-muted">Ingen adresseoplysninger</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Firmaer -->
                            @if(!empty($companies) && (is_array($companies) || (is_object($companies) && count($companies) > 0)))
                            <div class="mt-4">
                                <h6 class="font-weight-bold mb-3">Tilknyttede firmaer</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Firmanavn</th>
                                                <th>CVR</th>
                                                <th>Rolle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($companies as $company)
                                                @php
                                                    $companyName = is_object($company) ? $company->name : ($company['name'] ?? '');
                                                    $companyVat = is_object($company) ? $company->vat : ($company['vat'] ?? '');
                                                    $companyRole = '';
                                                    
                                                    // Hvis der er pivot data (rolle)
                                                    if (is_object($company) && isset($company->pivot)) {
                                                        $companyRole = $company->pivot->role ?? '';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $companyName ?: '-' }}</td>
                                                    <td>{{ $companyVat ?: '-' }}</td>
                                                    <td>{{ $companyRole ?: '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Yderligere information -->
                            @if($memberId)
                            <div class="mt-4 pt-3 border-top text-right">
                                <small class="text-muted">Medlem ID: {{ $memberId }}</small>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                            @if($memberId && is_object($member))
                            <a href="{{ route('users.edit', $memberId) }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i> Rediger
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
function openMemberModal(index) {
    $('#memberModal' + index).modal('show');
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
        max-width: 800px;
    }
    .table-sm td {
        padding: 0.3rem;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endpush

