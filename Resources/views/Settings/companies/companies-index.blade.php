@extends('layouts.app')

@section('meta1')


  <script src="{{ asset("modules/companies/resources/js/app.min.js") }}" defer></script>

@endsection

@section('content')





    <table class="stripped">

      <tr>
          <th>Firma</th>
          <th>Adresse</th>
          <th>Contact</th>
          <th></th>
      </tr>    


      @foreach($companies as $id => $val)
      
        <tr id="{{ $val["id"] }}">
          <td width="250">
              
              <div><strong>{{ ucfirst($val["name"]) }}</strong></div>
              @if($val["vat"])<div>Cvr. {{ $val["vat"] }}</div>@endif
       
          </td>

          <td>

            <div>{{ $val["address"] }} {{ $val["houseNo"] }}</div>
            <div>{{ $val["zipcode"] }} {{ $val["city"] }}</div>
            <div>{{ $val["country"] }}</div>
    
          </td>

          <td>


            @if($val["phone"])<div>Tlf. {{ $val["phone"] }}</div>@endif

            @if($val["email"])<div>E-mail: {{ $val["email"] }}</div>@endif

    
          </td>

          <td class="text-right">

            
            <Table-edit 
            id="{{$val['id']}}"
            model="companies"
            />
            
            

          </td>
        </tr>

      @endforeach
      
    </table>

    
    <a href="/settings" class="btn btn-default">Annuller</a>


@endsection
