<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('account.user-account');
    }

    public function becomeEmployerView()
    {
        return view('account.become-employer');
    }

    public function becomeEmployer()
    {
        $user = User::find(auth()->user()->id);
        $user->removeRole('user');
        $user->assignRole('author');
        return redirect()->route('account.authorSection');
    }

    public function applyJobView(Request $request)
    {
        $validated = $request->validate([
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        $post = Post::findOrFail($validated['post_id']);

        if (! auth()->user()->hasRole('user')) {
            Alert::toast('Employers cannot apply for jobs.', 'error');
            return redirect()->route('post.show', ['job' => $post->id]);
        }

        if ($this->hasApplied(auth()->user(), $post->id)) {
            Alert::toast('You have already applied for this job!', 'success');
            return redirect()->route('post.show', ['job' => $post->id]);
        }

        $company = $post->company()->first();
        return view('account.apply-job', compact('post', 'company'));
    }

    public function applyJob(Request $request)
{
    $validated = $request->validate([
        'post_id' => ['required', 'exists:posts,id'],
        'cv' => ['required', 'mimes:pdf,doc,docx', 'max:2048'],
    ]);

    $user = User::find(auth()->user()->id);
    $post = Post::findOrFail($validated['post_id']);

    if (! $user->hasRole('user')) {
        Alert::toast('Employers cannot apply for jobs.', 'error');
        return redirect()->route('post.show', ['job' => $post->id]);
    }

    if ($this->hasApplied($user, $post->id)) {
        Alert::toast('You have already applied for this job!', 'success');
        return redirect()->route('post.show', ['job' => $post->id]);
    }

    $cvPath = $request->file('cv')->store('job-applications/cv');

    $application = new JobApplication;
    $application->user_id = auth()->user()->id;
    $application->post_id = $post->id;
    $application->cv = $cvPath;

    $application->save();

    Alert::toast('Application sent successfully!', 'success');

    return redirect()->route('post.show', ['job' => $post->id]);
}

    public function changePasswordView()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'success');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed'
        ]);

        $authUser = auth()->user();
        $currentP = $request->current_password;
        $newP = $request->new_password;

        if (Hash::check($currentP, $authUser->password)) {
            $user = User::find($authUser->id);
            $user->password = Hash::make($newP);
            if ($user->save()) {
                Alert::toast('Password Changed!', 'success');
                return redirect()->route('account.index');
            } else {
                Alert::toast('Something went wrong!', 'warning');
            }
        } else {
            Alert::toast('Incorrect Password!', 'info');
        }
        return redirect()->back();
    }

    public function deactivateView()
    {
        return view('account.deactivate');
    }

    public function deleteAccount()
    {
        $user = User::find(auth()->user()->id);
        Auth::logout();
        if ($user->delete()) {
            Alert::toast('Your account was deleted successfully!', 'info');
            return redirect(route('post.index'));
        } else {
            return view('account.deactivate');
        }
    }
public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|max:255',
        'phone' => 'nullable|max:255',
        'city' => 'nullable|max:255',
        'bio' => 'nullable',
        'skills' => 'nullable',
        'linkedin' => 'nullable',
        'github' => 'nullable',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'cv' => 'nullable|mimes:pdf,doc,docx|max:2048'
    ]);

    // upload image
    if ($request->hasFile('image')) {

        $imageName = time().'_'.$request->image->getClientOriginalName();

        $request->image->move(public_path('uploads/profile'), $imageName);

        $user->image = 'uploads/profile/'.$imageName;
    }

    // upload cv
    if ($request->hasFile('cv')) {
        $this->deleteStoredCv($user->cv);
        $user->cv = $request->file('cv')->store('profile-cvs');
    }

    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->city = $request->city;
    $user->bio = $request->bio;
    $user->skills = $request->skills;
    $user->linkedin = $request->linkedin;
    $user->github = $request->github;

    $user->save();

    Alert::toast('Profile updated successfully!', 'success');

    return redirect()->back();
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function hasApplied($user, $postId)
    {
        return $user->applied()->where('post_id', $postId)->exists();
    }

    public function downloadCv()
    {
        $user = auth()->user();

        return $this->downloadStoredCv($user->cv, Str::slug($user->name) . '-cv');
    }

    protected function downloadStoredCv(?string $path, string $downloadName)
    {
        if (! $path) {
            abort(404);
        }

        if (Storage::exists($path)) {
            return Storage::download($path, $downloadName . '.' . pathinfo($path, PATHINFO_EXTENSION));
        }

        $legacyPath = public_path($path);
        if (file_exists($legacyPath)) {
            return response()->download($legacyPath, basename($legacyPath));
        }

        abort(404);
    }

    protected function deleteStoredCv(?string $path): void
    {
        if ($path && Storage::exists($path)) {
            Storage::delete($path);
        }
    }
    public function cvBuilder()
{
    return view('account.cv-builder');
}

public function generateCV(Request $request)
{
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'skills' => $request->skills,
        'experience' => $request->experience,
        'education' => $request->education,
        'bio' => $request->bio,
    ];

    $pdf = Pdf::loadView('account.cv-pdf', $data);

    return $pdf->download('careerhub-cv.pdf');
}

public function resumeAnalyzer()
{
    return view('account.resume-analyzer');
}

public function analyzeResume(Request $request)
{
    $request->validate([
        'cv' => 'required|mimes:pdf,txt|max:2048'
    ]);

    $file = $request->file('cv');

    // استخراج النص من PDF
    if ($file->getClientOriginalExtension() == 'pdf') {

        $parser = new \Smalot\PdfParser\Parser();

        $pdf = $parser->parseFile($file->getRealPath());

        $content = strtolower($pdf->getText());

    } else {

        $content = strtolower(file_get_contents($file->getRealPath()));
    }

    // Skills database
    $skills = [
        'php',
        'laravel',
        'mysql',
        'javascript',
        'vue',
        'react',
        'html',
        'css',
        'bootstrap',
        'tailwind',
        'git',
        'github',
        'api',
        'docker',
        'python',
        'java',
        'c++',
        'nodejs'
    ];

    $detectedSkills = [];
    $missingSkills = [];

    foreach ($skills as $skill) {

        if (str_contains($content, $skill)) {

            $detectedSkills[] = $skill;

        } else {

            $missingSkills[] = $skill;
        }
    }

    // ATS Score
    $score = count($detectedSkills) * 5;

    if ($score > 100) {
        $score = 100;
    }

    // Recommendations
    $recommendations = [];

    if (!in_array('docker', $detectedSkills)) {
        $recommendations[] = 'Learn Docker and deployment.';
    }

    if (!in_array('react', $detectedSkills)) {
        $recommendations[] = 'Add modern frontend framework skills.';
    }

    if (!in_array('api', $detectedSkills)) {
        $recommendations[] = 'Mention API development experience.';
    }

    return view('account.resume-result', compact(
        'score',
        'detectedSkills',
        'missingSkills',
        'recommendations'
    ));
}
}
