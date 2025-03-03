<?php

namespace App\Http\Controllers;

use App\Models\TypeformResponse;
use Illuminate\Http\Request;

class TypeformWebhookController extends Controller
{
    public function handle(Request $request){

        if(!$this->verifySignature($request)){
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $data = $request->input('form_response');

        if(!$data){
            return response()->json(['error' => 'Invalid Paylod'], 400);
        }

        TypeformResponse::create([
            'form_id' => $data['form_id'],
            'response_id' => $data['token'],
            "submitted_at" => $data['submitted_at'],
            "landed_at" => $data['landed_at'],
            "questions" => json_encode($data['definition']),
            'answers' => json_encode($data['answers']),
        ]);

        return response()->json(['message' => 'Webhook received successfully'], 200);
    }

    public function verifySignature(Request $request){
        $secret = env('TYPEFORM_SECRET');
        $signature = $request->header('Typeform-Signature');

        $computedSignature = 'sha256=' . base64_encode(hash_hmac('sha256', $request->getContent(), $secret, true));

        return hash_equals($signature, $computedSignature);
    }
}
