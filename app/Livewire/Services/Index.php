<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $editingService = null;
    public $name = '';
    public $description = '';
    public $default_price = 0;
    public $active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'default_price' => 'required|numeric|min:0',
        'active' => 'boolean',
    ];

    public function create()
    {
        $this->reset(['editingService', 'name', 'description', 'default_price', 'active']);
        $this->active = true;
    }

    public function editService($id)
    {
        $service = Service::find($id);
        if (!$service) return;

        $this->editingService = $service;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->default_price = $service->default_price;
        $this->active = $service->active;
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->editingService) {
            $this->editingService->update($validated);
        } else {
            Service::create($validated);
        }

        $this->reset(['editingService', 'name', 'description', 'default_price', 'active']);

        session()->flash('flash.banner', 'Service saved successfully.');
        session()->flash('flash.bannerStyle', 'success');
    }

    public function toggleActive($id)
    {
        $service = Service::find($id);
        if (!$service) return;

        $service->update(['active' => !$service->active]);

        session()->flash('flash.banner', 'Service status updated.');
        session()->flash('flash.bannerStyle', 'success');
    }

    public function render()
    {
        return view('livewire.services.index', [
            'services' => Service::orderBy('name')->paginate(10),
        ]);
    }
}
