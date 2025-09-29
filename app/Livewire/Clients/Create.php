<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Create extends Component
{
    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|email|unique:clients,email')]
    public string $email = '';

    #[Rule('nullable|string|max:255')]
    public ?string $business_name = '';

    #[Rule('nullable|string|max:255')]
    public ?string $phone = '';

    #[Rule('nullable|numeric|min:0|max:999999.99')]
    public ?float $monthly_rate = null;

    #[Rule('nullable|string')]
    public ?string $notes = '';

    #[Rule('required|in:active,inactive')]
    public string $status = 'active';

    #[Rule('boolean')]
    public bool $recurring = false;

    public function save()
    {
        $validated = $this->validate();

        Client::create($validated);

        session()->flash('flash.banner', 'Client created successfully.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirect(route('clients.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.clients.create');
    }
}
