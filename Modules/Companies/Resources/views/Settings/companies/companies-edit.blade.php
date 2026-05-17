
@extends('layouts.app')

@section('meta1')

  <script src="{{ asset("modules/companies/resources/js/app.min.js") }}" defer></script>
  
@endsection

@section('content')


  <form method="post" action="{{$action}}" enctype="multipart/form-data" >


    @if($type == "edit") @method('PATCH') @endif


    @csrf


    <table class="table">

      <tr>
        <th colspan="2">Firma</th>
      </tr>


      <tr>
        <td width="150">Firmanavn</td>
        <td> 
          
          <input type="text" name="name" value="" :default="$company" />


        </td>
      </tr>


      <tr>
        <td>Cvr</td>
        <td> 
          
          <input type="text" name="vat" value="" :default="$company" />



        </td>
      </tr>

      <tr>
        <td>Adresse</td>
        <td> 
          
          <input type="text" name="street" value="" :default="$addresses" />


        </td>
      </tr>


      <tr>
        <td>Post nr.</td>
        <td> 
          
          <input type="text" name="post_code" value="" :default="$addresses" />


        </td>
      </tr>

      <tr>
        <td>By</td>
        <td> 
          
          <input type="text" name="city" value="" :default="$addresses" />


        </td>
      </tr>

      <tr>
        <td>Land</td>
        <td> 
          
          <select name="country" class="form-control">
            <option value="dk">DK</option>
          </select>
          

        </td>
      </tr>

      <tr>
        <td>Telefon</td>
        <td> 
          
          <input type="text" name="phone" value="" :default="$contact" />

        </td>
      </tr>

      <tr>
        <td>E-mail</td>
        <td> 
          
          <input type="text" name="email"  :default="$contact" />

  

        </td>
      </tr>

      <tr>
        <td>Logo</td>
        <td> 

          
          @livewire('media::file-select', [
              'name' => "logo" 
              'src' => $company["logo"]
          ])
          
  
        </td>
      </tr>

      
      <tr>
        <td>Primære firma</td>
        <td> 
          
          <label>
            
            <input type="checkbox" name="is_primary" value="1"
            
            @isset($company)

              @if($company->is_primary == 1) checked @endisset

            @endisset

            > 

            Dette firma bliver vist som det primære firma
            
          </label>

        </td>
      </tr>

    </table>

    
    <button class="btn btn-primary">Opdater Firma</button> 
    <a href="/settings/companies" class="btn btn-default">Annuller</a>


  </form>




@endsection
