<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;

class ReactionController extends Controller
{
    /**
     * Store a new reaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $chirpId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $chirpId)
    {
        $request->validate([
            'type' => 'required|string',
        ]);

        Reaction::create([
            'user_id' => auth()->id(),
            'chirp_id' => $chirpId,
            'type' => $request->type,
        ]);

        return redirect()->back();
    }
}

