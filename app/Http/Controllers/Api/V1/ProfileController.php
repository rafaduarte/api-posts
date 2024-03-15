<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //return Profile::all();
       return Profile::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Profile::create($request->all());
        $rules = [
            'bio' => 'required|string|max:25',
        ];
        $messages = [
            'bio.required' => 'O campo bio é obrigatório',
            'bio.max' => 'O campo não pode ultrapassar 25 caracteres',
        ];

        $validated = $request->validate($rules, $messages);

        Profile::create($validated);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::find($id);

        if($profile) {
            return response()->json($profile, 200);
        } else {
            return response()->json(['message' => 'Perfil não encontrado']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);
        $profile->update($request->all());
        return response()->json($profile, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Profile::find($id)->delete();
    }
}
