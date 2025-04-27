<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BioProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BioProfilController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\SportController;
use App\Http\Controllers\UsersSportsController;
use App\Models\Post;
use App\Models\Sport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ------------------------ Routes: Guest ------------------------

// login page
Route::get('/', function () {
    return view('auth/login');
});

// ------------------------ Routes: Dashboard ------------------------
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return view('auth/login');

    $userSports = $user->sports->pluck('id');

    // get user sports + posts
    $posts = Post::whereIn('sport_id', $userSports)->orderBy('created_at', 'desc')->get();
    $sports = Sport::whereIn('id', $userSports)->get();

    return view('dashboard', compact('posts', 'sports'));
})->middleware(['auth', 'verified'])->name('dashboard');


// ------------------------ Routes: Profile ------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ------------------------ Routes: Admin ------------------------
// Source I used for admin middleware: https://www.youtube.com/watch?v=b-qEj11h7as&t=1225s
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('deletePostAdmin');
    Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEvent'])->name('deleteEventAdmin');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('deleteUserAdmin');
});


// ------------------------ Routes: Auth (package) ------------------------
require __DIR__.'/auth.php';


// ------------------------ Routes: Account & Profile Extension ------------------------
Route::get('/account/setting', [SettingController::class, 'moreSetting'])->name('moreSetting');
Route::get('/account/{id?}', [AccountController::class, 'show'])->name('account.show');


// follow / unfollow system
Route::post('/account/{id}/follow', [AccountController::class, 'follow'])->name('account.follow');
Route::post('/account/{id}/unfollow', [AccountController::class, 'unfollow'])->name('account.unfollow');

// follow lists
Route::get('/followers/{id}', [FollowController::class, 'showFollowers'])->name('showFollowers');
Route::get('/following/{id}', [FollowController::class, 'showFollowing'])->name('showFollowing');

// profile photo
Route::post('/profile/photo', [BioProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
Route::delete('/profile/photo', [BioProfileController::class, 'deleteProfilePhoto'])->name('profile.deletePhoto');
// bio update
Route::post('/profile/updateBio', [BioProfilController::class, 'updateBio'])->name('profile.updateBio');


// ------------------------ Routes: Posts ------------------------
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'deletePost'])->name('deletePost');


// ------------------------ Routes: Sports ------------------------
Route::get('/bluesport', [SportController::class, 'showSport'])->name('bluesport');
Route::post('/bluesport/add-sport', [UsersSportsController::class, 'addSport'])->name('addSport');
Route::post('/bluesport/delete-sport', [UsersSportsController::class, 'deleteSport'])->name('deleteSport');


// ------------------------ Routes: Events ------------------------
Route::get('/bluevent', [EventController::class, 'showEvent'])->name('blueevent');
Route::get('/myEvents', [EventController::class, 'myEvents'])->name('myEvents');
Route::get('/myEvents/{event}', [EventController::class, 'viewMore'])->name('viewMore');

Route::post('/bluevent/{event}', [EventController::class, 'joinEvent'])->name('joinEvent');
Route::delete('/leaveEvent/{event}', [EventController::class, 'leaveEvent'])->name('leaveEvent');
Route::post('/bluevent', [EventController::class, 'addEvent'])->name('addEvent');
Route::get('/myEvents/delete/{event}', [EventController::class, 'deleteEvent'])->name('deleteEvent');

// kick user from event
Route::delete('/removeUser/{event}/{user}', [EventController::class, 'removeUser'])->name('removeUser');


// ------------------------ Routes: Results ------------------------
Route::get('/blueresult', [ResultController::class, 'index'])->name('blueresult');


// ------------------------ Routes: Search ------------------------
Route::get('/search', [SearchController::class, 'search'])->name('search');
