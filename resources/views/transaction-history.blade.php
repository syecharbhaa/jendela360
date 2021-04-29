@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
<div class="table-bordered">
    <table class="table text-center">
        <thead>
            <tr>
                <th style="width: 50%;">DATA HARI INI</th>
                <th style="width: 50%;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mobil yang paling banyak dijual</td>
                <td>{{$most}}</td>
            </tr>
            <tr>
                <td>Penjualan hari ini</td>
                <td>{{$unit}} ({{$unit_perc}}%)</td>
            </tr>
            <tr>
                <td>Total penjualan hari ini</td>
                <td>Rp. {{number_format($total)}} ({{$total_perc}}%)</td>
            </tr>
        </tbody>
    </table>
    <table class="table text-center">
        <thead>
            <tr>
                <th style="width: 50%;">DATA 7 HARI TERAKHIR</th>
                <th style="width: 50%;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mobil yang paling banyak dijual</td>
                <td>{{$most_week}}</td>
            </tr>
            <tr>
                <td>Penjualan 7 hari terakhir</td>
                <td>{{$unit_week}}</td>
            </tr>
            <tr>
                <td>Total penjualan 7 hari terakhir</td>
                <td>Rp. {{number_format($total_week)}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table text-center">
        <thead>
            <tr>
                <th style="width: 20%;">Transaction Time</th>
                <th style="width: 20%;">Buyer Name</th>
                <th style="width: 20%;">Car Name</th>
                <th style="width: 20%;">Qty</th>
                <th style="width: 20%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trs as $key => $data)
            <tr>
                <td>{{date('Y-m-d', strtotime($data->created_at))}}</td>
                <td>{{$data->buyer_name}}</td>
                <td>{{$data->car->name}}</td>
                <td>{{$data->qty}}</td>
                <td>Rp. {{number_format($data->total)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection