<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Requests\Organization\StoreOrganization;

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

    public function store(StoreOrganization $request) {
        $organization = Organization::create([
            'name'=> $request->name,
            'user_id'=> auth()->id()
        ]);


        return redirect()->route('organizations.index', $organization)->with('success', 'Organization created successfully!');
    }
}
