<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Helpers\helpers;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest('id')->paginate();
        return view('backend.attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.attribute.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        //$validatedData['slug'] = generateUniqueSlug($request->name, Attribute::class);

        $attribute = Attribute::create($validatedData);

        return redirect()->route('attribute.index')->with(
            $attribute ? 'success' : 'error',
            $attribute ? 'Attribute successfully created' : 'Error, Please try again'
        );
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute) {
            return redirect()->back()->with('error', 'Attribute not found');
        }

        return view('backend.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute) {
            return redirect()->back()->with('error', 'Attribute not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $status = $attribute->update($validatedData);

        return redirect()->route('attribute.index')->with(
            $status ? 'success' : 'error',
            $status ? 'Attribute successfully updated' : 'Error, Please try again'
        );
    }

    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute) {
            return redirect()->back()->with('error', 'Attribute not found');
        }

        $status = $attribute->delete();

        return redirect()->route('attributes.index')->with(
            $status ? 'success' : 'error',
            $status ? 'Attribute successfully deleted' : 'Error, Please try again'
        );
    }
}
