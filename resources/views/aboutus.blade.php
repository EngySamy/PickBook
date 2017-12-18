@extends('layouts.app')

@section('title')
- About US
@endsection

@section('AboutusisActive')
    class="active"
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">About Us </div>

                    <div class="panel-body" style="padding: 40px; font-size: 18px; ">
                        <ul>
                            <li>
                                PickBook is an online bookstore where you can navigate between different categories of books with
                                different languages and order the book you like.
                            </li>
                            <br>
                            <li>
                                Here you can also make a special order with a book which doesn't exist in the website and we
                                will get it for you.
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection