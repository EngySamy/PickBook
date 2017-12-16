@extends('layouts.app')
@section('includes')
 
<script src="/assets/js/vendor/jquery.min.js"></script>
<style>
    .label1 {
       text-align: right;
    }
    .label2 {
       color: #000000;
    }
    .modal {
        max-height: 2000px;
        }
    .box
    {
        margin: 0 auto; 
        text-align: center; 
        border-color: #dddddd;
        background-color: #f5f5f5; 
        width: 500px;
        
    }

</style>
 
@endsection
@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">My Profile</div>
                <div class="panel-body">
                    <label class="col-md-5 label1">Name</label>
                    <label class="col-md-6 label2">{{$user->name}}</label>
                    <div class="row">&nbsp;</div>

                    <label class="col-md-5 label1">Email</label>
                    <label class="col-md-6 label2">{{$user->email}}</label>
                    <div class="row">&nbsp;</div>

                    <label class="col-md-5 label1">Phone</label>
                    <label class="col-md-6 label2">{{$user->phone}}</label>
                    <div class="row">&nbsp;</div>                                      
    
                    <label class="col-md-5 label1">Address</label>
                    <label class="col-md-6 label2">{{$user->address}}</label>
                    <div class="row">&nbsp;</div>

                    <label class="col-md-5 label1">My Items</label>
                    <a href="/{{$user->id}}/profile/" style="font-size: 15px; line-height:2.3;" class="col-md-6 " >Show All Items</a>
                    
                    <div class="row">&nbsp;</div>

                </div>
            </div>
        </div>
        <div class="col-md-2">
        <a href="{{ url('/editprofile') }}" style="font-size: 14px;" ><i class="fa fa-btn fa-pencil"></i>Edit Profile</a>
        <br>
        <a href="#" style="font-size: 14px;" id="change"><i class="fa fa-btn fa-pencil"></i>Change Password</a>
        </div>

         <!-- Modal -->
        <div class="modal fade" id="confirm" role="dialog">
          <div class="modal-dialog ">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" style="text-align: center">Change Password</h4>
              </div>
                <br>
              <div class="modal-body" style="height: 240px;">
              
                <form action="myprofile/changepassword" method="POST">
                <div class="form-group" >
                  <label class="col-md-4 control-label label1">Old Password</label>

                  <div class="col-md-7">
                      <input type="Password" class="form-control input-sm" name="Old" placeholder="Your Password" autocomplete="off">
                  </div>

                  <label class="col-md-4 control-label label1">New Password</label>

                  <div class="col-md-7">
                      <input type="Password" class="form-control input-sm" name="Password" placeholder="Minimum is 6 characters" autocomplete="off">
                  </div>

                  <label class="col-md-4 control-label label1">Confirm New Password</label>

                  <div class="col-md-7">
                      <input type="Password" class="form-control input-sm" name="Password_confirmation" placeholder="Must match the above password" autocomplete="off">
                  </div>
              <br>
              <br>
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
            $("#change").click(function(){
                $("#confirm").modal({backdrop: "static"});

            });
        });
        </script>
    </div>
</div>
</div>
@if(Session::has('message'))
<div class="alert center box">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="help-block">
            <strong>{{ Session::get('message') }}</strong>
    </span>  
  </div>
<br>
@endif
   
@if ($errors->has('Old'))
<div class="alert center box">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="help-block">
            <strong>Wrong old password. Try again please.</strong>
    </span>  
  </div>
<br>
@endif
  
@if ($errors->has('Password'))
<div class="alert center box" > 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="help-block">
            <strong >{{ $errors->first('Password') }}</strong>
    </span>  
  </div>
@endif

@if ($errors->has('Password_confirmation'))
<div class="alert center box" >  
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="help-block">
            <strong>{{ $errors->first('Password_confirmation') }}</strong>
    </span>  
  </div>

@endif
@endsection

 
