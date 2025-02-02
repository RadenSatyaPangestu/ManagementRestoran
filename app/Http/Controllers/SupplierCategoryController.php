<?php

namespace App\Http\Controllers;

use App\Models\SupplierCategory;
use Illuminate\Http\Request;

class SupplierCategoryController extends Controller
{
    public function index()
    {
        $categories = SupplierCategory::all();
        return view('supplier_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SupplierCategory::create($request->only('name'));

        return redirect()->route('supplier_categories.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = SupplierCategory::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->route('supplier_categories.index');
    }

    public function destroy($id)
    {
        SupplierCategory::destroy($id);
        return redirect()->route('supplier_categories.index');
    }
}
