<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthorController;
use App\Http\Controllers\CompanyCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\savedJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('/set-database', function (Request $request) {
    $validated = $request->validate([
        'db_connection' => ['required', 'in:mysql,sqlite'],
    ]);

    $db = $validated['db_connection'];

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    session(['db_connection' => $db]);

    if ($db === 'sqlite') {
        $path = database_path('database.sqlite');

        if (! file_exists($path)) {
            touch($path);
        }
    }

    return back();
})->name('set-database');

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/job/{job}', [PostController::class, 'show'])->name('post.show');
Route::get('employer/{employer}', [AuthorController::class, 'employer'])->name('account.employer');

//return vue page
Route::get('/search', [JobController::class, 'index'])->name('job.index');

Route::get('/companies', [CompanyController::class, 'index'])->name('company.index');

//auth routes
Route::middleware('auth')->prefix('account')->group(function () {
  //every auth routes AccountController
  Route::post('logout', [AccountController::class, 'logout'])->name('account.logout');
  Route::get('overview', [AccountController::class, 'index'])->name('account.index');
  Route::get('deactivate', [AccountController::class, 'deactivateView'])->name('account.deactivate');
  Route::get('change-password', [AccountController::class, 'changePasswordView'])->name('account.changePassword');
  Route::delete('delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
  Route::put('change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');
  Route::get('cv/download', [AccountController::class, 'downloadCv'])->name('account.downloadCv');
  //savedJobs
  Route::get('my-saved-jobs', [savedJobController::class, 'index'])->name('savedJob.index');
  Route::post('my-saved-jobs/{id}', [savedJobController::class, 'store'])->name('savedJob.store');
  Route::delete('my-saved-jobs/{id}', [savedJobController::class, 'destroy'])->name('savedJob.destroy');
  //applyjobs
  Route::get('apply-job', [AccountController::class, 'applyJobView'])->name('account.applyJob');
  Route::post('apply-job', [AccountController::class, 'applyJob'])->name('account.applyJob');
  Route::put('update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');


  Route::get('cv-builder', [AccountController::class, 'cvBuilder'])->name('account.cvBuilder');

Route::post('generate-cv', [AccountController::class, 'generateCV'])->name('account.generateCV');

Route::get('resume-analyzer', [AccountController::class, 'resumeAnalyzer'])->name('account.resumeAnalyzer');

Route::post('analyze-resume', [AccountController::class, 'analyzeResume'])->name('account.analyzeResume');

  //Admin Role Routes
  Route::group(['middleware' => ['role:admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('account.dashboard');
    Route::get('view-all-users', [AdminController::class, 'viewAllUsers'])->name('account.viewAllUsers');
    Route::delete('view-all-users', [AdminController::class, 'destroyUser'])->name('account.destroyUser');

    Route::get('category/{category}/edit', [CompanyCategoryController::class, 'edit'])->name('category.edit');
    Route::post('category', [CompanyCategoryController::class, 'store'])->name('category.store');
    Route::put('category/{id}', [CompanyCategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CompanyCategoryController::class, 'destroy'])->name('category.destroy');
  });

  //Author Role Routes
  Route::group(['middleware' => ['role:author']], function () {
    Route::get('author-section', [AuthorController::class, 'authorSection'])->name('account.authorSection');

    Route::get('job-application/{id}', [JobApplicationController::class, 'show'])->name('jobApplication.show');
    Route::get('job-application/{id}/cv', [JobApplicationController::class, 'downloadCv'])->name('jobApplication.downloadCv');
    Route::delete('job-application', [JobApplicationController::class, 'destroy'])->name('jobApplication.destroy');
    Route::get('job-application', [JobApplicationController::class, 'index'])->name('jobApplication.index');

    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::put('company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('company/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::delete('company', [CompanyController::class, 'destroy'])->name('company.destroy');
  });

  //User Role routes
  Route::group(['middleware' => ['role:user']], function () {
    Route::get('become-employer', [AccountController::class, 'becomeEmployerView'])->name('account.becomeEmployer');
    Route::post('become-employer', [AccountController::class, 'becomeEmployer'])->name('account.becomeEmployer');
  });
});
