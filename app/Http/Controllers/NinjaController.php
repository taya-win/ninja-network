<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Http\Request;

class NinjaController extends Controller
{
    public function index() {
        $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);

        return view('ninjas.index', [
            'ninjas' => $ninjas,
        ]);
    }

    public function create() {
        $dojos = Dojo::all();
        return view('ninjas.create', ['dojos' => $dojos]);
    }

    public function show(Ninja $ninja) {
        return view('ninjas.show', ['ninja' => $ninja->load('dojo')]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'skill' => 'required|integer|min:0|max:100',
            'bio' => 'required|string|min:20|max:1000',
            'dojo_id' => 'required|exists:dojos,id',
        ]);

        Ninja::create($validated);

        return redirect()->route('ninjas.index')->with('success', 'Ninja Created!');

    }

    public function destroy(Ninja $ninja) {
        $ninja->delete();

        return redirect()->route('ninjas.index')->with('success', "Ninja Deleted!");
    }
}
