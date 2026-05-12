@if($company->logo)
    <img src="{{ $company->logo }}" 
         alt="{{ $company->name ?? 'Logo' }}" 
         class="w-16 h-16 object-contain rounded border">
@else
    -
@endif
