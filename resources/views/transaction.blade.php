@extends('layouts.app')

@section('title', 'Car List')

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
                <form action="{{route('transaction-act')}}" method="post">
                    @csrf
                    New Transaction
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="buyer_name" type="text" class="form-control" placeholder="Buyer Name" autofocus>
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="buyer_email" type="text" class="form-control" placeholder="Buyer Email">
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="buyer_phone" type="text" class="form-control" placeholder="Buyer Phone">
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        
                        <select list="cars" name="car_id" id="cars" class="form-control">
                            @foreach($cars as $car)
                            <option value="{{$car->id}}">{{$car->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-bottom:10px" class="form-label-group">
                        <input name="qty" type="text" class="form-control" placeholder="Qty">
                    </div>
                    <button class="btn btn-sm btn-primary btn-block" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection