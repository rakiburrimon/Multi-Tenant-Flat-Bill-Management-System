<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FlatController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        $flats = Flat::query()->forOwner($ownerId)->paginate(20);
        return response($flats);
    }

    /**
     * Controller method usage
     */
    public function show(Request $request, Flat $flat): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$flat->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }
        return response($flat);
    }

    /**
     * Controller method usage
     */
    public function store(Request $request): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        $data = $request->validate([
            'building_id' => ['required', 'integer', 'exists:buildings,id'],
            'number' => ['required', 'string', 'max:50'],
            'floor' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        $flat = Flat::query()->create([
            'building_id' => $data['building_id'],
            'house_owner_id' => $ownerId,
            'number' => $data['number'],
            'floor' => $data['floor'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        return response($flat, 201);
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, Flat $flat): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$flat->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'number' => ['sometimes', 'string', 'max:50'],
            'floor' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        $flat->update($data);
        return response($flat);
    }

    /**
     * Controller method usage
     */
    public function destroy(Request $request, Flat $flat): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$flat->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }
        $flat->delete();
        return response(null, 204);
    }
}


