<?php

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Collection;

class Services extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingService = null;

    #[Rule('required|string|max:255')]
    public $name = '';

    #[Rule('nullable|string')]
    public $description = '';

    #[Rule('required|numeric|min:0')]
    public $default_price = 0;

    public $active = true;

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(Service $service)
    {
        $this->editingService = $service;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->default_price = $service->default_price;
        $this->active = $service->active;
        $this->showModal = true;
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->editingService) {
            $this->editingService->update([
                'name' => $this->name,
                'description' => $this->description,
                'default_price' => $this->default_price,
                'active' => $this->active,
            ]);
        } else {
            Service::create([
                'name' => $this->name,
                'description' => $this->description,
                'default_price' => $this->default_price,
                'active' => $this->active,
            ]);
        }

        $this->reset(['showModal', 'editingService', 'name', 'description', 'default_price', 'active']);
        $this->dispatch('notify', ['message' => 'Service saved successfully!']);
    }

    public function toggleActive(Service $service)
    {
        $service->update(['active' => !$service->active]);
        $this->dispatch('notify', ['message' => 'Service status updated!']);
    }

    private function resetForm()
    {
        $this->reset(['editingService', 'name', 'description', 'default_price', 'active']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.services.index', [
            'services' => Service::orderBy('name')->paginate(10),
        ]);
    }
}
