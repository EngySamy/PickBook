@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Remove a user</div>

                    <div class="panel-body" style="padding: 20px;  text-align:center;">

                        <form action="/user/remove" method="POST">
                            {!! csrf_field() !!}

                            <div class="form-group">

                                <div class="form-group{{ $errors->has('Username') ? ' has-error' : '' }}">

                                    <label class="col-md-4 control-label">Customer/Publisher username</label>

                                    <div class="col-md-6">
                                        <input type="text" maxlength="20" pattern="^[a-zA-Z0-9\s_]+$" title="A username name should contain letters, underscores, and numbers only."  class="form-control input-sm" name="Username" value="{{ old('Username') }}" placeholder="My_Book1">

                                        @if ($errors->has('Username'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('Username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Confirm Your Password</label>

                                    <div class="col-md-6">
                                        <input type="Password" class="form-control input-sm" name="Password" placeholder="Minimum is 6 characters" autocomplete="off">

                                        @if ($errors->has('Password'))
                                            <span class="help-block">
                                        <strong>Wrong password. Try again please.</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <br>
                                <br>

                            </div>


                            <div class="form-group" style="padding: 16px">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-times" ></i></i>Remove
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