@extends('layouts.app')
@section('includes')
 
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

                <div class="panel-heading">{{$user->username}} Profile</div>
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

                    <label class="col-md-5 label1">Customer Items</label>
                    <a href="/{{$user->id}}/profile" style="font-size: 15px; line-height:2.3;" class="col-md-6 " >View All of Them</a>
                    
                    <div class="row">&nbsp;</div>

                </div>
            </div>
        </div>
      </div>
    </div>
 

@endsection

 
