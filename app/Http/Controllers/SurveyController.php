<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\DTOs\SurveyDTO;
use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;

class SurveyController extends Controller
{
    public function index(): View
    {
        $survey = Survey::all();
        return view('survey.index', compact('survey'));
    }

    public function create(): View
    {
        return view('survey.create');
    }

    public function store(StoreSurveyRequest $request, StoreSurveyAction $action)
    {
        $dto = SurveyDTO::fromRequest($request);

        $survey = $action->handle($dto);

        $survey->organization;

        return redirect()->route('survey.index')->with('success', 'Survey created successfully!');
    }

    public function destroy(Request $request, Survey $survey)
    {
        if (!auth()->user()->can('delete', $survey)) {
            abort(403, 'Unauthorized action.');
        }

        $survey->delete();

        return redirect()->route('survey.index')->with('success', 'Survey deleted successfully!');
    }

    public function update(UpdateSurveyRequest $request, Survey $survey, UpdateSurveyAction $action) {
        $dto = SurveyDTO::fromRequest($request);

        $survey = $action->handle($dto, $survey);

        return redirect()->route('survey.index')->with('success', 'Survey updated successfully!');
    }

    public function edit(Survey $survey): View {
        return view('survey.edit', compact('survey'));
    }

    public function detail($id): View { 
        $survey = Survey::where('id', $id)->firstOrFail(); 
        $publicLink = route('survey.public.id', ['id' => $survey->id]); 
        return view('survey.detail', compact('survey', 'publicLink')); 
    } 
    
    public function showPublicById($id): View { 
        $survey = Survey::where('id', $id)->firstOrFail(); 
        return view('survey.public.show', compact('survey')); }
}