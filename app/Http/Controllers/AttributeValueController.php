<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index()
    {
        $attributeValues = AttributeValue::with('attribute')->latest('id')->paginate();
        return view('backend.attributevalue.index', compact('attributeValues'));
    }

    public function create()
    {
        $attributes = Attribute::orderBy('name')->get();
        return view('backend.attributevalue.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string',
        ]);

        $attributeValue = AttributeValue::create($validatedData);

        return redirect()->route('attribute-values.index')->with(
            $attributeValue ? 'success' : 'error',
            $attributeValue ? 'Attribute value successfully created' : 'Error, Please try again'
        );
    }

    public function edit($id)
    {
        $attributeValue = AttributeValue::find($id);
        $attributes = Attribute::orderBy('name')->get();

        if (!$attributeValue) {
            return redirect()->back()->with('error', 'Attribute value not found');
        }

        return view('backend.attributevalue.edit', compact('attributeValue', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $attributeValue = AttributeValue::find($id);
        if (!$attributeValue) {
            return redirect()->back()->with('error', 'Attribute value not found');
        }

        $validatedData = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string',
        ]);

        $status = $attributeValue->update($validatedData);

        return redirect()->route('attribute-values.index')->with(
            $status ? 'success' : 'error',
            $status ? 'Attribute value successfully updated' : 'Error, Please try again'
        );
    }

    public function destroy($id)
    {
        $attributeValue = AttributeValue::find($id);
        if (!$attributeValue) {
            return redirect()->back()->with('error', 'Attribute value not found');
        }

        $status = $attributeValue->delete();

        return redirect()->route('attribute-values.index')->with(
            $status ? 'success' : 'error',
            $status ? 'Attribute value successfully deleted' : 'Error, Please try again'
        );
    }
}
