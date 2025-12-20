<?php

namespace App\Http\Controllers;

use App\Models\OpsiJawaban; // <-- Diperbaiki
use Illuminate\Http\Request;

class OpsiJawabanController extends Controller
{
    // ... (method index, create, store tidak perlu perubahan)

    /**
     * Display the specified resource.
     */
    public function show(OpsiJawaban $opsiJawaban) // <-- Diperbaiki
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpsiJawaban $opsiJawaban) // <-- Diperbaiki
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OpsiJawaban $opsiJawaban) // <-- Diperbaiki
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpsiJawaban $opsiJawaban) // <-- Diperbaiki
    {
        //
    }
}