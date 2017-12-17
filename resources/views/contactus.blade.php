@extends('layouts.app')

@section('title')
- Contact US
@endsection

@section('ContactusisActive')
    class="active"
@endsection

@section('content')
<div class="container">

<table style="width:100%">
    <tr>
        <th style = "text-align:center">
            <form id="contact_form" action="/contactus/submit1" method="post">
                {!! csrf_field() !!}

                <div class="row" style="margin:0 auto;width:75%;text-align:center">
                    <body style="text-align: center;">
                    <label for="message" class="lead">Your Complaint</label><br />
                    <textarea id="complaint" class="input" name="complaint" rows="14" cols="30"></textarea><br />
                    </body>

                </div>

                <button id="complain_button" type="submit" class="btn btn-primary">Complain</button>
            </form>
        </th>

        <th style = "text-align:center">
            <form id="contact_form" action="/contactus/submit2" method="post" >
                {!! csrf_field() !!}


                <div class="row" style="margin:0 auto;width:75%;text-align:center" >
                    <body style="text-align: center;">
                    <label for="message" class="lead">Your Suggestion</label><br />
                    <textarea id="suggestion" class="input" name="suggestion" rows="14" cols="30" ></textarea><br />
                    </body>
                </div>
                <button id="suggest_button" type="submit" class="btn btn-primary" >Suggest</button>

            </form>
        </th>
    </tr>
</table>
    
    


    

               
</div>
@endsection