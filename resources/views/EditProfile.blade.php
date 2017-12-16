@extends('layouts.app')

@section('includes')
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit My Profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/editprofile/submit') }}">
                        {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('First_Name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    
                                    <input type="text" maxlength="20" pattern="^[a-zA-Z]+$" title="A name should contain letters only." class="form-control input-sm" name="First_Name" value="{{ $arr[0] }}" placeholder="John">

                                    @if ($errors->has('First_Name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('First_Name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('Last_Name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input type="text" maxlength="20" pattern="^[a-zA-Z]+$" title="A name should contain letters only." class="form-control input-sm" name="Last_Name" value="{{ $arr[1] }}" placeholder="Smith">

                                    @if ($errors->has('Last_Name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Last_Name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="Email" class="form-control input-sm" name="Email" value="{{ $user->email }}" placeholder="example@example.com">

                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group{{ $errors->has('Phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Phone No.</label>

                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]+$" maxlength="11" title="A phone no. should contain numbers only" class="form-control input-sm" name="Phone" value="{{ $user->phone }}" placeholder="Should be the main phone no.">

                                @if ($errors->has('Phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Home Address</label>

                            <div class="col-md-6">
                                <input type="text" pattern="^[a-zA-Z0-9\s,]+$" title="An address should contain letters, commas, and numbers only." class="form-control input-sm" name="Address" value="{{ $user->address }}" placeholder="100 Example Street, City">

                                @if ($errors->has('Address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="Password" class="form-control input-sm" name="Password" placeholder="Your Password">

                                @if ($errors->has('Password'))
                                    <span class="help-block">
                                        <strong>Wrong password. Try again please.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                            
                        
                        <div class="row">&nbsp;</div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" >
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-check" ></i></i>Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
