<?php

namespace App\Livewire\Clients;

use Livewire\Component;

#[\Livewire\Attributes\Layout('layouts.guest')]
class LandingPage extends Component
{
    public $name = 'Kagiso Ramogayana';
    public $role = 'Full Stack Developer';
    public $highlights = [
        'Expertise in building scalable web applications',
        'Cloud-native development with Azure',
        'Strong focus on performance and user experience',
        'Continuous learning and technology innovation',
        'Creating visually appealing graphics and layouts',
        'Designing responsive and user-friendly interfaces',
    ];
    public $socialLinks = [
        'email' => 'mailto:kagiso1382@gmail.com',
        'whatsapp' => 'https://wa.me/27817342820',
    ];

    public $projects = [
        [
            'name' => 'FPS game Ranking',
            'description' => 'An application aimed to document, schedule and report custom challenges amongst friends in a popular fps game named Valorant.',
            'technologies' => ['Laravel', 'Livewire', 'Webhook', 'API', 'Tailwind CSS'],
            'difficulty' => 'Intermediate',
            'timeline' => '3 months',
            'completion_date' => '2024-11-01',
            'status' => 'Completed',
            'link' => 'https://pleasedontshoot.fly.dev',
            'repository' => 'https://github.com/KGRamzii/pleasedontshoot',
            'preview' => '/images/pds/pds.png',
            'category' => 'Web Development',
            'screenshots' => ['/storage/images/pds/pds.png'],
        ],
        [
            'name' => 'AmoShots',
            'description' => 'A landing page for a photography business, showcasing portfolio and services.',
            'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS'],
            'difficulty' => 'Beginner',
            'timeline' => '4 weeks',
            'completion_date' => '2025-06-12',
            'status' => 'Completed',
            'link' => 'https://amoshots.com',
            'repository' => null,
            'preview' => '/images/amoshots/web.png',
            'category' => 'Web Development',
            'screenshots' => ['/storage/images/amoshots/web.png', '/storage/images/amoshots/mobile.png'],
        ]
    ];

    public $selectedCategory = 'All';
    public $modalProject = null;

    public function render()
    {
        return view('livewire.clients.landing-page');
    }
}
