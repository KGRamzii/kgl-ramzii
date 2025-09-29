<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Mail\ContactLeadMail;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string|max:1000',
    ];

    public function submit()
    {
        $this->validate();
        $contact = Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);
        Mail::to(config('mail.from.address'))->send(new ContactLeadMail($contact));
        $this->reset(['name', 'email', 'phone', 'message']);
        session()->flash('message', 'Thank you for reaching out! I will get back to you soon.');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
