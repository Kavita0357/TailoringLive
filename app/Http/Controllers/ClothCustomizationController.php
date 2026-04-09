<?php

namespace App\Http\Controllers;

use App\ClothCustomization;
use Illuminate\Http\Request;

class ClothCustomizationController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'cloth_id' => 'required|exists:cloths,id',
            'contact_id' => 'required|exists:contacts,id',
            'measurements' => 'nullable|array',
            'styles' => 'nullable|array',
            'cloth_customization_note' => 'nullable|string',
        ]);

        $customization = ClothCustomization::updateOrCreate(
            [
                'cloth_id' => $validated['cloth_id'],
                'contact_id' => $validated['contact_id'],
            ],
            [
                'measurements' => $validated['measurements'] ?? [],
                'styles' => $validated['styles'] ?? [],
                'note' => $validated['cloth_customization_note'] ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'msg' => 'Cloth customization saved successfully!',
            'data' => $customization
        ]);
    }
}
