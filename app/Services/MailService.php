<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailService
{
  public function sendMail(Request $request)
  {
    $validated = $request->validate([
      'name'    => 'required|string|max:255',
      'email'   => 'required|email',
      'subject' => 'required|string|max:255',
      'message' => 'required|string',
    ]);

    Mail::to('drekmur@gmail.com')->send(new ContactMail($validated));

    return redirect('/contact')
      ->with('success', 'Correo enviado exitosamente, pronto nos pondremos en contacto contigo.');
  }
}
