@extends('layouts.home') 

@section('css')

<link rel="stylesheet" href="homeshow.css">

@endsection

@section('content')


<div class="container-fluid" style="min-height: 80vh">

  <div class="card">
    <div class="card-body">
      @if($errors->any())
       <div class="alert alert-danger">
          {{ implode('', $errors->all(':message')) }}
        </div>
      @endif
      <form action="{{route('reservation.create',['bus'=>$bus])}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <img src="{{asset($bus->img)}}" class="img-fluid" alt="">

          </div>

          <div class="col-sm-12 col-md-8">
            <div class="col-xs-5 pt-sm-4 pt-md-0">
              <h3 class="text-primary">{{$bus->name}}</h3>    
              <p>Bus code : <span class="text-primary">{{$bus->bus_code}}</span></p>

              <div class="my-2">
                <div>
                    <div>From: <span class="text-primary">{{$bus->from}}</span> </div>
                    <div>To: <span class="text-primary">{{$bus->to}}</span></div>
                </div>
              </div> 

              <div class="my-2">
                <h4><small>Fare:<span class="text-primary">  Rs. {{$bus->fare}}</span></small></h4>
                
              </div> 
              
              <div class="my-2">
                <div>
                    <div>Arrival days: <span class="text-primary">{{$bus->arrival_days}}</span> </div>
                    <div>Arrival time: <span class="text-primary">{{$bus->arrival_time}}</span></div>
                </div>
              </div> 

              <div class="my-4">
                  <div class="row align-items-center">
                      <div class="col-sm-6 col-md-4"><i class="fas fa-users"></i> No of passengers</div>
                      <input value="{{old('passengers') ?? '1'}}" name="passengers" class="form-control col-sm-6 col-md-4" required/>
                  </div>
              </div>    

              <div class="my-4">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-4"><i class="fas fa-phone"></i> Phone</div>
                    <input value="{{old('phone')}}" name="phone" class="form-control col-sm-6 col-md-4" required/>
                </div>
            </div>                

              <div class="my-2">
                <div>
                    <div>Additional query</div>
                    <textarea name="additional_query" class="form-control" rows="4"></textarea>
                    <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-shopping"></i>Send booking request</button>
            </div>   

          </div>
        </div>

    </form>

    <!-- The rest of the blade file remains unchanged -->

<!-- Add the following code to display seats -->



<div class="my-4">
  <h3>Total Seats</h3>
  <table class="bus-seats">
      @foreach ($arrangedSeats as $row => $seats)
          <tr>
              @foreach ($seats as $index => $seat)
                  @php $isBooked = $seat->is_booked; @endphp
                  @if($index % 4 === 0 && $index !== 0)
                      </tr><tr>
                  @endif
                  <td class="seat {{ $isBooked ? 'booked' : '' }}">
                      <label class="seat-label">{{ $seat->seat_number }}</label>
                      <input type="checkbox" name="selected_seats[]" value="{{ $seat->id }}" @if($isBooked) disabled @endif />
                  </td>
              @endforeach
              @if(count($seats) % 4 !== 0)
                  @for($i = count($seats) % 4; $i < 4; $i++)
                      <td></td>
                  @endfor
              @endif
          </tr>
      @endforeach
  </table>
</div>


  
{{--   
    <div class="my-4">
      <h3>Seats</h3>
      <table class="bus-seats">
          @foreach ($arrangedSeats as $row => $seats)
              <tr>
                  @foreach ($seats as $index => $seat)
                      @if ($index % 4 === 0 && $index !== 0)
                          </tr><tr>
                      @endif
                      <td class="seat {{ $seat->is_booked ? 'booked' : '' }}">
                          <label class="seat-label">{{ $seat->seat_number }}</label>
                          <input type="checkbox" name="selected_seats[]" value="{{ $seat->id }}" @if($seat->is_booked) disabled @endif />
                      </td>
                  @endforeach
                  @if (count($seats) % 4 !== 0)
                      @for ($i = count($seats) % 4; $i < 4; $i++)
                          <td></td>
                      @endfor
                  @endif
              </tr>
          @endforeach
      </table>
  </div>

   --}}
  
  
  
    
    {{-- <div class="my-4">
      <h3>Total Seats</h3>
      <table>
          @foreach ($arrangedSeats as $row => $seats)
              <tr>
                  @foreach ($seats as $seat)
                      <td>
                          Seat: {{ $seat->seat_number }}
                          <!-- You can display other seat attributes here if needed -->
                      </td>
                  @endforeach
              </tr>
          @endforeach
      </table>
    </div> --}}

    </div>
  </div>


</div>
@endsection
