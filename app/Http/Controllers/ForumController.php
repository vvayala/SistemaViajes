<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Services\CloudinaryService;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('user')
            ->latest()
            ->get();

        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $forum = Forum::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->user_id
        ]);

        if ($request->hasFile('images')) {

        foreach (
            $request->file('images')
            as $index => $file
        ) {

            $imageUrl =
                $this->cloudinaryService
                    ->upload(
                        $file,
                        'SistemaViajes/Forum'
                    );

            Image::create([
                'entity_type' => 'Forum',
                'entity_id' => $forum->forum_id,
                'image_path' => $imageUrl,
                'is_primary' => $index === 0,
            ]);
        }

    }

        return redirect()
            ->route('forum.index')
            ->with('success', 'Tema creado correctamente.');
    }

    public function show($forum_id)
    {
        $forum = Forum::with([
            'user',
            'participations.user',
            'images'
        ])->findOrFail($forum_id);

        return view('forum.show', compact('forum'));
    }

    public function myForums()
    {
        $forums = Forum::with('user')
            ->where('user_id', Auth::user()->user_id)
            ->latest()
            ->get();

        return view('forum.my-forums', compact('forums'));
    }

    public function destroy($forum_id)
    {
        $forum = Forum::findOrFail($forum_id);

        if ($forum->user_id != Auth::user()->user_id) {
            abort(403);
        }

        $forum->delete();

        return redirect()
            ->route('forum.myForums')
            ->with('success', 'Foro eliminado correctamente.');
    }
   
    protected CloudinaryService $cloudinaryService;

    public function __construct(
        CloudinaryService $cloudinaryService
    ) {
        $this->cloudinaryService = $cloudinaryService;
    }
}
