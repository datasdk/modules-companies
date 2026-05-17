<<<<<<< HEAD
@extends('layouts.app')


@section('actions')

<a href="{{ route("companies.create") }}" class="btn btn-primary">Opret firma</a>

@endsection

@section('content')


<livewire:table 
    :config="Modules\Companies\Tables\CompanyTable::class" 
/>


=======
@extends('layouts.app')


@section('actions')

<a href="{{ route("companies.create") }}" class="btn btn-primary">Opret firma</a>

@endsection

@section('content')


<livewire:table 
    :config="Modules\Companies\Tables\CompanyTable::class" 
/>


>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
@endsection