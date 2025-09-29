<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('app:generate-monthly-invoices', function () {
    Artisan::call('app:generate-monthly-invoices');
})->purpose('Generate and email monthly invoices for recurring clients')->monthlyOn(1, '02:00');
