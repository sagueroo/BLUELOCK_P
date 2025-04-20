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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) {
        return view('auth/login');
    }
    $userSports = $user->sports->pluck('id');
    // Récupère tous les posts
    $posts = Post::whereIn('sport_id', $userSports)->orderBy('created_at', 'desc')->get();
    $sports = Sport::whereIn('id', $userSports)->get();
    return view('dashboard',compact('posts','sports'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//------------------------Route Admin---------------------------
//Source utilisé pour réaliser le middleware : https://www.youtube.com/watch?v=b-qEj11h7as&t=1225s
Route::get('admin/dashboard',[AdminController::class,'dashboard'])->middleware(['auth','admin'])->name('admin.dashboard');
Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('deletePostAdmin')->middleware(['auth', 'admin']);
Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEvent'])->name('deleteEventAdmin')->middleware(['auth', 'admin']);
Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('deleteUserAdmin')->middleware(['auth', 'admin']);




require __DIR__.'/auth.php';


Route::get('/account/{id?}', [AccountController::class, 'show'])->name('account.show');
Route::get('/account/setting', [SettingController::class, 'moreSetting'])->name('moreSetting');
Route::post('/profile/updateBio', [BioProfilController::class, 'updateBio'])->name('profile.updateBio');
Route::post('/account/{id}/follow', [AccountController::class, 'follow'])->name('account.follow');
Route::post('/account/{id}/unfollow', [AccountController::class, 'unfollow'])->name('account.unfollow');
Route::get('/followers/{id}', [FollowController::class, 'showFollowers'])->name('showFollowers');
Route::get('/following/{id}', [FollowController::class, 'showFollowing'])->name('showFollowing');



Route::post('/profile/photo', [BioProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
Route::delete('/profile/photo', [BioProfileController::class, 'deleteProfilePhoto'])->name('profile.deletePhoto');

//Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');

//------------------------Route Post---------------------------
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/', [PostController::class, 'index'])->name('home');
Route::delete('/posts/{post}', [PostController::class, 'deletePost'])->name('deletePost');

//------------------------Route Sport---------------------------
Route::get('/bluesport', [SportController::class, 'showSport'])->name('bluesport');
Route::post('/bluesport/add-sport', [UsersSportsController::class, 'addSport'])->name('addSport');
Route::post('/bluesport/delete-sport', [UsersSportsController::class, 'deleteSport'])->name('deleteSport');

//------------------------Route Event---------------------------

Route::get('/bluevent', [EventController::class, 'showEvent'])->name('blueevent');
Route::get('/myEvents', [EventController::class, 'myEvents'])->name('myEvents');
Route::get('/myEvents/{event}', [EventController::class, 'viewMore'])->name('viewMore');
Route::post('/bluevent/{event}', [EventController::class, 'joinEvent'])->name('joinEvent');
Route::delete('/leaveEvent/{event}', [EventController::class, 'leaveEvent'])->name('leaveEvent');
Route::post('/bluevent', [EventController::class, 'addEvent'])->name('addEvent');
Route::get('/myEvents/delete/{event}', [EventController::class, 'deleteEvent'])->name('deleteEvent');

Route::delete('/removeUser/{event}/{user}', [EventController::class, 'removeUser'])->name('removeUser');


//------------------------Route Result---------------------------
Route::get('/blueresult', [ResultController::class, 'index'])->name('blueresult');


// web.php
Route::get('/search', [SearchController::class, 'index'])->name('search');
