<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhook\XenditController;

Route::post('/webhook/xendit', [XenditController::class, 'handle']);
