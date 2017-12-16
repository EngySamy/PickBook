@extends('layouts.app')


@section('includes')
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            @if($id==0)
                <div class="panel-heading">Offer Item for Sale</div>
            @elseif($id==1)
                <div class="panel-heading">Special Order</div>
            @endif
                <div class="panel-body">
                        
                @if($id==0)
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('home/0/Submit') }}" autocomplete="nope" enctype="multipart/form-data">
                @else
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('home/1/Submit') }}" autocomplete="nope" enctype="multipart/form-data">
                @endif
                        {!! csrf_field() !!}
                        
                            <div class="form-group{{ $errors->has('Item_Name') ? ' has-error' : '' }}">
                            @if($id==0)
                                <label class="col-md-4 control-label">Item Name</label>
                            @else
                                <label class="col-md-4 control-label">Order Name</label>
                            @endif

                                <div class="col-md-6">
                                    <input type="text" maxlength="20" pattern="^[a-zA-Z0-9\s_]+$" title="An item name should contain letters, underscores, and numbers only."  class="form-control input-sm" name="Item_Name" value="{{ old('Item_Name') }}" placeholder="My_Item1">

                                    @if ($errors->has('Item_Name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Item_Name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('Height') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Height in cm </label>

                                <div class="col-md-3">
                                    <input type="text" pattern="^[0-9]{1,5}(\.[0-9]{1,2})?$"  maxlength="8" title="A height should contain a number only (with maximum value 99999.99)" class="form-control input-sm" name="Height" value="{{ old('Height') }}" placeholder="00000.00">

                                    @if ($errors->has('Height'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Height') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            </div>



                            <div class="form-group{{ $errors->has('Length') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Length in cm </label>

                                <div class="col-md-3">
                                    <input type="text" pattern="^[0-9]{1,5}(\.[0-9]{1,2})?$"  maxlength="8" title="A length should contain a number only (with maximum value 99999.99)" class="form-control input-sm" name="Length" value="{{ old('Length') }}" placeholder="00000.00">


                                    @if ($errors->has('Length'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Length') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            </div>

                            <div class="form-group{{ $errors->has('Width') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Width in cm </label>

                                <div class="col-md-3">
                                    <input type="text" pattern="^[0-9]{1,5}(\.[0-9]{1,2})?$"  maxlength="8" title="A width should contain a number only (with maximum value 99999.99)" class="form-control input-sm" name="Width" value="{{ old('Width') }}" placeholder="00000.00">

                                    @if ($errors->has('Width'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Width') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            </div>

                            <div class="form-group{{ $errors->has('Price') ? ' has-error' : '' }}">
                            @if($id==0)
                                <label class="col-md-4 control-label">Price in L.E </label>
                            @else
                                <label class="col-md-4 control-label">Wished Price in L.E </label>
                            @endif
                                <div class="col-md-3">
                                    <input type="text" pattern="^[0-9]{1,5}$"  maxlength="8" title="A price should contain an integer number only (with maximum value 99999)" class="form-control input-sm" name="Price" value="{{ old('Price') }}" placeholder="00000" autocomplete="off">

                                    @if ($errors->has('Price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Price') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            </div>


                            <div class="form-group{{ $errors->has('ArtSchools') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Art School</label>

                            <div class="col-md-6">
                              <select class="form-control input-sm" name="ArtSchools">
                              @foreach($artschools as $artschool)
                                <option value= "<?php echo htmlspecialchars($artschool->id); ?>">{{$artschool->name}}</option>
                              @endforeach
                              @if(count($artschools)==0)
                                <option>There are no categories available.</option>
                              @endif
                              </select>

                              @if ($errors->has('ArtSchools'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ArtSchools') }}</strong>
                                        </span>
                              @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Colors') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Color Type</label>

                            <div class="col-md-6">
                              <select class="form-control input-sm" name="Colors">
                              @foreach($colors as $color)
                                <option value= "<?php echo htmlspecialchars($color->id); ?>" >{{$color->name}}</option>
                              @endforeach
                              @if(count($colors)==0)
                                <option>There are no colors available.</option>
                              @endif
                              </select>

                              @if ($errors->has('Colors'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Colors') }}</strong>
                                        </span>
                              @endif

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('File') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Upload photo(s) -Up to 5 photos-</label>

                            <div class="col-md-6">
                                <input type="file" accept="image/*" class="form-control input-sm" name="images[]" multiple>
                                @if ($errors->has('File1'))
                                    <span class="help-block">
                                        <strong class="text-danger">Could not upload your images.</strong>
                                    </span>
                                @elseif ($errors->has('File2'))
                                    <span class="help-block">
                                        <strong class="text-danger">Maximum number of images allowed is 5</strong>
                                    </span>
                                @elseif ($errors->has('File3'))
                                    <span class="help-block">
                                        <strong class="text-danger">Maximum image size is 4 MB</strong>
                                    </span>
                                @elseif ($errors->has('File4'))
                                    <span class="help-block">
                                        <strong class="text-danger">Unsupported File Extension.</strong>
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
                            
                        <div class="row">
                            <label class="col-md-4 control-label">CAPTCHA Code</label>
                            <div class="col-md-6">
                                {!! captcha_image_html('LoginCaptcha') !!}
                            </div>
                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-sm" id="CaptchaCode" name="CaptchaCode" placeholder="What is the above CAPTCHA?">

                                 @if ($errors->has('CaptchaCode'))
                                    <span class="help-block">
                                        <strong>Wrong code. Try again please.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-check" ></i></i>Submit
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
