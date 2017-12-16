@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row">
        <table class="table table-hover" style="table-layout: fixed;font-size:14px;"> 
            
<col width="50">
  <col width="200">
            <thead>
            @if(count($suggestions)!=0)
                <tr>
                <td class="lead">Customer ID</td>
                <td class="lead">Suggestion</td>
                </tr>
            @endif
                    <tbody >        
            
                    @foreach($suggestions as $suggestion)
                        <tr>
                            <td onclick="getElementById('{{$suggestion->id}}').click()" style="cursor: pointer;font-size: 14px">
                                {{$suggestion->customer_id}}
                             </td>
                                                
                            <td onclick="getElementById('{{$suggestion->id}}').click()" style="cursor: pointer" href="#{{$suggestion->id}}" class="list-group-item" data-toggle="collapse">
                                         {{str_limit($suggestion->text,30)}}
                                <i class="fa fa-caret-down pull-right"></i>
                                <div id="{{$suggestion->id}}" class="collapse" style="font-size: 14px">
                                    <i class="fa fa-share" aria-hidden="true"></i> {{$suggestion->text}}
                                </div>
                            
                            </td>
                    
                            
                            
                        </tr>

                    @endforeach
                    </tbody>
                </thead>  
            </table>
            @if(count($suggestions)==0)
                <div class="well well-danger">
                            <h3 class="text-center">NOTHING FOUND</h3>
                            <div class="row text-center">&nbsp;</div>
                            <h5 class="text-muted text-center">There are no suggestions for improvement to display.</h5>
                            <div class="row">&nbsp;</div>
                            <div class="row">&nbsp;</div>
                </div>
            @endif
            <div class="text-center">
                    {!! $suggestions->render() !!}    <!--Display Dynamic Pagination at the bottom-->
             </div>
                                       
    </div>
                       
</div>
@endsection