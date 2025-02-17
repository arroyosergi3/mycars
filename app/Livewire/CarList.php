<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Attributes\On;
use Livewire\Component;
#[On('insertCoche')]
class CarList extends Component
{

    public $nombre;
    public $buscador = '';
    public $campoOrden = 'id';
    public $direccion = 'desc';
    public function render()
    {
        $cars = Car::where('marca', 'like', '%'. $this->buscador. '%')
        ->orWhere('modelo', 'like', '%'. $this->buscador. '%')->orderBy($this->campoOrden, $this->direccion)->get();
        return view('livewire.car-list')->with('cars', $cars);
    }

    public function ordenar($orden){
        if ($this->campoOrden == $orden) {
            $this->direccion = $this->direccion == 'desc' ? 'asc' : 'desc';
        }else{
            $this->campoOrden = $orden;
            $this->direccion = 'desc';
        }
    }
}
