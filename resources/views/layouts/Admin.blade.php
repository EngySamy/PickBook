@extends('layouts.app')

@section('includes')
 <script src="/assets/js/vendor/jquery.min.js"></script>
<style>
.body1 {
   
    text-align: center;
    }
    li.buy
    {
        list-style-type: none;
        padding: 3px;
        padding-left: 35px;
    }
.list-group-item:hover,
.list-group-item:focus {
  background-color: #f5f5f5;
}
</style>



@endsection

@section('content')
<body>
<div class="container">    
    <div class="row">
      <div class="col-md-3">
        <p class="lead">Go to</p>
            <div class="list-group">
                <a href="/0/show/SS" class="list-group-item {{ Request::is('0/show/SS') ? 'active' : '' }}" style="height: 40px;">Publisher Requests</a>
                <a href="/show/BS" class="list-group-item {{ Request::is('show/BS') ? 'active' : '' }}" style="height: 40px;">Buy Requests</a>
                <a href="/1/show/SS" class="list-group-item {{ Request::is('1/show/SS') ? 'active' : '' }}" style="height: 40px;">New Special Orders</a>
     
            </div>

          <p class="lead">Other</p>
          <div class="list-group">
              <a href="/Admin/AddPublisher" class="list-group-item {{ Request::is('Admin/AddPublisher') ? 'active' : '' }}" style="height: 40px;">Add Publisher</a>
              <a href="/home/toremovebook" class="list-group-item {{ Request::is('home/toremovebook') ? 'active' : '' }}" style="height: 40px;">Remove Book</a>
              <a href="/toremoveuser" class="list-group-item {{ Request::is('toremoveuser') ? 'active' : '' }}" style="height: 40px;">Remove User</a>

          </div>

      </div>

      @yield('addrequests')

    </div>
  </div>

</body>


@endsection
