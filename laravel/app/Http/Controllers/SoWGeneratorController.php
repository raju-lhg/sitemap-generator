<?php

namespace App\Http\Controllers;

use App\Models\ScopeOfWork;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class SoWGeneratorController extends Controller
{

    public function index(){

    }
    public function create(){
        return view('sow.create');
    }
    public function generate(Request $request){
        $request->validate([
            'prompt' => 'required',
            'description' => 'required',
        ]);

        $prompt = $request->input('prompt');
        $description = $request->input('description');

        try {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful system analyst assistan that generates a Scope of Work for projects and will always return output in markdown format.'],
                    ['role' => 'user', 'content' => $prompt],
                    ['role' => 'user', 'content' => $description],
                ],
                'max_tokens' => 4000,
                'temperature' => 0
            ]);

            $sow = $result['choices'][0]['message']['content'];
            \Log::info(['result' => $result]);

            $sowObj = new ScopeOfWork();

            $sowObj->prompt = $prompt;
            $sowObj->description = $description;
            $sowObj->sow = $sow;

            $sowObj->save();

            return redirect()->route('sow.view', ['id' => $sowObj->id]);

            // return view('view', compact('sow'));
        } catch (\Throwable $e) {
            throw $e;
            // Log the error for debugging and handle it appropriately.
            return back()->with('error', 'An error occurred while generating the Scope of Work.');
        }
    }

    public function view($id){
        $sow = ScopeOfWork::findOrFail($id);
        return view('sow.view', compact('sow'));
    }
}
