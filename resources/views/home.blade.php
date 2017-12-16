@extends('layouts.app')

@section('HomeisActive')
    class="active"
@endsection

@section('includes')
<script src="/assets/js/vendor/jquery.min.js"></script>

@endsection

@section('content')

<div class="container">


        <div class="row">
            <div class="col-md-3">
                <span class="lead">Categories</span>
                <div class="list-group" style="padding-top: 20px">

                    @foreach($categories as $category)
                    <a href="/home/artschool/{{$category->id}}"
                    class="list-group-item {{ Request::is('home/artschool/'.$category->id) ? 'active' : '' }}"style="height: 40px;">{{$category->name}}</a>

                    @endforeach
                    @if(count($categories)==0)
                        <p>There are no categories available.</p>
                    @endif
                </div>
                <span class="lead">Language</span>
                <div class="list-group" style="padding-top: 20px">
                    @foreach($languages as $language)
                    <a href="/home/color/{{$language->id}}" class="list-group-item {{ Request::is('home/color/'.$language->id) ? 'active' : '' }}" style="height: 40px;">{{$language->name}}</a>
                    @endforeach
                    @if(count($languages)==0)
                        <p>There are no colors available.</p>
                    @endif
                </div>
                <div class="row">&nbsp;</div>
            </div>

            <div class="col-md-9">
                <div class="row">
                <div class="col-md-12">
                    <span class="lead">Featured</span>
                    @if(Auth::check() && (Auth::user()->role!=2&&Auth::user()->role!=3))
                    <div class="btn-group pull-right">
                        <a href="/home/0/index" class="btn btn-primary btn1">Sell</a>
                        <a href="home/1/index" class="btn btn-primary btn2" >Special Order</a>

                      </div>
                       <script>
                        $(document).ready(function(){
                            $('.btn1').tooltip({title: "Offer Item for Sale", animation: true,delay: 400,placement: "bottom"});
                        });
                        </script>
                      <script>
                        $(document).ready(function(){
                            $('.btn2').tooltip({title: "Order Item with Special Requirements", animation: true,delay: 400,placement: "bottom"});
                        });
                        </script>
                    @endif
                    </div>
                </div>
                @if(!is_null($items))
                <div class="row" style="padding-top: 20px">
                    @foreach($items as $item)
                    <a href="/{{$item->id}}/item">
                    <div class="col-sm-4 col-lg-4 co l-md-4">
                        <div class="thumbnail">
                            @foreach($item->images as $index=>$image)
                                @if($index==0)
                                     <img class="img-responsive center-block slide-image" src="{{url($image->link)}}" style="width:auto; height:141px" alt=""/>
                                @endif
                            @endforeach
                            <div class="caption">
                                <h4 class="pull-right">{{$item->price}} LE</h4>
                                <h4><a href="/{{$item->id}}/item">{{$item->name}}</a></h4>
                                @if($item->artSchool!=null)
                                     <p>Category: {{$item->artSchool->name}}</p>
                                @else
                                     <p>Category: None</p>
                                @endif
                                @if($item->colorType!=null)
                                     <p>Colors: {{$item->colorType->name}}</p>
                                @else
                                     <p>Colors: None</p>
                                @endif
                                <a href="/{{$item->id}}/item"><p class="pull-right">{{ ($item->sold==false)?'Available':'Sold out' }}</p></a>
                                @for($i=0;$i<$item->AverageRating()&&$i<5;$i++)
                                    <span class="glyphicon glyphicon-star gold"></span>
                                @endfor
                                @for($i=0;$i<5-$item->AverageRating();$i++)
                                    <span class="glyphicon glyphicon-star-empty gold"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
             <div class="text-center">
                    {!! $items->render() !!}    <!--Display Dynamic Pagination at the bottom-->
             </div>
             <div class="row">&nbsp;</div>
              @endif
              @if($items->count()==0)
                        <div class="well well-danger">
                            <h3 class="text-center">NOTHING FOUND</h3>
                            <div class="row text-center">&nbsp;</div>
                            <h5 class="text-muted text-center">There are no items to display.</h5>
                            <div class="row">&nbsp;</div>
                            <div class="row">&nbsp;</div>
                        </div>
              @endif
        </div>

    </div>
</div>
    <style>
        .tooltip {
            background-color: white;
            font-size:12px;
            font-family: Arial;
            color:#fff;
        }
</style>

@endsection
