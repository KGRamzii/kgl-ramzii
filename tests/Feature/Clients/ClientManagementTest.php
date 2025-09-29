<?php

namespace Tests\Feature\Clients;

use App\Models\User;
use App\Models\Client;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Clients\{Index, Create, Edit};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function client_pages_require_authentication()
    {
        $response = $this->get(route('clients.index'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('clients.create'));
        $response->assertRedirect(route('login'));

        $client = Client::factory()->create();
        $response = $this->get(route('clients.edit', $client));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function can_view_clients_list()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->assertSee($client->name)
            ->assertSee($client->email);
    }

    /** @test */
    public function can_search_clients()
    {
        $user = User::factory()->create();
        $clientA = Client::factory()->create(['name' => 'John Doe']);
        $clientB = Client::factory()->create(['name' => 'Jane Smith']);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('search', 'John')
            ->assertSee('John Doe')
            ->assertDontSee('Jane Smith');
    }

    /** @test */
    public function can_filter_by_status()
    {
        $user = User::factory()->create();
        $activeClient = Client::factory()->create(['status' => 'active']);
        $inactiveClient = Client::factory()->create(['status' => 'inactive']);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('status', 'active')
            ->assertSee($activeClient->name)
            ->assertDontSee($inactiveClient->name);
    }

    /** @test */
    public function can_create_client()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('business_name', 'Acme Inc')
            ->set('phone', '1234567890')
            ->set('billing_rate', 100)
            ->set('notes', 'Test notes')
            ->set('status', 'active')
            ->set('recurring', true)
            ->call('save');

        $this->assertDatabaseHas('clients', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'business_name' => 'Acme Inc',
            'phone' => '1234567890',
            'billing_rate' => 100,
            'notes' => 'Test notes',
            'status' => 'active',
            'recurring' => true,
        ]);
    }

    /** @test */
    public function email_must_be_unique_when_creating()
    {
        $user = User::factory()->create();
        Client::create([
            'name' => 'Existing Client',
            'email' => 'john@example.com',
            'status' => 'active',
        ]);

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('status', 'active')
            ->call('save')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    public function can_edit_client()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        Livewire::actingAs($user)
            ->test(Edit::class, ['client' => $client])
            ->set('name', 'Updated Name')
            ->set('email', 'updated@example.com')
            ->call('save');

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /** @test */
    public function email_must_be_unique_when_editing_except_current_client()
    {
        $user = User::factory()->create();
        $clientA = Client::create([
            'name' => 'Client A',
            'email' => 'a@example.com',
            'status' => 'active',
        ]);
        $clientB = Client::create([
            'name' => 'Client B',
            'email' => 'b@example.com',
            'status' => 'active',
        ]);

        Livewire::actingAs($user)
            ->test(Edit::class, ['client' => $clientA])
            ->set('email', 'b@example.com')
            ->call('save')
            ->assertHasErrors(['email' => 'unique']);
    }
}
