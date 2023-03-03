<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    public function showHome()
    {
        return Inertia::render('Home');
    }
    public function showStatistics()
    {
        return Inertia::render('Statistics');
    }
    public function showStaffSubmission()
    {
        return Inertia::render('StaffSubmission');
    }
}