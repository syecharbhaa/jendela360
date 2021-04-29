@extends('layouts.app')

@section('title', 'Add New Car')

@section('content')
<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                @endif
                <form action="{{route('car-add-act')}}" method="post">
                    @csrf
                    New Car's Data
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Car Name" autofocus>
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="price" type="text" class="form-control" placeholder="Price">
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="stock" type="text" class="form-control" placeholder="Stock">
                    </div>
                    <button class="btn btn-sm btn-primary btn-block" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection