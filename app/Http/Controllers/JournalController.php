<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OpenAIService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JournalController extends Controller
{
    use AuthorizesRequests;
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())->latest()->get();
        return view ('journals.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('journals.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([ 
            'title' => 'required|string|max:255', 
            'content' => 'required|string'
        ]); 
     
        Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);
     
        // Redirect to the post detail page with a success message 
        return redirect()->route('journals.index') ->with('success', 'Content created successfully!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Journal $journal)
    {
        $this->authorize('view', $journal);
        return view('journals.show', compact('journal'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Journal $journal)
    {
        $this->authorize('update', $journal);
        return view('journals.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Journal $journal)
    {
        $this->authorize('update', $journal);
     
        // Validate the incoming changes 
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $journal->update($request->only('title', 'content'));

        return redirect()->route('journals.index')->with('success', 'Content updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journal $journal)
    {
        $this->authorize('delete', $journal);
        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Content deleted.');
    }

    public function generateAI(Request $request, Journal $journal, OpenAIService $openAI)
    {
        $prompt = "Analyze this journal entry and recommend activities for the next day\n\n" . $journal->content;
        $response = $openAI->generateResponse($prompt);

        return view('journals.show', [
            'journal' => $journal,
            'aiResponse' => $response,
        ]);
    }

}
