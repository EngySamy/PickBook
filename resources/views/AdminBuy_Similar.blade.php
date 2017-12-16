@extends('layouts.Admin')

@section('addrequests')

      <div class="col-md-9">
          <div class="panel-body">
             @if($Requests->count()==0)
                  <div class="well well-danger" style="height: 350px; padding-top: 80px; margin-top: 65px;" >
                        <h3 class="text-center">NOTHING FOUND</h3>
                        <div class="row text-center">&nbsp;</div>
                        <h5 class="text-muted text-center">There are no @if($id==2) buy requests @else similar special orders @endif to display.</h5>
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                    </div>
              @else

              <div class="list-group"  id="accordion" style="cursor: default; ">
                  <div class="list-group-item" style="color:#6F532A; border-top:0;border-left:0; border-radius:0;border-right:0; background-color:transparent; height:40px; ">
                    <span class="name" style="min-width: 300px;display: inline-block;"><strong>Item Name</strong></span>
                    <span style="min-width: 200px;display: inline-block;"><strong>Assigned QS</strong></span>
                    <span><strong>@if($id==2) Buyer @else Requester @endif username</strong></span>
                  </div>
                    @foreach($Requests as $Request)
                    <a class="list-group-item" href="#{{$Request->id}}" data-parent="#accordion" data-toggle="collapse" style="font-size: 14px; color: #555555;border-left:0; height:40px; border-radius:0;border-right:0; ">
                    <span class="name" style="min-width: 300px;display: inline-block;">{{str_limit($Request->Item->name,25)}}</span> 
                    <span style="min-width: 200px;display: inline-block;">
                      @if($Request->QS==null)
                          None
                      @else
                         {{$Request->QS->name}}
                      @endif
                    </span>
                        <span >{{$Request->Customer->username}}</span>
                    </a>  
                      <div id="{{$Request->id}}" class="collapse">
                      @if($Request->qs_id==NULL)                   
                        <li class="buy"><a  tabindex="-1" href="/{{$id}}/{{$Request->id}}/serve/BS" style="font-size: 14px;">Serve</a></li>
                      @elseif($Request->qs_id==$qs)
                        <li class="buy">
                          @if($id==2)
                          <a  tabindex="-1" href="/{{$Request->buyer_id}}/customer" style="font-size: 14px;">Buyer Info</a>
                          @else
                          <a  tabindex="-1" href="/{{$Request->requester_id}}/customer" style="font-size: 14px;">Requester Info</a>
                          @endif
                        </li>
                        <li class="buy"><a  tabindex="-1" href="/{{$Request->Item->seller_id}}/customer" style="font-size: 14px;">Seller Info</a></li>
                        <li class="buy"><a  tabindex="-1" href="/{{$Request->Item->id}}/item" style="font-size: 14px;">Item Info</a></li>
                        <li class="buy"><a  tabindex="-1" href="/{{$id}}/{{$Request->id}}/messages/BS" style="font-size: 14px;">Send Message for @if($id==2) Buyer @else Requester @endif </a></li>@if($id==2) 
                        <li class="buy"><a  tabindex="-1" href="#" style="font-size: 14px;" id="reoffer"> Reoffer this item </a></li>
                        @endif
                        <li class="buy"><a  tabindex="-1" href="#" style="font-size: 14px;" id="archive">Archive</a></li> 

                        <!-- Archive Modal -->
                        <div class="modal fade" id="archivemodal" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                
                                <h4 class="modal-title">Archive " {{$Request->Item->name}} " @if($id==2) buy request @else similar special order @endif </h4> 
                              </div>

                              <div class="modal-body" >
                                <br>
                                <form action="/{{$id}}/{{$Request->id}}/archive/BS" method="POST">
                                <div class="form-group">
                                  <label class="col-md-4 control-label" style="text-align: right;">Confirm Your Password</label>
                                  <div class="col-md-7">
                                      <input type="Password" class="form-control input-sm" name="Password" placeholder="Minimum is 6 characters" autocomplete="off">
                                  </div>
                                  <br>
                                  <br>
                                
                              </div>
                              <div class="modal-footer">
                                 
                                  {{ csrf_field() }}     
                                  <button type="submit" class="btn btn-primary">Confirm</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                
                               </div>
                              </form>
                            </div>
                            
                          </div>
                        </div>

                        <script>
                        $(document).ready(function(){
                            $("#archive").click(function(){
                                $("#archivemodal").modal({backdrop: "static"});
                            });
                        });
                        </script>

                        </div>
                        <!--  -->

                       <!-- Reoffer Modal -->
                        <div class="modal fade" id="reoffermodal" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                
                                <h4 class="modal-title">Reoffer " {{$Request->Item->name}} " for sale </h4> 
                              </div>

                              <div class="modal-body" >
                                <br>
                                <form action="/{{$id}}/{{$Request->id}}/reoffer/BS" method="POST">
                                <div class="form-group">
                                  <label class="col-md-4 control-label" style="text-align: right;">Confirm Your Password</label>
                                  <div class="col-md-7">
                                      <input type="Password" class="form-control input-sm" name="Password" placeholder="Minimum is 6 characters" autocomplete="off">
                                  </div>
                                  <br>
                                  <br>
                                
                              </div>
                              <div class="modal-footer">
                                 
                                  {{ csrf_field() }}     
                                  <button type="submit" class="btn btn-primary">Confirm</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                
                               </div>
                              </form>
                            </div>
                            
                          </div>
                        </div>

                        <script>
                        $(document).ready(function(){
                            $("#reoffer").click(function(){
                                $("#reoffermodal").modal({backdrop: "static"});
                            });
                        });
                        </script>

                        </div>
                        <!--  -->

                      @else                     
                        <li style="font-size: 14px; color: #606d7a; padding-right: 15px;">The request is assigned to another QS</li>
                      @endif 
                      </div> 
                  
                @endforeach 
                </div>
                

                
                
            @endif
        </div>
        
        </div>


      
@endsection
