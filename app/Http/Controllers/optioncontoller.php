<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;

class optioncontoller extends Controller
{


    public function editSettings()
    {
        $settings = Option::pluck('Opt_value', 'Opt_key');
        return view('admin/setting', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        // Validate the incoming request data if needed
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'footer' => 'required|string|max:255',
            'logo' => 'required|max:2048',
        ]);

        // Update settings in the database
        Option::where('Opt_key', 'title')
            ->update(['Opt_value' => $validatedData['title']]);

        Option::where('Opt_key', 'footer')
            ->update(['Opt_value' => $validatedData['footer']]);

        // Handle logo update if provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public');
            $logoName = basename($logoPath);
            Option::where('Opt_key', 'logo')->update(['Opt_value' => $logoName]);
        }

        return back()->with('success', 'Setting updated successfully');

}



}
