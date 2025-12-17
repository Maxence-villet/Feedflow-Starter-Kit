<?php

namespace App\Http\Controllers;

use App\Actions\Organization\StoreOrganizationAction as OrganizationStoreOrganizationAction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Requests\Organization\StoreOrganization;
use App\Actions\StoreOrganizationAction;
use App\DTOs\OrganizationDTO;
use App\Http\Requests\Organization\DeleteOrganization;
use App\Http\Requests\Organization\UpdateOrganization;

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

    public function store(StoreOrganization $request, OrganizationStoreOrganizationAction $action) {
        $dto = OrganizationDTO::fromRequest($request);

        $organization = $action->handle($dto);

        return redirect()->route('organizations.index')->with('success', 'Organization created successfully!');
    }

    public function destroy(Request $request, Organization $organization) {
        if (!auth()->user()->can('delete', $organization)) {
            abort(403, 'Unauthorized action.');
        }

        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully!');
    }

    public function update(UpdateOrganization $request, Organization $organization){

        $organization->update([
            'name' => $request->name,
        ]);

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully!');
    }

    public function edit(Organization $organization): View {
        return view('organizations.edit', compact('organization'));
    }

    public function detail(Organization $organization): View {
        return view('organizations.detail', compact('organization'));
    }
}
