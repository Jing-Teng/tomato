@extends('layouts.app')
 
@section('content')
    <div class="container">
 
        <div class="panel panel-primary">
 
         <div class="panel-heading"></div>
 
          <div class="panel-body">    
            <div class="row">
            <div class="col-md-6"> 
               {!! $chart->html() !!}
            </div>
         </div>
 
        </div>
 
    </div>
 
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}

@endsection