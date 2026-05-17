@extends('layouts.app')

@section('content')



    <div class="header">

        <h1>Åbningstider</h1>

    </div>



    <form method="post" action="/settings/openinghours">


        @csrf


        <table class="stipped">
                
            <tr>
                <th>Dag</th>
                <th>Fra klokken</th>
                <th>Til klokken</th>
                <th>Lukket</th>
            </tr>
                
                
            @foreach($openinghours as $val)
                    

                <tr>
                    <td >
                        
                        {{ $days[$val->day] }}
                    
                    </td>
                    <td width="160" >

                        <div class="d-flex">

                            <select 
                            class="form-control"
                            name="value[{{ $val->company_id }}][{{ $val->day }}][from_hours]">
                                
                                    
                                @for($i2 = 0; $i2 <=23; $i2++)
                                        
                                    <option value="{{$i2}}" 
                                    @if($i2 == $val->from_hours) selected @endif
                                    >
                                    @if($i2 < 10)

                                        {{ "0".$i2 }}
                                
                                    @else

                                        {{ $i2 }}

                                    @endif
                                
                                </option>
                                            
                                @endfor
                                
                            </select>
                                
                            <span class="p-2 pr-1 pl-1">:</span>
                                
                            <select 
                            class="form-control"
                            name="value[{{ $val->company_id }}][{{ $val->day }}][from_minutes]">
                                

                                @for($i2 = 0; $i2 < 60 ; $i2+=5){
                                                                                    
                                    <option 
                                    value="{{$i2}}" 
                                    @if($i2 == $val->from_minutes) selected @endif
                                    >
                                
                                        @if($i2 < 10)

                                            {{ "0".$i2 }}
                                        
                                        @else

                                            {{ $i2 }}

                                        @endif
        
                                    </option>

                                @endfor
                                

                            </select>
                        
                        </div>

                    </td>
                    <td width="160">
                            
                            
                        <div class="d-flex">

                            <select 
                            class="form-control"
                            name="value[{{ $val->company_id }}][{{ $val->day }}][to_hours]">
                                
                                
                                @for($i2 = 0 ; $i2 <= 23 ; $i2++){
                                                    
                                    <option 
                                    value="{{$i2}}" 
                                    @if($i2 == $val->to_hours) selected @endif
                                    >
                                    
                                        @if($i2 < 10)

                                            {{ "0".$i2 }}
                                        
                                        @else

                                            {{ $i2 }}

                                        @endif
                                
                                    </option>
                    
                                @endfor                            
                            
                                
                            </select>
                                
                            <span class="p-2 pr-1 pl-1">:</span>
                                
                            <select 
                            class="form-control"
                            name="value[{{ $val->company_id }}][{{ $val->day }}][to_minutes]">
                                
                
                                @for($i2 = 0; $i2 < 60; $i2 += 5){
                                        
                                    <option 
                                    value="{{$i2}}" 
                                    @if($i2 == $val->to_minutes) selected @endif
                                    >

                                        @if($i2 < 10)

                                            {{ "0".$i2 }}
                                        
                                        @else

                                            {{ $i2 }}

                                        @endif
                                
                                    </option>
                                            
                                @endfor

                                
                            </select>

                        </div>
                            
                        
                    </td>
                    <td width="130">
                        
                        <div class="pt-2">

                            <input 
                            class="mr-1"
                            type="checkbox" 
                            name="value[{{ $val->company_id }}][{{ $val->day }}][closed]" 
                            @if($val->closed) checked @endif
                            > Lukket

                        </div>
                           
                        
                    </td>
                </tr>
                    
            @endforeach
            
            
        </table>




        <button class="btn btn-primary">Opdater åbningstider</button> 
        <a href="/settings" class="btn btn-default">Annuller</a>


    </form>
            


@endsection
