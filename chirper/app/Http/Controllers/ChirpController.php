<?php

namespace App\Http\Controllers;


use App\Models\chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        /*return view('chirps.index', [
            'chirps' => Chirp::where('user_id', auth()->id())->with('user','reactions')->latest()->get(),
        ]);*/
        $chirps = Chirp::where('user_id', auth()->id())->with('user', 'reactions')->get();
        return view('chirps.index', compact('chirps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            //'message' => 'required|string|max:255',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
        ]);

        $chirpData = [
            'user_id' => auth()->id(),
            'content' => $request->content,
        ];

        if ($request->hasFile('photo')) {
            $chirpData['photo'] = $request->file('photo')->store('chirp_photos', 'public');
        }

        if ($request->hasFile('video')) {
            $chirpData['video'] = $request->file('video')->store('chirp_videos', 'public');
        }
        
        Chirp::create($chirpData);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        Gate::authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(chirp $chirp):RedirectResponse
    {
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }
}
