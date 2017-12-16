@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row" style="overflow-x:auto;">
    
        <table class="table table-hover" style="table-layout: fixed;font-size:14px;" > 
            <col width="50">
            <col width="200">
            <thead>
            @if(count($complaints)!=0)          
                <tr>
                <td class="lead" >Customer ID</td>
                <td class="lead" >Complaint</td>
                </tr>
            @endif
                    <tbody >        
            
                    @foreach($complaints as $complaint)
                        <tr>
                            <td onclick="getElementById('{{$complaint->id}}').click()" style="cursor: pointer;font-size: 14px;">
                                {{$complaint->customer_id}}
                             </td>
                        
                        
                            <td onclick="getElementById('{{$complaint->id}}').click()" href="#{{$complaint->id}}" class="list-group-item" data-toggle="collapse" style="cursor: pointer;font-size: 14px;">
                                         {{str_limit($complaint->customer_text,30)}}
                                <i class="fa fa-caret-down pull-right"></i>
                                <div id="{{$complaint->id}}" class="collapse">
                                   <i class="fa fa-share" aria-hidden="true"></i> {{$complaint->customer_text}}
                                </div>
                            
                            </td>   
                            
                        </tr>

                    @endforeach
                    </tbody>
                </thead>  
            </table>
            @if(count($complaints)==0)
                <div class="well well-danger">
                            <h3 class="text-center">NOTHING FOUND</h3>
                            <div class="row text-center">&nbsp;</div>
                            <h5 class="text-muted text-center">There are no complaints to display.</h5>
                            <div class="row">&nbsp;</div>
                            <div class="row">&nbsp;</div>
                </div>
            @endif
            <div class="text-center">
                    {!! $complaints->render() !!}    <!--Display Dynamic Pagination at the bottom-->
             </div>

    </div>
                       
</div>
@endsection