@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('companies.store') }}">
    @csrf

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
                           value="{{ old('name') }}">
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
                           value="{{ old('vat') }}">
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


    <livewire:address :model="old('address') " />


    <livewire:contact :model="old('contact')" />


    @livewire('companies::company-members', [
        'members' => old('members'),
    ])


    @livewire('companies::company-subsidiaries-table', [
        'subsidiaries' => old('subsidiaries'),
    ])


    <button type="submit" class="btn btn-primary">Opret Firma</button>

    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Tilbage</a>


</form>

@endsection