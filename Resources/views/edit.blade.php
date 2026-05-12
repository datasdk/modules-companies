@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('companies.update', $company->id) }}">
    @csrf
    @method('PATCH')

    {{-- Company Form Fields --}}
    <section>
        <table class="table">
            <tr>
                <th colspan="2">Firma</th>
            </tr>

            {{-- Firmanavn --}}
            <tr>
                <td width="150">Firmanavn</td>
                <td>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $company->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- CVR --}}
            <tr>
                <td>CVR</td>
                <td>
                    <input type="text"
                           name="vat"
                           class="form-control @error('vat') is-invalid @enderror"
                           value="{{ old('vat', $company->vat) }}">
                    @error('vat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>

            {{-- Logo --}}
            <tr>
                <td>Logo</td>
                <td>
                    <livewire:media::file-select wire:model="company.images" />
                    @error('company.images')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>
    </section>

    {{-- Adresse --}}
    <livewire:address :model="$company" />

    {{-- Kontakt --}}
    <livewire:contact :model="$company" />




    @livewire('companies::company-members', [
        'members' => $company->members
    ])


    @livewire('companies::company-subsidiaries-table', [
        'subsidiaries' => $company->subsidiaries,
        'excludes' => [$company->id]
    ])

    <button type="submit" class="btn btn-primary">Opdater Firma</button>

    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Tilbage</a>

</form>

@endsection