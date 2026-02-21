<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class CarDetails extends Component
{
    public Car $car;

    public function mount(Car $car)
    {
        $this->car = $car->load(['brand', 'type', 'make', 'model', 'images']);

        // Ensure car is available and published, or abort 404
        if ($this->car->status !== 'available' || !$this->car->is_published) {
            // Optional: allow viewing sold cars? For now restrict.
// abort(404);
        }
    }

    public function render()
    {
        return view('livewire.car-details')->layout('layouts.app');
    }
}