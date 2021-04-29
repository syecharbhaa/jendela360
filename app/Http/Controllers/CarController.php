<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function list(){
        $cars = Car::query()
                ->orderBy('created_at', 'DESC')
                ->get();

        return view('cars', compact('cars'));
    }

    public function carAdd(){
        return view('car-add');
    }

    public function carAddAct(Request $r){
        $r->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $car = new Car();
        $car->name = $r->name;
        $car->price = $r->price;
        $car->stock = $r->stock;
        $car->save();

        return redirect()->back()->with('message', 'Data saved successfully');
    }

    public function edit($id){
        $car = Car::findOrFail($id);

        return view('car-edit', compact('car'));
    }

    public function editAct(Request $r, $id){
        $r->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $car = Car::find($id);
        $car->name = $r->name;
        $car->price = $r->price;
        $car->stock = $r->stock;
        $car->save();

        return redirect()->back()->with('message', 'Data updated successfully');
    }

    public function delete($id){
        $car = Car::find($id);
        $car->delete();

        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
