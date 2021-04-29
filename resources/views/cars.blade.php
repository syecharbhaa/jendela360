@extends('layouts.app')

@section('title', 'Car List')

@section('content')
<div class="table-bordered">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <table class="table text-center">
        <thead>
            <tr>
                <th colspan="4"><a href="{{route('car-add')}}" class="btn btn-sm btn-success">Add New Car</a></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 25%;">Name</th>
                <th style="width: 25%;">Price</th>
                <th style="width: 25%;">Stock</th>
                <th style="width: 25%;">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $key => $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>Rp. {{number_format($data->price)}}</td>
                <td>{{$data->stock}}</td>
                <td><a href="{{route('car-edit', ['id' => $data->id])}}" class="btn btn-sm btn-primary">Edit</a> <a href="{{route('car-delete', ['id' => $data->id])}}" class="btn btn-sm btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection