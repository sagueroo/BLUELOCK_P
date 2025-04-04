<?php

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



require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);
Route::get('/account', [AccountController::class, 'show'])->name('account.show');
Route::get('/account/setting', [SettingController::class, 'show'])->name('setting.show');
Route::post('/profile/updateBio', [BioProfilController::class, 'updateBio'])->name('profile.updateBio');

Route::post('/profile/photo', [BioProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
Route::delete('/profile/photo', [BioProfileController::class, 'deleteProfilePhoto'])->name('profile.deletePhoto');

//Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');

//Pour les post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/', [PostController::class, 'index'])->name('home');

//Pour voir et s'inscrire dans un sport
Route::get('/bluesport', [SportController::class, 'showSport'])->name('showSport');
Route::post('/bluesport/add-sport', [UsersSportsController::class, 'addSport'])->name('addSport');
Route::post('/bluesport/delete-sport', [UsersSportsController::class, 'deleteSport'])->name('deleteSport');

//Voir et rejoindre les evenements

Route::get('/bluevent', [EventController::class, 'showEvent'])->name('showEvent');
Route::get('/myEvents', [EventController::class, 'myEvents'])->name('myEvents');
Route::get('/myEvents/{event}', [EventController::class, 'viewMore'])->name('viewMore');
Route::post('/bluevent/{event}', [EventController::class, 'joinEvent'])->name('joinEvent');
Route::delete('/removeUser/{user}', [EventController::class, 'removeUser'])->name('removeUser');


//Resultats des matchs de foot
Route::get('/blueresult', [ResultController::class, 'index'])->name('blueresult');
