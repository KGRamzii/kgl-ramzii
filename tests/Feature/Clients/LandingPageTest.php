<?php

namespace Tests\Feature\Clients;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Clients\LandingPage;

class LandingPageTest extends TestCase
{
    public function test_landing_page_loads()
    {
        $response = $this->get(route('clients.landing'));
        $response->assertStatus(200);
    }

    public function test_landing_page_has_correct_content()
    {
        $response = $this->get(route('clients.landing'));
        $response->assertSee('Welcome to Your Digital Success Partner');
        $response->assertSee('Transform your ideas into powerful digital solutions');
    }

    public function test_landing_page_livewire_component_exists()
    {
        Livewire::test(LandingPage::class)
            ->assertSet('name', 'Kagiso Ramogayana')
            ->assertSet('role', 'Full Stack Developer')
            ->assertSee('Welcome to Your Digital Success Partner');
    }
}
