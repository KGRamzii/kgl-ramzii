<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    public Client $client;

    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|email')]
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

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->business_name = $client->business_name;
        $this->phone = $client->phone;
        $this->monthly_rate = $client->monthly_rate;
        $this->notes = $client->notes;
        $this->status = $client->status;
        $this->recurring = $client->recurring;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $this->client->id,
            'business_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'monthly_rate' => 'nullable|numeric|min:0|max:999999.99',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'recurring' => 'boolean',
        ]);

        $this->client->update($validated);

        session()->flash('flash.banner', 'Client updated successfully.');
        session()->flash('flash.bannerStyle', 'success');

        return $this->redirect(route('clients.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
