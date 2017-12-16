@extends('layouts.app')

@section('includes')
<style>
.btn-xlarge {
    padding: 15px 25px;
    font-size: 20px;
    line-height: normal;
    -webkit-border-radius: 8px;
       -moz-border-radius: 8px;
            border-radius: 8px;
            margin: 20px;
    }
}
  
</style>

@endsection

@section('content')
<body>
<div class="jumbotron text-center">
  <h2>Where to?</h2>  
</div>
  <div class="container">
  <div class="row">
  <div class="col-md-6 text-center ">
    <form action="/0/show/SS">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-money fa-btn"></i>Sell Requests</button>
    </form>
  
    <form action="/2/show/BS">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-shopping-basket fa-btn"></i>Buy Requests</button>
    </form>
  </div>

 <div class="col-md-6 text-center">
    <form action="/1/show/SS">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-cart-plus fa-btn"></i>New Special Orders</button>
    </form>
  
    <form action="/3/show/BS">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-cart-plus fa-btn"></i>Similar Special Orders</button>
    </form>
  </div>

  </div>

  </div>
</body>


@endsection
