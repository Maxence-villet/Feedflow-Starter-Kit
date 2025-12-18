<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use App\DTOs\SurveyDTO;
use App\DTOs\SurveyQuestionDTO;
use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\Actions\Survey\StoreSurveyQuestionAction;

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

    public function detail($id): View 
    { 
        $survey = Survey::where('id', $id)->firstOrFail(); 
        $survey->load('questions');

        $hashedId = bin2hex($survey->id + 5555); 

        $publicLink = route('survey.public.id', ['id' => $hashedId]); 

        return view('survey.detail', compact('survey', 'publicLink')); 
    } 

    public function showPublicById($hashedId): View 
    { 
        try {
            $id = hex2bin($hashedId) - 5555;
            $survey = Survey::where('id', $id)->firstOrFail(); 
            return view('survey.public.show', compact('survey'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function show(Survey $survey): View
    {
        $survey->load('questions');
        
        $hashedId = bin2hex($survey->id + 5555); 
        $publicLink = route('survey.public.id', ['id' => $hashedId]); 


        return view('survey.detail', compact('survey', 'publicLink'));
    }

    public function createQuestion(Survey $survey): View
    {
        return view('survey.questions.create', compact('survey'));
    }

    public function storeQuestion(StoreSurveyQuestionRequest $request, StoreSurveyQuestionAction $action)
    {
        $dto = SurveyQuestionDTO::fromRequest($request);
        $surveyQuestion = $action->handle($dto);

        return redirect()->route('survey.questions.index', $request->survey_id)->with('Success', 'Question addes successfully!');
    }

    public function editQuestion(Survey $survey, SurveyQuestion $surveyQuestion): View
    {
        $surveyQuestion;
        return view('survey.questions.edit', compact('survey','surveyQuestion'));
    }

    public function destroyQuestion(SurveyQuestion $surveyQuestion)
    {
        $survey_id = $surveyQuestion->survey_id;
        $surveyQuestion->delete();

        return redirect()->route('survey.questions.index', $survey_id)->with('success', 'Question deleted successfully!');
    }
}
