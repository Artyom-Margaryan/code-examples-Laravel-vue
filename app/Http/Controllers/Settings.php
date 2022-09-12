<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;


class SettingsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Settings/Index');
    }
}
