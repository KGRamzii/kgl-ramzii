<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Setting;

class ManageSettings extends Component
{
    public $business_name = '';
    public $paypal_email = '';

    public function mount()
    {
        $this->business_name = Setting::where('key', 'business_name')->value('value') ?? '';
        $this->paypal_email = Setting::where('key', 'paypal_email')->value('value') ?? '';
    }

    public function save()
    {
        Setting::updateOrCreate(['key' => 'business_name'], ['value' => $this->business_name]);
        Setting::updateOrCreate(['key' => 'paypal_email'], ['value' => $this->paypal_email]);
        session()->flash('message', 'Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.settings.manage-settings');
    }
}
