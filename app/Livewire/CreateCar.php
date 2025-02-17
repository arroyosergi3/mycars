<?php

namespace App\Livewire;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
class CreateCar extends Component
{
    use WithFileUploads;
    public $mostrar = false;
    #[Validate(['required|unique:cars,matricula, NULL, id, deleted_at,NULL'])]
    public $matricula;
    #[Validate(['required'])]
    public $marca;
    #[Validate(['required'])]
    public $modelo;
    #[Validate(['required|integer'])]
    public $year;
    #[Validate(['required'])]
    public $color;
    #[Validate(['required|date'])]
    public $fecha_ultima_revision;
    #[Validate(['required|image'])]
    public $foto;
    #[Validate(['required|integer'])]
    public $precio;

    public function render()
    {
        return view('livewire.create-car');
    }

    public function mostrarForm(){
        if ($this->mostrar == true) {
           $this->mostrar = false;
        }else{
            $this->mostrar = true;
        }
    }

    public function guardar(){
        $nombreFoto = time() . '-' . $this->foto->getClientOriginalName();
        $this->foto->storeAs('img_cars', $nombreFoto);
         Car::create([
                'matricula' => $this->matricula,
                'user_id' => Auth::id(),
                'marca' => $this->marca,
                'modelo' => $this->modelo,
                'year' => $this->year,
                'color' => $this->color,
                'fecha_ultima_revision' => $this->fecha_ultima_revision,
                'precio' => $this->precio,
                'foto' => $nombreFoto,
                ]);
                $this->mostrar = false;
                $this->dispatch('insertCoche');

}
}
