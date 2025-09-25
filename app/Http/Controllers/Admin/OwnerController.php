<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OwnerController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request)
    {
        $owners = User::query()->where('role', 'owner')->paginate(20);
        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Controller method usage
     */
    public function show(User $owner)
    {
        return view('admin.owners.show', compact('owner'));
    }

    /**
     * Controller method usage
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $owner = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'role' => 'owner',
        ]);

        return redirect()->route('admin.owners.index')->with('status', 'Owner created');
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, User $owner)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,' . $owner->id],
            'password' => ['sometimes', 'string', 'min:6'],
        ]);

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $owner->update($data);
        return redirect()->route('admin.owners.index')->with('status', 'Owner updated');
    }

    /**
     * Controller method usage
     */
    public function destroy(User $owner)
    {
        $owner->delete();
        return redirect()->route('admin.owners.index')->with('status', 'Owner deleted');
    }

    /**
     * Controller method usage
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Controller method usage
     */
    public function edit(User $owner)
    {
        return view('admin.owners.edit', compact('owner'));
    }
}


