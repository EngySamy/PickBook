@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        <p class="lead">Inbox</p>
            <div class="list-group">
                <a href="/0/inbox" class="list-group-item {{ Request::is('0/inbox') ? 'active' : '' }}" style="height: 40px;">Sell Requests Messages</a>
                <a href="/2/inbox" class="list-group-item {{ Request::is('2/inbox') ? 'active' : '' }}" style="height: 40px;">Buy Requests Messages</a>
                <a href="/1/inbox" class="list-group-item {{ Request::is('1/inbox') ? 'active' : '' }}" style="height: 40px;">New Special Orders Messages</a>
                <a href="/3/inbox" class="list-group-item {{ Request::is('3/inbox') ? 'active' : '' }}" style="height: 40px;">Similar Special Orders Messages</a>
            </div>

      </div>
        
        
        <div class="col-md-9">
          <p class="lead">Current Conversations</p>
          @if($Replies==null)
                  <div class="well well-danger" >
                        <h3 class="text-center">NOTHING FOUND</h3>
                        <div class="row text-center">&nbsp;</div>
                        <h5 class="text-muted text-center">There are no messages to display.</h5>
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                    </div>
          @else
             
          <div class="list-group" style="margin-top: 20px;">
              @foreach($Replies as $Reply)

               
              <a href="/{{$id}}/{{$Reply->req}}/inbox/msg" class="list-group-item" >
                  <span class="name" style="min-width: 120px;display: inline-block;"><strong>Req. #{{$Reply->req}} - {{$Reply->reqName}}</strong></span>
                   <span class="badge" style="margin:4px; background-color:#45362E;">{{$Reply->created_at}}</span> 
                   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                 
                @endforeach     

            </div>
            @endif
          </div>     
    </div>
</div>
@endsection