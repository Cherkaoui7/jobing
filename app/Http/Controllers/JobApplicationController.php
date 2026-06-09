<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applicationsWithPostAndUser = null;
        $company = auth()->user()->company;

        if ($company) {
            $ids =  $company->posts()->pluck('id');
            $applications = JobApplication::whereIn('post_id', $ids);
            $applicationsWithPostAndUser = $applications->with('user', 'post')->latest()->paginate(10);
        }

        return view('job-application.index')->with([
            'applications' => $applicationsWithPostAndUser,
        ]);
    }
    public function show($id)
    {
        $application = $this->ownedApplication($id);

        $post = $application->post;
        $userId = $application->user_id;
        $applicant = User::find($userId);

        $company = $post->company;
        return view('job-application.show')->with([
            'applicant' => $applicant,
            'post' => $post,
            'company' => $company,
            'application' => $application
        ]);
    }
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'application_id' => ['required', 'exists:job_applications,id'],
        ]);

        $application = $this->ownedApplication($validated['application_id']);
        $cv = $application->cv;
        $application->delete();

        if ($cv && Storage::exists($cv)) {
            Storage::delete($cv);
        }

        Alert::toast('Application deleted.', 'warning');
        return redirect()->route('jobApplication.index');
    }

    public function downloadCv($id)
    {
        $application = $this->ownedApplication($id);

        if (! $application->cv || ! Storage::exists($application->cv)) {
            abort(404);
        }

        return Storage::download(
            $application->cv,
            str($application->user->name)->slug() . '-application-cv.' . pathinfo($application->cv, PATHINFO_EXTENSION)
        );
    }

    protected function ownedApplication($id): JobApplication
    {
        $company = auth()->user()->company;

        abort_unless($company, 403);

        $postIds = $company->posts()->pluck('id');

        return JobApplication::with('user', 'post.company')
            ->whereIn('post_id', $postIds)
            ->findOrFail($id);
    }
}
