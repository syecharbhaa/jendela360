<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Car;
use DB;
use App\Mail\MailtrapInvoice;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function new(){
        $cars = Car::all();

        return view('transaction', compact('cars'));
    }

    public function newAct(Request $r){
        $r->validate([
            'buyer_name' => 'required',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required|numeric|min:10',
            'car_id' => 'required',
            'qty' => 'required|numeric'
        ]);

        $car = Car::find($r->car_id);
        $car_price = $car->price;

        $trs = new Transaction();
        $trs->buyer_name = $r->buyer_name;
        $trs->buyer_email = $r->buyer_email;
        $trs->buyer_phone = $r->buyer_phone;
        $trs->car_id = $r->car_id;
        $trs->qty = $r->qty;
        $trs->total = intval($r->qty) * intval($car_price);
        $trs->save();

        Mail::to($r->buyer_email)->send(new MailtrapInvoice());

        return redirect()->back()->with('message', 'New transaction has been made');
    }

    public function history(){
        $most = "-";
        $most_week = "-";
        $unit = "-";
        $y_unit = 1;
        $unit_week = "-";
        $total = "-";
        $y_total = 1;
        $total_week = "-";
        $trs = Transaction::query()
                ->orderBy('created_at', 'DESC')
                ->get();

        $day = DB::select(
            "SELECT distinct max(car.name) as car_name,
            max(transaction.car_id) as car_id,
            SUM(transaction.qty) as total_car
            FROM transaction
            LEFT JOIN car
            ON transaction.car_id = car.id
            WHERE DATE(transaction.created_at) = CURDATE()
            GROUP BY transaction.car_id
            ORDER BY total_car DESC"
        );

        if(count($day) > 0){
            $most = $day[0]->car_name;
        }

        $qty_day = DB::select("SELECT SUM(qty) as qty FROM transaction WHERE DATE(created_at) = CURDATE()");

        if(count($qty_day) > 0){
            $unit = $qty_day[0]->qty;
        }

        $qty_yday = DB::select("SELECT SUM(qty) as qty FROM transaction WHERE DATE(created_at) = CURDATE() - 1");
        
        if(count($qty_yday) > 0){
            if($qty_yday[0]->qty != null){
                $y_unit = $qty_yday[0]->qty;
            }
        }

        $total_day = DB::select("SELECT SUM(total) as total FROM transaction WHERE DATE(created_at) = CURDATE()");

        if(count($total_day) > 0){
            $total = $total_day[0]->total;
        }

        $total_yday = DB::select("SELECT SUM(total) as total FROM transaction WHERE DATE(created_at) = CURDATE() - 1");
        
        if(count($total_yday) > 0){
            if($total_yday[0]->total != null){
                $y_total = $total_yday[0]->total;
            }
        }
        
        $unit_def = intval($unit) - intval($y_unit);
        $unit_perc = number_format($unit_def / intval($y_unit), 2);

        $total_def = intval($total) - intval($y_total);
        $total_perc = number_format($total_def / intval($y_total), 2);

        $week = DB::select(
            "SELECT distinct max(car.name) as car_name,
            max(transaction.car_id) as car_id,
            sum(transaction.qty) as total_car
            FROM transaction
            LEFT JOIN car
            ON transaction.car_id = car.id
            WHERE DATE(transaction.created_at) > DATE_SUB(NOW(), INTERVAL 1 WEEK)
            GROUP BY transaction.car_id
            ORDER BY total_car DESC"
        );

        if(count($week) > 0){
            $most_week = $week[0]->car_name;
        }

        $qty_week = DB::select("SELECT SUM(qty) as qty FROM transaction WHERE DATE(created_at) > DATE_SUB(NOW(), INTERVAL 1 WEEK)");

        if(count($qty_week) > 0){
            $unit_week = $qty_week[0]->qty;
        }

        $total_week = DB::select("SELECT SUM(total) as total FROM transaction WHERE DATE(created_at) > DATE_SUB(NOW(), INTERVAL 1 WEEK)");

        if(count($total_week) > 0){
            $total_week = $total_week[0]->total;
        }
        
        return view('transaction-history', compact('trs', 'most', 'unit', 'total', 'unit_perc', 'total_perc', 'most_week', 'unit_week', 'total_week'));
    }
}
