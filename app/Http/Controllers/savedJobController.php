<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class savedJobController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;
        return view('account.saved-job', compact('posts'));
    }
    public function store($id)
    {
        if (! auth()->user()->hasRole('user')) {
            Alert::toast('Only job seekers can save jobs.', 'error');
            return redirect()->back();
        }

        Post::findOrFail($id);

        $user = User::find(auth()->user()->id);
        $hasPost = $user->posts()->where('posts.id', $id)->exists();
        //check if the post is already saved
        if ($hasPost) {
            Alert::toast('You already have saved this job!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Job successfully saved!', 'success');
            $user->posts()->syncWithoutDetaching([$id]);
            return redirect()->route('savedJob.index');
        }
    }
    public function destroy($id)
    {
        $user = User::find(auth()->user()->id);
        $user->posts()->detach($id);
        Alert::toast('Deleted Saved job!', 'success');
        return redirect()->route('savedJob.index');
    }
}
