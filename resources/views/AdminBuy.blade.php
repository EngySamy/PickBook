@extends('layouts.Admin')

@section('addrequests')

      <div class="col-md-9">
          <div class="panel-body">
             @if($Requests->count()==0)
                  <div class="well well-danger" style="height: 350px; padding-top: 80px; margin-top: 65px;" >
                        <h3 class="text-center">NOTHING FOUND</h3>
                        <div class="row text-center">&nbsp;</div>
                        <h5 class="text-muted text-center">There are no buy requests to display.</h5>
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                    </div>
              @else

              <div class="list-group"  id="accordion" style="cursor: default; ">
                  <div class="list-group-item" style="color:#6F532A; border-top:0;border-left:0; border-radius:0;border-right:0; background-color:transparent; height:40px; ">
                    <span class="name" style="min-width: 300px;display: inline-block;"><strong>Item Name</strong></span>
                    <span><strong> Buyer username</strong></span>
                  </div>
                    @foreach($Requests as $Request)
                    <p class="list-group-item"  style="font-size: 14px; color: #555555;border-left:0; height:40px; border-radius:0;border-right:0; ">
                    <span class="name" style="min-width: 300px;display: inline-block;">{{str_limit($Request->Item->name,25)}}</span>
                    <span >{{$Request->Customer->username}}</span>
                    </p>

                @endforeach 
                </div>
                

                
                
            @endif
        </div>
        
        </div>


      
@endsection
