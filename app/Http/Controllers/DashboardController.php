<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }
        
        return $this->ownerDashboard($user);
    }

    /**
     * Controller method usage
     */
    private function adminDashboard()
    {
        $stats = [
            'total_owners' => User::where('role', 'owner')->count(),
            'total_tenants' => Tenant::count(),
            'total_buildings' => Building::count(),
            'total_bills' => Bill::count(),
        ];

        $recent_owners = User::where('role', 'owner')->latest()->limit(5)->get();
        $recent_tenants = Tenant::with('flat')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_owners', 'recent_tenants'));
    }

    /**
     * Controller method usage
     */
    private function ownerDashboard(User $user)
    {
        $ownerId = $user->id;
        
        $stats = [
            'total_buildings' => Building::where('house_owner_id', $ownerId)->count(),
            'total_flats' => Flat::where('house_owner_id', $ownerId)->count(),
            'total_tenants' => Tenant::where('house_owner_id', $ownerId)->count(),
            'total_bills' => Bill::where('house_owner_id', $ownerId)->count(),
            'unpaid_bills' => Bill::where('house_owner_id', $ownerId)->where('status', 'unpaid')->count(),
            'overdue_bills' => Bill::where('house_owner_id', $ownerId)->where('status', 'overdue')->count(),
        ];

        $recent_bills = Bill::where('house_owner_id', $ownerId)->latest()->limit(5)->get();
        $buildings = Building::where('house_owner_id', $ownerId)->with('flats')->get();

        return view('owner.dashboard', compact('stats', 'recent_bills', 'buildings'));
    }
}
