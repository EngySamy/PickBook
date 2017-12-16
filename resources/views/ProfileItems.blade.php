@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{$user->username}} Items </div>

                <div class="panel-body">
                    <div class="row">

                    @foreach($items as $item)
                    <a href="/item/{{$item->id}}">
                    <div class="col-sm-4 col-lg-4 co l-md-4">
                         <div class="thumbnail">
                           @foreach($item->images as $index=>$image)
                                @if($index==0)
                                     <img class="img-responsive center-block slide-image" src="{{url($image->link)}}" style="width:auto; height:141px" alt=""/>
                                @endif 
                            @endforeach 
                               <div class="caption">
                                <h4 class="pull-right">{{$item->price}} LE</h4>
                                <h4><a href="/item/{{$item->id}}">{{$item->name}}</a></h4>
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
                                <a href="/item/{{$item->id}}"><p class="pull-right">{{ ($item->sold==false)?'Available':'Sold out' }}</p></a>
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
                    @if(count($items)==0)
                        <div class="text-center">
                            <h5>There are no items to display.</h5>
                            </div>
                    @endif           
                </div>
                 <!--Display Dynamic Pagination at the bottom-->
                   <div class="text-center">
                        {!! $items->render() !!}   
                    </div> 
                </div>

            </div>
        </div>
    </div>

</div>


@endsection