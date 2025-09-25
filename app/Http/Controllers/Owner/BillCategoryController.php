<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\BillCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillCategoryController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(): Response
    {
        $categories = BillCategory::query()->orderBy('name')->get();
        return response($categories);
    }

    /**
     * Controller method usage
     */
    public function store(Request $request): Response
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:bill_categories,name'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $category = BillCategory::query()->create($data);
        return response($category, 201);
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, BillCategory $category): Response
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:100', 'unique:bill_categories,name,' . $category->id],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $category->update($data);
        return response($category);
    }

    /**
     * Controller method usage
     */
    public function destroy(BillCategory $category): Response
    {
        $category->delete();
        return response(null, 204);
    }
}


