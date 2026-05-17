<div>

    {{-- LOADING MAIN --}}
    @if($main_loading)
        <div class="text-center p-3">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only"></span>
            </div>
            Loading…
        </div>
    @else

        {{-- Hvis firma allerede valgt --}}
        @if($company)

            <div class="choosen-company">

                @if($company->getFirstMediaUrl('logo'))
                    <img src="{{ $company->getFirstMediaUrl('logo') }}" width="50">
                @endif

                {{ $company->name }} - Cvr. {{ $company->vat }}

                <span class="close" wire:click="remove">X Fjern firma</span>

                <span class="float-right text-muted pr-3">id: {{ $company->id }}</span>
            </div>

        @else

            {{-- Søgefelt --}}
            <div class="position-relative">
                <div class="input-group mb-3">
                    <input type="text"
                           class="form-control"
                           placeholder="Søg efter firma navn eller CVR..."
                           wire:model.live.debounce.500ms="searchtext"
                           autocomplete="off">
                    <div class="input-group-append">
                        <span class="input-group-text">

                            @if($loading)
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            @else

                                <i class="fas fa-search"></i>
                                
                            @endif
                        </span>
                    </div>
                </div>

                {{-- Loading i søgning --}}
                @if($loading)
                    <div class=" w-100" style="z-index: 1000; margin-top: 5px;">
                        <div class="card shadow-sm">
                            <div class="card-body p-3 text-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <span class="ml-2">Søger...</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Resultater --}}
                @if(!$loading && count($companies) > 0)
                    <div class="w-100" style="z-index: 1000; margin-top: 5px;">
                        <div class="card shadow-sm">
                            <div class="card-body p-0">
                                <div class="p-2 border-bottom bg-light">
                                    <small class="text-muted">Vælg firma</small>
                                </div>
                                <ul class="list-unstyled mb-0">
                                    @foreach($companies as $comp)
                                        <li class="company p-3 border-bottom" 
                                            wire:click="choose({{ $comp->id }})"
                                            style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>{{ $comp->name }}</strong><br>
                                                    <small class="text-muted">CVR: {{ $comp->vat }}</small>
                                                </div>
                                                <i class="fas fa-plus text-success"></i>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Ingen fundet --}}
                @if(!$loading && strlen($searchtext) >= $minChars && count($companies) === 0)
                    <div class="w-100" style="z-index: 1000; margin-top: 5px;">
                        <div class="card shadow-sm">
                            <div class="card-body p-3 text-center text-muted">
                                <i class="fas fa-search mb-2"></i><br>
                                Ingen firmaer fundet
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Hvis ID ikke eksisterer --}}
            @if($notFound)
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Firmaet blev ikke fundet, og er muligvis blevet fjernet!
                </div>
            @endif

        @endif

    @endif

</div>

<style>
.choosen-company {
    padding: 15px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    background: #f8f9fa;
    margin-bottom: 5px;
    position: relative;
}

.choosen-company img {
    margin-right: 10px;
    border-radius: 3px;
}

.company {
    transition: background-color 0.2s;
}

.company:hover {
    background-color: #f8f9fa;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    font-size: 12px;
    cursor: pointer;
    color: #dc3545;
    border: 1px solid #dc3545;
    border-radius: 3px;
    background: white;
}

.close:hover {
    background: #dc3545;
    color: white;
}

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
    top: 100%;
    left: 0;
}

/* For at sikre at dropdown er over andre elementer */
[style*="z-index: 1000"] {
    z-index: 1000;
}

/* For at sikre at input group ikon er korrekt placeret */
.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
}

/* Responsive justeringer */
@media (max-width: 768px) {
    .choosen-company {
        padding: 10px;
    }
    
    .close {
        position: relative;
        top: auto;
        right: auto;
        display: inline-block;
        margin-left: 10px;
    }
}
</style>

