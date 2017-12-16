@extends('layouts.app')
@section('includes')
<style >

.input-arreglo-group{
    padding: 0px 0px;
}
.input-arreglo{
    margin-top: 0px; 
    height: calc(100% + 15px); 
    border-top-left-radius: 0px; 
    border-bottom-left-radius: 0px;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @if(Auth::user()->role==1)
        <div class="col-sm-4 col-md-3">
        <p class="lead">Inbox</p>
            <div class="list-group">
                <a href="/0/inbox" class="list-group-item {{ Request::is('0/inbox') ? 'active' : '' }}" style="height: 40px;">Sell Requests Messages</a>
                <a href="/2/inbox" class="list-group-item {{ Request::is('2/inbox') ? 'active' : '' }}" style="height: 40px;">Buy Requests Messages</a>
                <a href="/1/inbox" class="list-group-item {{ Request::is('1/inbox') ? 'active' : '' }}" style="height: 40px;">Special Orders Messages</a>
                <a href="/3/inbox" class="list-group-item {{ Request::is('3/inbox') ? 'active' : '' }}" style="height: 40px;">Special Order of Sold Items Messages</a>
            </div>

      </div>
      @endif
         @if($Close->closed == false)
                @if(Auth::user()->role==2)
                   <div class="col-md-12">
                @else
                   <div class="col-md-9">
                @endif
                <form action="/{{$id}}/{{$req}}/reply" method="post">
                {!! csrf_field() !!}
                    <p class="lead">Compose</p>
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                    <div class="input-group">
                        <textarea class="form-control custom-control" rows="3" style="resize:vertical; border:1px solid #dddddd" placeholder="Click here to reply." name="reply" maxlength="1000"></textarea>
                        
                        <div class="input-group-addon input-arreglo-group" style="border:0">
                        <button class="btn btn-brimary input-arreglo" style="color:black">
                            Send
                        </button>
                    </div>
                        
                    </div>   
                </form>
                </div>
         @endif
         <br>
        @if(Auth::user()->role==1)
        <div class="col-sm-8 col-md-9">
          <p class="lead">History</p>
            
        @elseif(Auth::user()->role==2)
        <div class="col-md-12">
            <p class="lead">History</p>
            @if(count($reqReplies)==0)
                <div class="well well-danger" style="height: 100px; padding-top: 2px; margin-top: 30px;" >
                        <div class="row text-center">&nbsp;</div>
                        <h5 class="text-muted text-center">There are no recent messages to display.</h5>
                    </div>
            @endif
        @endif   
          <div class="list-group" style="margin-top: 20px;" >
              @for($i=0;$i<count($reqReplies);$i++)
              <a href="#{{$i}}" class="list-group-item" data-toggle="collapse" style="border-left:0px; border-right:0; border-radius:0;">
                 @if($reqReplies[$i]->isCustomer ==true)
                  <span class="name" style="min-width: 120px;display: inline-block;"><strong>You:</strong></span>
                  @else
                  <span class="name" style="min-width: 120px;display: inline-block;"><strong>PickBook:</strong></span>
                  @endif
                   <span >{{str_limit($reqReplies[$i]->text,30)}}</span>
                   <span class="pull-right"> <!-- -->
                   <span class="badge" style="margin:4px; background-color:#45362E;">{{$reqReplies[$i]->created_at}}</span> <span class="pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></span> </span></a>
                  <div id="{{$i}}" class="collapse wordwrap" style="font-size: 14px; margin:15px; margin-left:50px; margin-right:50px;">
                  {{$reqReplies[$i]->text}}
                  </div>
                 
                @endfor  
                <br>

               
            </div>

          </div>
          
                
       </div>     
            
       
</div>
<style>
    .wordwrap {   
   white-space: -moz-pre-wrap; /* Firefox */    
   white-space: -pre-wrap;     /* Opera <7 */   
   white-space: -o-pre-wrap;   /* Opera 7 */    
   word-wrap: break-word;      /* IE */
}
</style>
@endsection