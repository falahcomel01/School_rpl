<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
   public function update(Request $request): RedirectResponse
{
    $request->validateWithBag('updatePassword', [
        'current_password' => ['required', 'current_password'],
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',    
            'regex:/[A-Z]/',      
            'regex:/[0-9]/',      
            'confirmed'
        ],
    ], [
        'password.regex' => 'Password harus memiliki huruf besar, huruf kecil, dan angka.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ]);
    $request->user()->update([
        'password' => $request->password,
    ]);

    return back()->with('success', 'Password berhasil diubah');
}
}