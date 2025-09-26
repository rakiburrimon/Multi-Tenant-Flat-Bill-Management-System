<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Flat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TenantController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request)
    {
        $tenants = Tenant::query()->paginate(20);
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Controller method usage
     */
    public function show(Tenant $tenant)
    {
        return view('admin.tenants.show', compact('tenant'));
    }

    /**
     * Controller method usage
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'owner_id' => ['required', 'integer', 'exists:users,id'],
            'flat_id' => ['required', 'integer', 'exists:flats,id'],
        ]);

        $tenant = Tenant::query()->create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'house_owner_id' => $data['owner_id'],
            'flat_id' => $data['flat_id'],
        ]);

        return redirect()->route('admin.tenants.index')->with('status', 'Tenant created');
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, Tenant $tenant)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'owner_id' => ['sometimes', 'integer', 'exists:users,id'],
            'flat_id' => ['sometimes', 'integer', 'exists:flats,id'],
        ]);

        if (isset($data['owner_id'])) {
            $data['house_owner_id'] = $data['owner_id'];
            unset($data['owner_id']);
        }

        $tenant->update($data);
        return redirect()->route('admin.tenants.index')->with('status', 'Tenant updated');
    }

    /**
     * Controller method usage
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('admin.tenants.index')->with('status', 'Tenant deleted');
    }

    /**
     * Controller method usage
     */
    public function assignToOwner(Tenant $tenant, User $owner)
    {
        $tenant->house_owner_id = $owner->id;
        $tenant->save();
        return redirect()->route('admin.tenants.show', $tenant)->with('status', 'Tenant assigned');
    }

    /**
     * Controller method usage
     */
    public function create()
    {
        $owners = User::where('role', 'owner')->get();
        $flats = Flat::with('building')->get();
        return view('admin.tenants.create', compact('owners', 'flats'));
    }

    /**
     * Controller method usage
     */
    public function edit(Tenant $tenant)
    {
        $owners = User::where('role', 'owner')->get();
        $flats = Flat::with('building')->get();
        return view('admin.tenants.edit', compact('tenant', 'owners', 'flats'));
    }
}


