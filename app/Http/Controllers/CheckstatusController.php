<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\Request;

class CheckstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function create()
    {
        return view('check-status.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function checkStatus(Request $request)
    {
        $application = null;

        if ($request->has('registration_number') && $request->filled('registration_number')) {
            $application = Applications::where('registration_number', trim($request->registration_number))->first();

            if (!$application) {
                return redirect()->back()->with('notFound', 'Nomor pengajuan tidak ditemukan. Pastikan format yang diinputkan benar!');
            }
        }
        return view('check-status.index', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
