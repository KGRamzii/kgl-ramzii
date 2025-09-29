<?php

namespace App\Livewire\InvoiceItems;

use Livewire\Component;
use App\Models\InvoiceItem;

class ManageInvoiceItems extends Component
{
    public $invoice_id;
    public $items;
    public $selectedService = '';
    public $description = '';
    public $quantity = 1;
    public $unitPrice = 0;

    protected $rules = [
        'selectedService' => 'required|exists:services,id',
        'description' => 'nullable|string|max:255',
        'quantity' => 'required|integer|min:1',
        'unitPrice' => 'required|numeric|min:0',
    ];

    public function mount($invoice_id = null)
    {
        $this->invoice_id = $invoice_id;
        $this->loadItems();
    }

    public function loadItems()
    {
        $this->items = InvoiceItem::with('service')
            ->where('invoice_id', $this->invoice_id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function updatedSelectedService($value)
    {
        if ($value) {
            $service = $this->getClientServices()->firstWhere('id', $value);
            if ($service) {
                $this->unitPrice = $service->pivot->custom_price ?? $service->default_price;
            }
        }
    }

    public function save()
    {
        $this->validate();

        $service = $this->getClientServices()->firstWhere('id', $this->selectedService);

        InvoiceItem::create([
            'invoice_id' => $this->invoice_id,
            'service_id' => $this->selectedService,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'line_total' => $this->quantity * $this->unitPrice,
        ]);

        $this->reset(['selectedService', 'description', 'quantity', 'unitPrice']);
        $this->loadItems();
    }

    public function delete($id)
    {
        InvoiceItem::findOrFail($id)->delete();
        $this->loadItems();
    }

    public function getClientServices()
    {
        return $this->invoice->client->services()
            ->withPivot('custom_price')
            ->where('active', true)
            ->get();
    }

    public function getInvoiceProperty()
    {
        return \App\Models\Invoice::with('client.services')->findOrFail($this->invoice_id);
    }

    public function getAvailableServicesProperty()
    {
        return $this->getClientServices();
    }

    public function getTotalProperty()
    {
        return $this->items->sum('line_total');
    }

    public function render()
    {
        return view('livewire.invoice-items.manage-invoice-items');
    }
}
