<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $mycars = $user->cars()->orderBy('matricula')->get();
        return view('cars.index')->with('mycars', $mycars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required | unique:cars,matricula, NULL, id, deleted_at,NULL',
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'year' => 'required | integer',
            'fecha' => 'required | date',
            'precio' => 'required | numeric',
            'foto' => 'required | image'

        ]);

        try {
            $car = new Car();
            $car->matricula = $request->matricula;
            $car->marca = $request->marca;
            $car->modelo = $request->modelo;
            $car->color = $request->color;
            $car->year = $request->year;
            $car->fecha_ultima_revision = $request->fecha;
            $car->precio = $request->precio;
            $car->user_id = Auth::id();



            $nombre_foto = time() . '-' . $request->file('foto')->getClientOriginalName();
            //$request->file('foto')->move(public_path('fotos'), $nombre_foto);
            $car->foto = $nombre_foto;


            $car->save();
            $request->file('foto')->storeAs('img_cars', $nombre_foto);

            return to_route('car.index')->with('msg', 'Coche añadido correctamente');
            //return redirect()->route('car.index');
        } catch (QueryException $qe) {
            return to_route('car.index')->with('msg', 'Error al añadir el coche');

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        // Si pasamos ahí arrriba ↑ el id en lugar del coche, tenemos que hacer $car=Car::find($id);

        $url = 'storage/img_cars/';
        return view('cars.show')->with('mycar', $car)->with('url', $url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //

        $url = 'storage/img_cars/';
        return view('cars.edit')->with('mycar', $car)->with('url', $url);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
        $request->validate([
            'matricula' => 'required | unique:cars,matricula,' . $car->id . ',id,deleted_at,NULL',
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
            'year' => 'required | integer',
            'fecha' => 'required | date',
            'precio' => 'required | numeric',
            'foto' => 'image'

        ]);


        try {
            $car->matricula = $request->matricula;
            $car->marca = $request->marca;
            $car->modelo = $request->modelo;
            $car->color = $request->color;
            $car->year = $request->year;
            $car->fecha_ultima_revision = $request->fecha;
            $car->precio = $request->precio;
            if (is_uploaded_file($request->file('foto'))) {
                Storage::delete('img_cars/' . $car->foto);
                $nombre_foto = time() . '-' . $request->file('foto')->getClientOriginalName();
                $car->foto = $nombre_foto;
            }
            //$car->update($request->all());
            $car->save();
            //$request->file('foto')->storeAs('img_cars', $nombre_foto);

            return to_route('car.index')->with('msg', 'Coche editado correctamente');
            //return redirect()->route('car.index');
        } catch (QueryException $qe) {
            return to_route('car.index')->with('msg', 'Error al editar el coche');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();
        return to_route('car.index')->with('msg', 'Coche borrado correctamente');
    }
}
