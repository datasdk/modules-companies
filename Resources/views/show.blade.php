<<<<<<< HEAD
@extends('layouts.app')

@section('content')


{{-- Company Info --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Firmanavn</th>
        <td>{{ $company->name ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">CVR</th>
        <td>{{ $company->vat ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Primært</th>
        <td>{{ $company->is_primary ? 'Ja' : 'Nej' }}</td>
    </tr>
    <tr>
        <th width="150">Logo</th>
        <td>
            @if($company->image)
                <img src="{{ $company->image }}" alt="Logo" width="50">
            @else
                -
            @endif
        </td>
    </tr>
</table>

{{-- Address --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Street</th>
        <td>{{ $company->address->street ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Post Code</th>
        <td>{{ $company->address->post_code ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">City</th>
        <td>{{ $company->address->city ?? '-' }}</td>
    </tr>
</table>

{{-- Contact --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Phone</th>
        <td>{{ $company->contact->phone ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Email</th>
        <td>{{ $company->contact->email ?? '-' }}</td>
    </tr>
</table>

{{-- Members --}}
<h4>Medlemmer / Ejere</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Navn</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Rolle</th>
        </tr>
    </thead>
    <tbody>
        @forelse($company->members as $member)
        <tr>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            <td>{{ $member->email ?? '-' }}</td>
            <td>{{ $member->contact->phone ?? '-' }}</td>
            <td>{{ $member->roles->pluck('name')->join(', ') ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center"><i>Ingen medlemmer</i></td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Subsidiaries --}}
<h4>Datterselskaber</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Firmanavn</th>
            <th>CVR</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
        @forelse($company->subsidiaries as $subsidiary)
        <tr>
            <td>{{ $subsidiary->name }}</td>
            <td>{{ $subsidiary->vat }}</td>
            <td>
                {{ $subsidiary->address->street ?? '-' }},
                {{ $subsidiary->address->post_code ?? '' }}
                {{ $subsidiary->address->city ?? '' }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center"><i>Ingen datterselskaber</i></td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3">Tilbage</a>

@endsection
=======
@extends('layouts.app')

@section('content')


{{-- Company Info --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Firmanavn</th>
        <td>{{ $company->name ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">CVR</th>
        <td>{{ $company->vat ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Primært</th>
        <td>{{ $company->is_primary ? 'Ja' : 'Nej' }}</td>
    </tr>
    <tr>
        <th width="150">Logo</th>
        <td>
            @if($company->image)
                <img src="{{ $company->image }}" alt="Logo" width="50">
            @else
                -
            @endif
        </td>
    </tr>
</table>

{{-- Address --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Street</th>
        <td>{{ $company->address->street ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Post Code</th>
        <td>{{ $company->address->post_code ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">City</th>
        <td>{{ $company->address->city ?? '-' }}</td>
    </tr>
</table>

{{-- Contact --}}
<table class="table table-bordered">
    <tr>
        <th width="150">Phone</th>
        <td>{{ $company->contact->phone ?? '-' }}</td>
    </tr>
    <tr>
        <th width="150">Email</th>
        <td>{{ $company->contact->email ?? '-' }}</td>
    </tr>
</table>

{{-- Members --}}
<h4>Medlemmer / Ejere</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Navn</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Rolle</th>
        </tr>
    </thead>
    <tbody>
        @forelse($company->members as $member)
        <tr>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            <td>{{ $member->email ?? '-' }}</td>
            <td>{{ $member->contact->phone ?? '-' }}</td>
            <td>{{ $member->roles->pluck('name')->join(', ') ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center"><i>Ingen medlemmer</i></td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Subsidiaries --}}
<h4>Datterselskaber</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Firmanavn</th>
            <th>CVR</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
        @forelse($company->subsidiaries as $subsidiary)
        <tr>
            <td>{{ $subsidiary->name }}</td>
            <td>{{ $subsidiary->vat }}</td>
            <td>
                {{ $subsidiary->address->street ?? '-' }},
                {{ $subsidiary->address->post_code ?? '' }}
                {{ $subsidiary->address->city ?? '' }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center"><i>Ingen datterselskaber</i></td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3">Tilbage</a>

@endsection
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
