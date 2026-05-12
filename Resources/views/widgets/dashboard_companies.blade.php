<div>
    <div class="row">

        <!-- Venstre kolonne: Seneste firmaer -->
        <div class="col-md-6 mb-4">
            <div class="shadow-sm border rounded-3 bg-white">
                <div class="bg-white border-bottom p-3 rounded-top">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-building mr-2"></i> Seneste Firmaer
                    </h5>
                </div>

                <ul class="list-group list-group-flush">
                    @forelse ($latestCompanies as $company)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 border-0">
                            <div class="d-flex align-items-center">

                                <img src="{{ $company->logo_url }}"
                                    class="rounded-circle mr-3 border"
                                    alt="{{ $company->name }}"
                                    style="width:30px;height:30px;object-fit:cover;"
                                >


                                <div>
                                    <div class="fw-bold">{{ $company->name }}</div>
                                    @if($company->vat)
                                        <div class="text-muted small">CVR: {{ $company->vat }}</div>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('companies.show', $company->id) }}"
                               class="btn btn-sm btn-outline-dark">
                                <i class="fas fa-eye"></i>
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-4 border-0">
                            Ingen firmaer at vise.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Højre kolonne: Statistik -->
        <div class="col-md-6 mb-4">
            <div class="shadow-sm border rounded-3 bg-white">
                <div class="bg-white border-bottom p-3 rounded-top">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-chart-pie me-2"></i> Firmastatistik
                    </h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between border-0">
                        <div>Total Firmaer</div>
                        <span class="badge bg-light text-dark border">
                            {{ number_format($totalCompanies, 0, ',', '.') }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between border-0">
                        <div>Oprettet i dag</div>
                        <span class="badge bg-light text-dark border">
                            {{ number_format($companiesCreatedToday, 0, ',', '.') }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between border-0">
                        <div>Denne måned</div>
                        <span class="badge bg-light text-dark border">
                            {{ number_format($companiesCreatedThisMonth, 0, ',', '.') }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

@push('styles')
<style>
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush
