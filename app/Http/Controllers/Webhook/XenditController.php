<?php

namespace App\Http\Controllers\Webhook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class XenditController extends Controller
{
    public function handle(Request $request)
    {
        // Ambil token dari header
        $headerToken = $request->header('X-CALLBACK-TOKEN');
        $validToken = env('XENDIT_CALLBACK_TOKEN');

        if ($headerToken !== $validToken) {
            Log::warning('Xendit callback token mismatch.', [
                'received' => $headerToken
            ]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Log isi webhook
        Log::info('Xendit Webhook Received', $request->all());

        // TODO: Tambahkan logic untuk menyimpan atau update status pembayaran

        return response()->json(['message' => 'Webhook received'], 200);
    }
}
