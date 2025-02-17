<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class APICarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::all();
        //return response()->json($cars);

        return response()->json([
            'status'=> true,
            'cars'  => $cars,
            'msg'   => 'Lista de coches correctamente'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = Car::create($request->all());
        return response()->json([
            'status'=> true,
            'msg'   => 'Coche creado correctamente'
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        //return response()->json($cars);
        return response()->json([
            'status'=> true,
            'car'  => $car,
            'msg'   => 'Coche encontrado correctamente'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $car = Car::find($id);
        $car->update($request->all());
        return response()->json([
            'status'=> true,
            'msg'   => 'Coche actualizado correctamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json([
            'status'=> true,
            'msg'   => 'Coche actualizado correctamente'
        ], 200);
    }
}
