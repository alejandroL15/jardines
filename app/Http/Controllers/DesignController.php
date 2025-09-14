<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // <--- ESTA ES LA LÍNEA QUE FALTABA
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestMail;

class DesignController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096',
            'style' => 'required|string',
        ]);

        try {
            $imageFile = $request->file('image');
            $imageData = base64_encode($imageFile->get());
            $imageMimeType = $imageFile->getMimeType();
            $style = $request->input('style');
            
            $apiKey = env('GEMINI_API_KEY');
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-image-preview:generateContent?key={$apiKey}";

            $prompt = "Rediseña esta foto de un espacio para que parezca un {$style}. Agrega plantas, flores y elementos de diseño de jardinería que se integren de forma natural y estética. El resultado debe ser una imagen fotorrealista del espacio transformado.";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            ['inlineData' => [
                                'mimeType' => $imageMimeType,
                                'data' => $imageData
                            ]]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseModalities' => ['IMAGE']
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['error' => 'Error al comunicarse con la IA.'], 500);
            }

            $parts = $response->json('candidates.0.content.parts', []);
            $generatedImageBase64 = null;
            foreach ($parts as $part) {
                if (isset($part['inlineData']['data'])) {
                    $generatedImageBase64 = $part['inlineData']['data'];
                    break;
                }
            }

            if (!$generatedImageBase64) {
                Log::error('Gemini API Response Invalid: ' . $response->body());
                return response()->json(['error' => 'La IA no devolvió una imagen válida.'], 500);
            }

            return response()->json(['imageBase64' => $generatedImageBase64]);

        } catch (\Exception $e) {
            Log::error('Server Error in generate(): ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error en el servidor.'], 500);
        }
    }

    public function sendQuoteRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string',
        ]);

        try {
            Mail::to('alejandrolr1508999@gmail.com')->send(new QuoteRequestMail($validated));
            return response()->json(['message' => 'Solicitud enviada con éxito.']);
        } catch (\Exception $e) {
            Log::error('Error al enviar correo: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo enviar la solicitud en este momento.'], 500);
        }
    }
}