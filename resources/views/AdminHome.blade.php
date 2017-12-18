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
        <button class="btn btn-primary btn-xlarge"  ><i class="fa fa-book fa-btn"></i>Publisher Requests</button>
    </form>
  
    <form action="/show/BS">
        <button class="btn btn-primary btn-xlarge"  ><i class="fa fa-shopping-basket fa-btn"></i>Buy Requests</button>
    </form>

    <form action="/1/show/SS">
        <button class="btn btn-primary btn-xlarge"  ><i class="fa fa-cart-plus fa-btn"></i>Special Orders</button>
    </form>
  </div>

  <div class="col-md-6 text-center">

         <form action="/Admin/AddPublisher">
             <button class="btn btn-primary btn-xlarge" ><i class="fa fa-plus-circle fa-btn"></i>Add Publisher</button>
         </form>


         <form action="/home/toremovebook">
             <button class="btn btn-primary btn-xlarge"  ><i class="fa fa-trash fa-btn"></i>Remove Book</button>
         </form>

      <form action="/toremoveuser">
        <button id="order" class="btn btn-primary btn-xlarge"  ><i class="fa fa-times fa-btn"></i>Remove Customer</button>
      </form>


  </div>

  </div>

  </div>


</body>


@endsection
