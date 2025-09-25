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
    public function index()
    {
        $categories = BillCategory::query()->orderBy('name')->paginate(20);
        return view('owner.categories.index', compact('categories'));
    }

    /**
     * Controller method usage
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:bill_categories,name'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        BillCategory::query()->create($data);
        return redirect()->route('owner.categories.index')->with('status', 'Category created');
    }

    /**
     * Controller method usage
     */
    public function update(Request $request, BillCategory $category)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:100', 'unique:bill_categories,name,' . $category->id],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $category->update($data);
        return redirect()->route('owner.categories.index')->with('status', 'Category updated');
    }

    /**
     * Controller method usage
     */
    public function destroy(BillCategory $category)
    {
        $category->delete();
        return redirect()->route('owner.categories.index')->with('status', 'Category deleted');
    }

    /**
     * Controller method usage
     */
    public function create()
    {
        return view('owner.categories.create');
    }

    /**
     * Controller method usage
     */
    public function edit(BillCategory $category)
    {
        return view('owner.categories.edit', compact('category'));
    }
}


