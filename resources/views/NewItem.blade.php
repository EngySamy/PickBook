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
                <div class="panel-heading">Publish a book</div>
            @elseif($id==1)
                <div class="panel-heading">Order special book</div>
            @endif
                <div class="panel-body">
                        
                @if($id==0)
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('home/0/Submit') }}" autocomplete="nope" enctype="multipart/form-data">
                @else
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('home/1/Submit') }}" autocomplete="nope" enctype="multipart/form-data">
                @endif
                        {!! csrf_field() !!}
                        
                            <div class="form-group{{ $errors->has('Item_Name') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Book Name</label>

                                <div class="col-md-6">
                                    <input type="text" maxlength="50" pattern="^[a-zA-Z0-9\s_]+$" title="An item name should contain letters, underscores, and numbers only."  class="form-control input-sm" name="Item_Name" value="{{ old('Item_Name') }}" placeholder="My_Book1">

                                    @if ($errors->has('Item_Name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Item_Name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Author_Name') ? ' has-error' : '' }}">

                                <label class="col-md-4 control-label">Author Name</label>

                                <div class="col-md-6">
                                    <input type="text" maxlength="20" pattern="^[a-zA-Z]+$" title="Author name should contain letters only."  class="form-control input-sm" name="Author_Name" value="{{ old('Author_Name') }}" placeholder="John">

                                    @if ($errors->has('Author_Name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('Author_Name') }}</strong>
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


                            <div class="form-group{{ $errors->has('Categories') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                              <select class="form-control input-sm" name="Categories">
                              @foreach($categories as $category)
                                <option value= "<?php echo htmlspecialchars($category->id); ?>">{{$category->name}}</option>
                              @endforeach
                              @if(count($categories)==0)
                                <option>There are no categories available.</option>
                              @endif
                              </select>

                              @if ($errors->has('Categories'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Categories') }}</strong>
                                        </span>
                              @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Languages') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Language</label>

                            <div class="col-md-6">
                              <select class="form-control input-sm" name="Languages">
                              @foreach($languages as $language)
                                <option value= "<?php echo htmlspecialchars($language->id); ?>" >{{$language->name}}</option>
                              @endforeach
                              @if(count($languages)==0)
                                <option>There are no languages available.</option>
                              @endif
                              </select>

                              @if ($errors->has('Languages'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Languages') }}</strong>
                                        </span>
                              @endif

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('File') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Upload photo(s) -Up to 2 photos-</label>

                            <div class="col-md-6">
                                <input type="file" accept="image/*" class="form-control input-sm" name="images[]" multiple>
                                @if ($errors->has('File1'))
                                    <span class="help-block">
                                        <strong class="text-danger">Could not upload your images.</strong>
                                    </span>
                                @elseif ($errors->has('File2'))
                                    <span class="help-block">
                                        <strong class="text-danger">Maximum number of images allowed is 2</strong>
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
