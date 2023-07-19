@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-2">
            <div class="page-title-box">
                <h4 class="page-title">{{$title ?? ''}}</h4>
            </div>
        </div>
         <div class="col-10">
             <form action="" id="form-filter" class="form-inline">
                 <div class="col-2 mt-3">
                     <div class="form-group">

                     </div>
                 </div>
             </form>
         </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@endsection

