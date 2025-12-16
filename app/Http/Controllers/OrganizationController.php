<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Factory;

class OrganizationController extends Controller
{
    public function index(): View {
        //dd(auth()->user()->id());
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function create(): View {
        return view('organizations.create');
    }

    public function store(Request $request) {

        //dd(auth()->user());
        $organization = Organization::create([
            'name'=> $request->name,
            'user_id'=> auth()->id()
        ]);

        return redirect()->route('organizations.index')->with('success', 'Organization created successfully!');
    }
}
