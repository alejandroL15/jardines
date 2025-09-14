<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function showForm()
    {
        return view('contacto');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        $data = $request->only('nombre', 'email', 'mensaje');

        Mail::to('alejandrolr1508999@gmail.com')->send(new ContactoMailable($data));

        return back()->with('success', 'Tu mensaje ha sido enviado con éxito ✅');
    }
}
