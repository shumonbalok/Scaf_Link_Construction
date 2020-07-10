<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClientTestomonial;
use App\Models\OurService;
use App\Models\Project;
use App\User;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function index()
    {
        $services = OurService::latest()->get()->take(5);
        $testimonials = ClientTestomonial::latest()->get()->take(3);
        $projects = Project::latest()->with('type')->get()->take(10);
        $users = User::where('status', 2)->with('role')->get();
        return view('welcome', compact('services', 'testimonials', 'projects', 'users'));
    }
}
