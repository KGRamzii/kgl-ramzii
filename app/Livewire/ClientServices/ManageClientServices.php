<?php

namespace App\Livewire\ClientServices;

use App\Models\Client;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ManageClientServices extends Component
{
    public Client $client;

    public $selectedServiceId;

    #[Rule('required|numeric|min:0')]
    public $customPrice;

    // Always available for the view
    public $availableServices;
    public $clientServices;

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->loadServices();
    }

    public function loadServices()
    {
        $client = Client::with('services')->find($this->client->id);

        $this->availableServices = Service::where('active', true)
            ->whereNotIn('id', $client->services->pluck('id'))
            ->get();

        $this->clientServices = $client->services()->withPivot('custom_price', 'active')->get();
    }

    public function addService()
    {
        $this->validate([
            'selectedServiceId' => 'required|exists:services,id',
            'customPrice' => 'required|numeric|min:0',
        ]);

        $this->client->services()->attach($this->selectedServiceId, [
            'custom_price' => $this->customPrice,
            'active' => true,
        ]);

        $this->reset(['selectedServiceId', 'customPrice']);
        $this->dispatch('notify', ['message' => 'Service added successfully!']);

        $this->loadServices(); // Refresh services after adding
    }

    public function removeService($serviceId)
    {
        $this->client->services()->detach($serviceId);
        $this->dispatch('notify', ['message' => 'Service removed successfully!']);

        $this->loadServices(); // Refresh services after removal
    }

    public function updateCustomPrice($serviceId)
    {
        $this->validate([
            'customPrice' => 'required|numeric|min:0',
        ]);

        $this->client->services()->updateExistingPivot($serviceId, [
            'custom_price' => $this->customPrice,
        ]);

        $this->reset(['customPrice']);
        $this->dispatch('notify', ['message' => 'Price updated successfully!']);

        $this->loadServices(); // Refresh services after update
    }

    public function render()
    {
        return view('livewire.client-services.manage');
    }
}
