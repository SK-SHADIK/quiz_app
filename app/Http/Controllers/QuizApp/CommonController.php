<?php

namespace App\Http\Controllers\QuizApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller
{
    //-------------------------- Logs --------------------------

    public function viewLogs()
    {
        // Retrieve log entries
        $logs = Log::get('storage/logs/laravel');

        // Display or manipulate log entries as needed
        dd($logs);
    }

}