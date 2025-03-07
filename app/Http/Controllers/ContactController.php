<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // Model untuk menyimpan pesan

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('emails.contact');
    }

    /**
     * Menangani pengiriman pesan dari formulir kontak.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}