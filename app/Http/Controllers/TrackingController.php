<?php

namespace App\Http\Controllers;

use App\Jobs\TrackHitJob;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track($tracker_public_id, Request $request)
    {
        TrackHitJob::dispatch($tracker_public_id, $request);
    }
}
