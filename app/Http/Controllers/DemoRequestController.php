<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoRequestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\DemoRequest;

class DemoRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'source' => 'required|string'
        ]);

        // Salvar a solicitação no banco
        $demoRequest = DemoRequest::create([
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'source' => $request->source
        ]);

        // Enviar email
        Mail::to(config('mail.admin_email'))
            ->send(new DemoRequestMail($demoRequest));

        return response()->json([
            'message' => 'Solicitação de demonstração recebida com sucesso',
            'status' => 'success'
        ]);
    }
} 