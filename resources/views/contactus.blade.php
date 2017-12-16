@extends('layouts.app')

@section('title')
- Contact US
@endsection

@section('ContactusisActive')
    class="active"
@endsection

@section('content')
<div class="container">
   
    
        

    
    
<form id="contact_form" action="/contactus/submit1" method="post">
    {!! csrf_field() !!}
                                      
     
    <div class="row" style="margin:0 auto;width:75%;text-align:center">
      <body style="text-align: center;">
        <label for="message" class="lead">Your Complaint</label><br />
        <textarea id="complaint" class="input" name="complaint" rows="7" cols="30"></textarea><br />
    </body>

    </div>
    
    <button id="complain_button" type="submit" class="btn btn-primary">Complain</button>
        </form>

    
<form id="contact_form" action="/contactus/submit2" method="post" >
    {!! csrf_field() !!}
                                      
    
    <div class="row" style="margin:0 auto;width:75%;text-align:center" >
    <body style="text-align: center;">
        <label for="message" class="lead">Your Suggestion</label><br />
        <textarea id="suggestion" class="input" name="suggestion" rows="7" cols="30" ></textarea><br />
    </body>
    </div>
    <button id="suggest_button" type="submit" class="btn btn-primary" >Suggest</button>

</form>                     
               
</div>
@endsection