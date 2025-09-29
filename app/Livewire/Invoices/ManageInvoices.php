<?php

namespace App\Livewire\Invoices;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Client;
use App\Mail\InvoiceSentMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ManageInvoices extends Component
{
    public $invoices;
    public $clients;
    public $client_id = '';
    public $invoice_number = '';
    public $date_start = '';
    public $date_end = '';
    public $due_date = '';
    public $total_amount = '';
    public $status = 'draft';

    // Modal properties
    public $showItemsModal = false;
    public $currentInvoiceId = null;

    protected $rules = [
        'client_id' => 'required|exists:clients,id',
        'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number',
        'date_start' => 'required|date',
        'date_end' => 'required|date|after_or_equal:date_start',
        'due_date' => 'required|date|after_or_equal:date_end',
        'total_amount' => 'required|numeric|min:0',
        'status' => 'required|in:draft,sent,paid,overdue',
    ];

    protected $messages = [
        'client_id.required' => 'Please select a client.',
        'client_id.exists' => 'The selected client is invalid.',
        'invoice_number.required' => 'Invoice number is required.',
        'invoice_number.unique' => 'This invoice number already exists.',
        'date_start.required' => 'Start date is required.',
        'date_end.required' => 'End date is required.',
        'date_end.after_or_equal' => 'End date must be after or equal to start date.',
        'due_date.required' => 'Due date is required.',
        'due_date.after_or_equal' => 'Due date must be after or equal to end date.',
        'total_amount.required' => 'Total amount is required.',
        'total_amount.numeric' => 'Total amount must be a number.',
        'total_amount.min' => 'Total amount must be greater than or equal to 0.',
        'status.required' => 'Status is required.',
        'status.in' => 'Invalid status selected.',
    ];

    public function mount()
    {
        $this->loadInvoices();
        $this->clients = Client::orderBy('name')->get();

        // Set default dates
        $this->date_start = now()->format('Y-m-d');
        $this->date_end = now()->addDays(7)->format('Y-m-d');
        $this->due_date = now()->addDays(30)->format('Y-m-d');
    }

    public function loadInvoices()
    {
        $this->invoices = Invoice::with('client')->orderByDesc('created_at')->get();
    }

    public function save()
    {
        $this->validate();

        try {
            Invoice::create([
                'client_id' => $this->client_id,
                'invoice_number' => $this->invoice_number,
                'date_start' => $this->date_start,
                'date_end' => $this->date_end,
                'due_date' => $this->due_date,
                'total_amount' => $this->total_amount,
                'status' => $this->status,
            ]);

            $this->reset(['client_id', 'invoice_number', 'date_start', 'date_end', 'due_date', 'total_amount']);
            $this->status = 'draft';

            // Reset default dates
            $this->date_start = now()->format('Y-m-d');
            $this->date_end = now()->addDays(7)->format('Y-m-d');
            $this->due_date = now()->addDays(30)->format('Y-m-d');

            $this->loadInvoices();

            session()->flash('message', 'Invoice created successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating invoice: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            $this->loadInvoices();
            session()->flash('message', 'Invoice deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting invoice: ' . $e->getMessage());
        }
    }

    public function sendEmail($id)
    {
        try {
            $invoice = Invoice::with(['client', 'items'])->findOrFail($id);

            if (!$invoice->client->email) {
                session()->flash('error', 'Client email address is not available.');
                return;
            }

            $pdf = Pdf::loadView('invoices.pdf', compact('invoice'))->output();
            Mail::to($invoice->client->email)->send(new InvoiceSentMail($invoice, $pdf));

            // Update invoice status to sent
            $invoice->update(['status' => 'sent']);
            $this->loadInvoices();

            session()->flash('message', 'Invoice sent to ' . $invoice->client->email);
        } catch (\Exception $e) {
            session()->flash('error', 'Error sending invoice: ' . $e->getMessage());
        }
    }

    // Modal methods
    public function openInvoiceItems($invoiceId)
    {
        $this->currentInvoiceId = (int) $invoiceId;
        $this->showItemsModal = true;
    }

    public function closeItemsModal()
    {
        $this->showItemsModal = false;
        $this->currentInvoiceId = null;
    }

    // Listeners for child components
    protected $listeners = [
        'invoiceItemsUpdated' => 'handleInvoiceItemsUpdated',
        'closeModal' => 'closeItemsModal'
    ];

    public function handleInvoiceItemsUpdated()
    {
        // Refresh invoices when items are updated
        $this->loadInvoices();

        // Optionally close the modal
        // $this->closeItemsModal();
    }

    public function render()
    {
        return view('livewire.invoices.manage-invoices');
    }
}
