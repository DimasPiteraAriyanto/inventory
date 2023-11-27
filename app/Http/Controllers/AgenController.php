<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AgenController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $agens = Agen::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('agens.index', [
            'agens' => $agens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:agens,email',
            'phone' => 'required|string|max:25|unique:agens,phone',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload an image
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/agens/';

            // Store an image to Storage
            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Agen::create($validatedData);

        return Redirect::route('agens.index')->with('success', 'New customer has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agen $agen)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agen $agen)
    {
        return view('agens.edit', [
            'customer' => $agen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agen $agen)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:agens,email,'.$agen->id,
            'phone' => 'required|string|max:25|unique:agens,phone,'.$agen->id,
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/agens/';

            /**
             * Delete an image if exists.
             */
            if($agen->photo){
                Storage::delete($path . $agen->photo);
            }

            // Store an image to Storage
            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Agen::where('id', $agen->id)->update($validatedData);

        return Redirect::route('agens.index')->with('success', 'Agen has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agen $agen)
    {
        /**
         * Delete photo if exists.
         */
        if($agen->photo){
            Storage::delete('public/agens/' . $agen->photo);
        }

        Agen::destroy($agen->id);

        return Redirect::route('agens.index')->with('success', 'Agen has been deleted!');
    }
}
