@extends('layouts.app')       
                            
@section('search')           

  <form id="tfnewsearch" method="get" action="search">
                        <div class="col-sm-3 col-sm-offset-3">
                            <div id="imaginary_container"> 
                               <div class="input-group stylish-input-group">
                                    <input type="text" id="tfq" class="form-control"  name="keyword" size="18" maxlength="120" placeholder="Search" >
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>  
                                    </span>
                                </div>
                           </div>
                        </div>
                </form>       

@endsection