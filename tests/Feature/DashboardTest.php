<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Client;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Dashboard\Overview;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure we're using a clean database state for each test
        $this->artisan('migrate:fresh');
    }

    /** @test */
    public function dashboard_shows_correct_stats()
    {
        $user = User::factory()->create();

        // Create some test clients using factories for better consistency
        $activeClient = Client::factory()->create([
            'name' => 'Active Client',
            'email' => 'active@example.com',
            'status' => 'active',
            'user_id' => $user->id, // Associate with the user if needed
        ]);

        $inactiveClient = Client::factory()->create([
            'name' => 'Inactive Client',
            'email' => 'inactive@example.com',
            'status' => 'inactive',
            'user_id' => $user->id, // Associate with the user if needed
        ]);

        $this->actingAs($user);

        Livewire::test(Overview::class)
            ->assertSee('Total Clients')
            ->assertSee('Active Clients')
            ->assertSee('Active Client')
            ->assertSee('Inactive Client')
            ->assertSee('2') // Total clients
            ->assertSee('1') // Active clients
            ->assertViewHas('totalClients', 2)
            ->assertViewHas('activeClients', 1);
    }

    /** @test */
    public function dashboard_requires_authentication()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_access_dashboard()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    /** @test */
    public function dashboard_shows_empty_state_for_no_clients()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Ensure no clients exist
        $this->assertEquals(0, Client::count());

        Livewire::test(Overview::class)
            ->assertSee('No clients found')
            ->assertSee('Add your first client')
            ->assertViewHas('totalClients', 0)
            ->assertViewHas('activeClients', 0);
    }

    /** @test */
    public function dashboard_filters_clients_by_user_if_applicable()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create clients for different users
        Client::factory()->create([
            'user_id' => $user1->id,
            'status' => 'active',
        ]);

        Client::factory()->create([
            'user_id' => $user2->id,
            'status' => 'active',
        ]);

        $this->actingAs($user1);

        // User 1 should only see their own client
        Livewire::test(Overview::class)
            ->assertSee('1') // Should see only 1 client, not 2
            ->assertViewHas('totalClients', 1);
    }

    /** @test */
    public function dashboard_handles_different_client_statuses()
    {
        $user = User::factory()->create();

        // Create clients with various statuses
        Client::factory()->count(3)->create([
            'user_id' => $user->id,
            'status' => 'active',
        ]);

        Client::factory()->count(2)->create([
            'user_id' => $user->id,
            'status' => 'inactive',
        ]);

        Client::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        Livewire::test(Overview::class)
            ->assertSee('6') // Total clients
            ->assertSee('3') // Active clients
            ->assertViewHas('totalClients', 6)
            ->assertViewHas('activeClients', 3);
    }

    /** @test */
    public function dashboard_component_loads_without_errors()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // Test that the Livewire component loads without throwing exceptions
        $component = Livewire::test(Overview::class);

        $this->assertNotNull($component);
        $component->assertSuccessful();
    }

    /** @test */
    public function dashboard_displays_proper_headings_and_structure()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Overview::class)
            ->assertSee('Dashboard') // Assuming there's a dashboard heading
            ->assertSee('Overview') // Component name
            ->assertDontSee('Error') // Should not show any error messages
            ->assertDontSee('Exception'); // Should not show any exceptions
    }
}
