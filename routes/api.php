<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RasaChatbotController;
use App\Http\Controllers\DemoRequestController;

// ... existing code ...

// Rotas do Rasa Chatbot
Route::post('/chatbot/message', [RasaChatbotController::class, 'processMessage']);
Route::post('/send-email', [RasaChatbotController::class, 'sendEmail']);
Route::post('/demo-request', [DemoRequestController::class, 'store']);

// ... existing code ... 