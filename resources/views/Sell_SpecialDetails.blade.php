@extends('layouts.app')

@section('includes')
 <link href={{ URL::asset('assets/item/css/shop-item.css') }} rel="stylesheet">
 <link rel="stylesheet" href="/assets/font-awesome-4.6.3/css/font-awesome.min.css">

 <script src="/assets/js/vendor/jquery.min.js"></script>
@endsection

@section('content')
 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-7">
                <div class="well">
                  @if(Session::has('message'))
                        <div class="form-group">   
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>         
                        </div>
                      @endif

                      @if ($errors->has('Password'))

                          <div class="form-group">   
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}"><strong>Wrong password. Try again please.</strong></p>         
                        </div>
                              
                      @endif 

                      @if ($errors->has('Price'))
                          <div class="form-group">   
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}"><strong>{{ $errors->first('Price') }}</strong></p>         
                        </div>
                      @endif        
                  <div class="row carousel-holder">
                    <div class="col-md-12">
                         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for($i=0;$i<$images->count();$i++)
                                  <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active"></li>
                                @endfor

                            </ol>
                            <div class="carousel-inner">
                                @foreach($images as $index=>$image)
                                    <div class="item @if($index == 0) {{ 'active' }} @endif">
                                        <a href="{{url($image->link)}}"><img class="img-responsive center-block slide-image" style="height:360px; width:auto;" src="{{url($image->link)}}" alt=""/></a>
                                    </div>
                                @endforeach
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                      </div>  
                  </div>  
                </div>            
                        


                    <div  style="margin: 0 auto; text-align: center;">
                      <div class="btn-group" style="position: relative;">

                      @if($id==0)
                        <a href="#" class="btn btn-primary" id="accept">Accept</a>
                        <a href="#" id="refuse" class="btn btn-primary">Refuse</a>
                      @else
                        <a href="#" id="refuse" class="btn btn-primary">Archive</a>
                       @endif

                      </div>
                    </div>

                
            </div>
                
             <div class="col-md-5">

                   <div class="caption-full description well">
                        <h4 class="text-center"><a href="#">{{$Request->name}}</a></h4>
                        <ul>
                          <li style="padding-top: 20px;">
                         
                            <h4>
                            @if($id==0)
                            <strong>Publish Request No. </strong>
                            @else
                            <strong>Special Order No. </strong>
                            @endif

                            <h5 class="text-muted" style="padding-left: 25px">{{$Request->id}}</h5>
                            </h4>

                          <li style="padding-top: 20px;">
                            <h4><strong>Category </strong>
                            @if($Request->category!=null)
                            <h5 class="text-muted" style="padding-left: 25px">{{$Request->category->name}}</h5>
                            @else
                            <h5 class="text-muted" style="padding-left: 25px">None</h5>
                            @endif
                            </h4>
                            
                          </li>
                          <li style="padding-top: 20px;">
                            <h4> <strong>Language </strong>
                            @if($Request->language!=null)
                            <h5 class="text-muted" style="padding-left: 25px">{{$Request->language->name}}</h5>
                            @else
                            <h5 class="text-muted" style="padding-left: 25px">None</h5>
                            @endif
                            </h4>     
                          </li>
                          <li style="padding-top: 20px;">
                              <h4><strong>Author </strong>
                              <h5 class="text-muted" style="padding-left: 25px"> {{$Request->author}} </h5>

                              </h4>
                          </li>
                          <li style="padding-top: 20px;">
                              <h4><strong>Publisher </strong>
                              <h5 class="text-muted" style="padding-left: 25px">{{$Request->Customer->name}}</h5>
                              </h4>
                          </li>
                          <li style="padding-top: 20px;">
                             <h4> <strong>Offered Price </strong>
                              <h5 class="text-muted" style="padding-left: 25px">{{$Request->price}} LE</h5>
                             </h4>
                          </li>
                         
                            
                        </ul>
                        </div>
                </div>

    </div>
    </div>




<!-- Accept Modal -->
<div class="modal fade" id="acceptmodal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Accept "{{$Request->name}}" sell request</h4>
      </div>

      <div class="modal-body" >
          <br>
          <form action="/{{$Request->id}}/accept" method="POST">
          <div class="form-group">
              <label class="col-md-4 control-label" style="text-align: right;">Total price</label>

              <div class="col-md-7">
                  <input type="text" pattern="^[0-9]{1,5}$"  maxlength="8" title="A price should contain a number only (with maximum value 99999)" class="form-control input-sm" name="Price"  placeholder="00000" autocomplete="off">
              </div>
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
      $("#accept").click(function(){
          $("#acceptmodal").modal({backdrop: "static"});
      });
  });
  </script>

</div>
    



<!-- Refuse Modal -->
<div class="modal fade" id="refusemodal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal">×</button>
        @if($id==0)
        <h4 class="modal-title">Refuse "{{$Request->name}}" sell request</h4>
        @else
        <h4 class="modal-title">Archive "{{$Request->name}}" special order</h4>
        @endif
      </div>

      <div class="modal-body" >
        <br>
         @if($id==0)
          <form action="/{{$Request->id}}/refuse" method="POST">
          @else
          <form action="/{{$Request->id}}/archive/S" method="POST">
          @endif
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
    $("#refuse").click(function(){
        $("#refusemodal").modal({backdrop: "static"});
    });
});
</script>

</div>




@endsection