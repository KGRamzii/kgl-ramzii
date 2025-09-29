<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Mail\InvoiceSentMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class GenerateMonthlyInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly invoices for recurring clients and send them via email.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = now()->year;
        $month = now()->month;
        $date_start = now()->startOfMonth()->toDateString();
        $date_end = now()->endOfMonth()->toDateString();
        $due_date = now()->addDays(25)->toDateString();

        $clients = Client::where('status', 'active')->where('recurring', true)->get();
        foreach ($clients as $client) {
            // Generate invoice number: INV-YYYY-MM###
            $count = Invoice::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
            $invoice_number = sprintf('INV-%04d-%02d%03d', $year, $month, $count);

            $invoice = Invoice::create([
                'client_id' => $client->id,
                'invoice_number' => $invoice_number,
                'date_start' => $date_start,
                'date_end' => $date_end,
                'due_date' => $due_date,
                'total_amount' => $client->billing_rate,
                'status' => 'sent',
            ]);

            // Add default line items (customize as needed)
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => 'Monthly Hosting & Management',
                'quantity' => 1,
                'unit_price' => $client->billing_rate,
                'line_total' => $client->billing_rate,
            ]);

            // Generate PDF and send email
            $invoice->load(['client', 'items']);
            $pdf = Pdf::loadView('invoices.pdf', compact('invoice'))->output();
            Mail::to($client->email)->send(new InvoiceSentMail($invoice, $pdf));
            $this->info('Invoice sent to ' . $client->email . ' for ' . $invoice_number);
        }
        $this->info('Monthly invoices generated and sent.');
    }
}
