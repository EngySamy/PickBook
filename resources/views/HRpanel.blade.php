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
    <form action="/HRPanel/viewcomplaints">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> View Complaints</button>
    </form>
  
    
  </div>

 <div class="col-md-6 text-center">
    <form action="/HRPanel/viewsuggestions">
        <button class="btn btn-primary btn-xlarge" data-toggle="tooltip" data-placement="left" ><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> View Suggestions</button>
    </form>
  
    
  </div>

  </div>

  </div>
</body>


@endsection
