<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed demo user only if not exists
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'testpassword'
            ]);
        }

        // Seed services
        $services = \App\Models\Service::factory(8)->create();
        // Add 2 inactive services
        \App\Models\Service::factory(2)->inactive()->create();

        // Seed demo clients
        \App\Models\Client::factory(5)->create()->each(function ($client) use ($services) {
            // Attach random services to client with custom pricing
            $services->random(rand(2, 5))->each(function ($service) use ($client) {
                $client->services()->attach($service->id, [
                    'custom_price' => $service->default_price * (rand(80, 120) / 100), // ±20% of default price
                    'active' => true,
                ]);
            });

            // Seed invoices for each client
            $invoices = \App\Models\Invoice::factory(2)->create(['client_id' => $client->id]);
            foreach ($invoices as $invoice) {
                // Get client's active services
                $clientServices = $client->services;
                if ($clientServices->isNotEmpty()) {
                    // Create invoice items from client's services
                    $clientServices->random(rand(1, 3))->each(function ($service) use ($invoice) {
                        \App\Models\InvoiceItem::factory()->create([
                            'invoice_id' => $invoice->id,
                            'service_id' => $service->id,
                            'description' => $service->name,
                            'unit_price' => $service->pivot->custom_price,
                        ]);
                    });
                }
            }
        });

        // Seed demo contacts
        \App\Models\Contact::factory(3)->create();

        // Seed demo settings
        \App\Models\Setting::factory()->create([
            'key' => 'business_name',
            'value' => 'Ramzii Freelance Solutions',
        ]);
        \App\Models\Setting::factory()->create([
            'key' => 'paypal_email',
            'value' => 'paypal@ramzii.com',
        ]);
    }
}
