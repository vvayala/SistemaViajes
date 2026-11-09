<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum_Participation;
use Illuminate\Support\Facades\Auth;

class ForumParticipationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'forum_id' => 'required',
            'comment' => 'required'
        ]);

        Forum_Participation::create([
            'forum_id' => $request->forum_id,
            'user_id' => Auth::user()->user_id,
            'comment' => $request->comment
        ]);

        return redirect()
            ->back()
            ->with('success', 'Respuesta publicada.');
    }
}
