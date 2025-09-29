<?php

namespace App\Livewire\Dashboard;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Overview extends Component
{
    public function render()
    {
        $stats = [
            'total_clients' => Client::count(),
            'active_clients' => Client::where('status', 'active')->count(),
            'recent_clients' => Client::latest()->take(5)->get(),
            'client_statuses' => Client::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status')
                ->toArray(),
        ];

        return view('livewire.dashboard.overview', [
            'stats' => $stats,
        ]);
    }
}
