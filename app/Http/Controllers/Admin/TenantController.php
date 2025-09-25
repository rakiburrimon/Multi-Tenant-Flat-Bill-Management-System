<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TenantController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request): Response
    {
        $tenants = Tenant::query()->paginate(20);
        return response($tenants);
    }

    /**
     * Controller method usage
     */
    public function show(Tenant $tenant): Response
    {
        return response($tenant);
    }

    /**
     * Controller method usage
     */
    public function store(Request $request): Response
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

        return response($tenant, 201);
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, Tenant $tenant): Response
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $tenant->update($data);
        return response($tenant);
    }

    /**
     * Controller method usage
     */
    public function destroy(Tenant $tenant): Response
    {
        $tenant->delete();
        return response(null, 204);
    }

    /**
     * Controller method usage
     */
    public function assignToOwner(Tenant $tenant, User $owner): Response
    {
        $tenant->house_owner_id = $owner->id;
        $tenant->save();
        return response($tenant);
    }
}


