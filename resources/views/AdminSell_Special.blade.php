@extends('layouts.Admin')

@section('addrequests')
      <div class="col-md-9">
          <div class="panel-body">
             @if($Requests->count()==0)
                  <div class="well well-danger" style="height: 350px; padding-top: 80px; margin-top: 65px;" >
                        <h3 class="text-center">NOTHING FOUND</h3>
                        <div class="row text-center">&nbsp;</div>
                      @if($id==0)
                        <h5 class="text-muted text-center">There are no sell requests to display.</h5>
                      @else
                        <h5 class="text-muted text-center">There are no special orders to display.</h5>
                      @endif
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                    </div>
              @else
              <table class="table table-hover" >
              <thead>
                <td><strong>Item Name</strong></td>
                <td><strong>Assigned QS</strong></td>

                @if($id==0) 
                <td><strong>Seller Username</strong></td>
                @else 
                <td><strong>Requester Username</strong></td>
                @endif

              </thead>
              <tbody style="color: #555555; border-bottom:1px solid #dddddd">
              @foreach($Requests as $Request)
                <tr onclick="getElementById('{{$Request->id}}').click()" style="cursor: pointer">
                  <td>
                
                  <a href="/{{$id}}/{{$Request->id}}/detail" id="{{$Request->id}}" style="color: inherit; font-size: 14px;">
               
                  {{str_limit($Request->name,25)}}</a></td>
                  @if(is_null($Request->QS))
                  <td>none</td>
                  @else
                  <td>{{$Request->QS->name}}</td> 
                  @endif
                  <td>{{$Request->Customer->username}}</td> 
                </tr>  
                @endforeach 
              </tbody>
            </table>  
            @endif
            <div class="text-center">
                    {!! $Requests->render() !!}    <!--Display Dynamic Pagination at the bottom-->
            </div>
        </div>
        
        </div>

@endsection
