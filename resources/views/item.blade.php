@extends('layouts.app')

@section('includes')
<link href={{ URL::asset('assets/item/css/shop-item.css') }} rel="stylesheet">
 <link rel="stylesheet" href={{ URL::asset('assets/item/css/star-rating.css') }} media="all" rel="stylesheet" type="text/css"/>

 <script src="/assets/js/vendor/jquery.min.js"></script>
 <script src={{ URL::asset('assets/item/js/star-rating.js') }} type="text/javascript"></script>

 
@endsection

@section('content')
 <!-- Page Content -->
    <div class="container">

        <div class="row">


            <div class="col-md-5">

                <div class="caption-full description well">
                    <h4 class="text-center"><a href="#">{{$item->name}}</a></h4>
                    <ul>
                        <li style="padding-top: 20px;">
                            <h4><strong>Book No. </strong>
                                <h5 class="text-muted" style="padding-left: 25px">{{$item->id}}</h5>
                            </h4>

                        <li style="padding-top: 20px;">
                            <h4><strong>Category </strong>
                                @if($item->category!=null)
                                    <h5 class="text-muted" style="padding-left: 25px">{{$item->category->name}}</h5>
                                @else
                                    <h5 class="text-muted" style="padding-left: 25px">None</h5>
                                @endif
                            </h4>

                        </li>
                        <li style="padding-top: 20px;">
                            <h4> <strong>Language </strong>
                                @if($item->language!=null)
                                    <h5 class="text-muted" style="padding-left: 25px">{{$item->language->name}}</h5>
                                @else
                                    <h5 class="text-muted" style="padding-left: 25px">None</h5>
                                @endif
                            </h4>
                        </li>
                        <li style="padding-top: 20px;">
                            <h4><strong>Author </strong>
                                <h5 class="text-muted" style="padding-left: 25px">{{$item->author}} </h5>
                            </h4>
                        </li>
                        <li style="padding-top: 20px;">
                            <h4><strong>Publisher </strong>
                                <h5 class="text-muted" style="padding-left: 25px">{{$item->publisher->name}}</h5>
                            </h4>
                        </li>
                        <li style="padding-top: 20px;">
                            <h4> <strong>Price </strong>
                                <h5 class="text-muted" style="padding-left: 25px">{{$item->price}} LE</h5>
                            </h4>
                        </li>
                        <li style="padding-top: 20px;">
                            <h4><strong>Average Rating </strong>
                                <h5 style="padding-left: 25px">
                                    @for($i=0;$i<$avg_rate&&$i<5;$i++)
                                        <span class="glyphicon glyphicon-star gold"></span>
                                    @endfor
                                    @for($i=0;$i<5-$avg_rate;$i++)
                                        <span class="glyphicon glyphicon-star-empty gold"></span>
                                    @endfor
                                </h5>
                            </h4>
                    </ul>
                </div>

                <h4><strong>Add review</strong></h4>


                <form id="review_form" action="/item/{{$item->id}}/review" method="post" >
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <textarea id="review" name="review" class="form-control" rows="3" id="review" placeholder="write your review ... "></textarea>
                    </div>
                    <button id="review_button" type="submit" class="btn btn-primary" >Review</button>

                </form>

            </div>

            <div class="col-md-7">
                @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="well">
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @if($images!=null)
                                    @for($i=0;$i<$images->count();$i++)
                                      <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active"></li>
                                    @endfor
                                @endif

                            </ol>
                            <div class="carousel-inner">
                                @if($images!=null)
                                @foreach($images as $index=>$image)
                                    <div class="item @if($index == 0) {{ 'active' }} @endif">
                                        <a href="{{url($image->link)}}"><img class="img-responsive center-block slide-image" style="height:360px; width:auto;" src="{{url($image->link)}}" alt=""/></a>
                                    </div>
                                @endforeach
                                    @endif
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
                        @if(Auth::user()->role==1 || Auth::user()->role==4 || Auth::user()->role==2)
                        <div class="form-group" style="padding-top: 30px; padding-bottom: 20px;">

                              <div class="span12" style="text-align: center">
                                

                                <!-- For Buy Request -->
                                <button type="button" class="btn btn-primary" id="order">

                                    @if(Auth::user()->role==2) <i class="fa fa-trash fa-btn"></i> Remove Book
                                    @else <span class="glyphicon glyphicon-shopping-cart" style="padding-right: 10px;"></span> Order this Book
                                    @endif
                                </button>
                              </div> <!-- //////////////////////////////////////// -->



                                <!-- Modal -->
                                <div class="modal fade" id="confirm" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header" style="text-align:center;" >
                                        <button type="button" class="close" data-dismiss="modal">×</button>

                                        <h4 class="modal-title">
                                            @if(Auth::user()->role==2) Remove
                                            @else Order
                                            @endif
                                            "{{$item->name}}" Book</h4>

                                      </div>

                                      <div class="modal-body" >
                                        <br>
                                        @if(Auth::user()->role==2)
                                        <form action="/item/{{$item->id}}/remove" method="POST">
                                        @else
                                        <form action="/item/{{$item->id}}/BS" method="POST">
                                        @endif

                                        <div class="form-group">
                                          <label class="col-md-4 control-label">Confirm Your Password</label>

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
                                    $("#order").click(function(){
                                        $("#confirm").modal({backdrop: "static"});
                                    });
                                });
                                </script>

                                </div>


                                <div class="span12" style="padding-top: 50px;">
                                    <form action="/item/{{$item->id}}/rate" method="POST" class="form-inline text-center" role="form">
                                          {!! csrf_field() !!}
                                          <div class="form-group">
                                              <input id="input-21e" value="{{$rate}}" type="number" class="rating" min=0 max=5 step=1 data-size="xs" name="rateval" ></input>
                                          </div>
                                          <div class="form-group">
                                              <input type="submit" value="Rate" class="btn btn-primary pull-right"></input>
                                          </div>
                                    </form>
                                </div>
                        </div>
                        @elseif(Auth::user()->role==2||Auth::user()->role==3)
                            <h2 class="text-warning" style=" padding-bottom: 10px; text-align: center">AVAILABLE</h2>
                        @endif





                </div>
                <!----- Reviews-------->
                @if(count($reviews)>0)
                <h4><strong>Reviews</strong></h4>
                @endif

                @foreach($reviews as $e)

                    <div class="well">

                        User:{{$e->user_id}}
                        <br>
                        <p style="color: #6D6D6D">{{$e->value}}</p>

                    </div>
                @endforeach

            </div>
                    

        </div>
    </div>



    <script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled: !$('#rating-input').attr('disabled')
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>


 


@endsection