<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyCategoryController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'min:5', 'unique:company_categories,category_name'],
        ]);
        CompanyCategory::create([
            'category_name' => $request->category_name
        ]);
        Alert::toast('Category Created!', 'success');
        return redirect()->route('account.dashboard');
    }

    public function edit(CompanyCategory $category)
    {
        return view('company-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => [
                'required',
                'min:5',
                Rule::unique('company_categories', 'category_name')->ignore($id),
            ],
        ]);
        $category = CompanyCategory::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name
        ]);
        Alert::toast('Category Updated!', 'success');
        return redirect()->route('account.dashboard');
    }

    public function destroy($id)
    {
        if (Company::where('company_category_id', $id)->exists()) {
            Alert::toast('Cannot delete a category that has companies.', 'warning');
            return redirect()->route('account.dashboard');
        }

        $category = CompanyCategory::findOrFail($id);
        $category->delete();
        Alert::toast('Category Delete!', 'success');
        return redirect()->route('account.dashboard');
    }
}
