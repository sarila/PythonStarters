

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Index Page
Route::get('/', 'FrontEndController@index')->name('index');
// Category News
Route::get('/category/{slug}', 'FrontEndController@categoryNews')->name('categoryNews');
// Write News
Route::get('/add/news', 'FrontEndController@writeNews')->name('writeNews');
// Janata News
Route::get('/janata-news', 'FrontEndController@janataNews')->name('janataNews');
// User Login
Route::get('/user/login', 'FrontEndController@userLogin')->name('userLogin');
// User Register
Route::get('/user/register', 'FrontEndController@userRegister')->name('userRegister');
// Videos Gallery
Route::get('/videos/gallery', 'FrontEndController@videos')->name('videos');
// Pradesh News
Route::get('/pradesh/{slug}', 'FrontEndController@pradeshNews')->name('pradeshNews');
// Featured News
Route::get('/featured/news', 'FrontEndController@featuredNews')->name('featuredNews');
// News Single
Route::get('/news/{slug}', 'FrontEndController@newsSingle')->name('newsSingle');

// Janata Ko Samachar Single
Route::get('/news/janata/{slug}', 'FrontEndController@newsSingleJanata')->name('newsSingleJanata');

//Like the news
Route::post('/like', 'PostController@likePost')->name('like');
//Like Janata News
Route::post('/like-janatanews', 'JanataNewsController@likePost')->name('likeJanata');




// Register User
Route::post('/register/user', 'UserController@registerUser')->name('registerUser');
//Login User
Route::post('/user/login', 'UserController@login_user')->name('login_user');
// Confirm
Route::get('/confirm/{code}', 'UserController@confirmAccount');


// Newsletter
Route::post('/check-subscriber-email', 'NewsletterController@checkSubscriber')->name('checkSubscriber');
Route::post('/add-subscriber-email', 'NewsletterController@addSubscriber')->name('addSubscriber');


Route::group(['middleware' => ['frontLogin']], function(){
    // User Dashboard
    Route::get('/user/dashboard', 'UserController@userDashboard')->name('userDashboard');
    // User Profile
    Route::get('/user/profile', 'UserController@userProfile')->name('userProfile');
    // Edit Profile
    Route::get('/user/profile/edit', 'UserController@userProfileEdit')->name('userProfileEdit');
    // User Profile Update
    Route::post('/user/profile/update/{id}', 'UserController@userProfileUpdate')->name('userProfileUpdate');
    // Change Password
    Route::get('/user/profile/password', 'UserController@userChangePassword')->name('userChangePassword');
    // Update Password
    Route::post('/user/profile/password/{id}', 'UserController@userUpdatePassword')->name('userUpdatePassword');

    // News
    Route::get('/user/news', 'UserController@userNews')->name('userNews');
    Route::get('/user/news/create', 'UserController@addNews')->name('addNews');
    Route::post('/user/news/store', 'UserController@storeNews')->name('storeNews');
    Route::get('/user/news/edit/{id}', 'UserController@editNews')->name('editNews');
    Route::post('/user/news/update/{id}', 'UserController@updateNews')->name('updateNews');
    Route::get('/delete-janata/{id}', 'UserController@deleteJanataImage')->name('deleteJanataImage');
    Route::get('/delete-janatavideo/{id}', 'UserController@deleteJanataVideo')->name('deleteJanataVideo');
    Route::get('/delete-janatanews/{id}', 'UserController@deleteJanataNews')->name('deleteJanataNews');


    Route::get('/user/news/gallery/{id}', 'UserController@janatanewsGallery')->name('janatanewsGallery');
    Route::post('/user/news/gallery/store/{id}', 'UserController@janatanewsStoreGallery')->name('janatanewsStoreGallery');
    Route::post('/user/image/delete', 'UserController@deleteJanataGalleryImage')->name('deleteJanataGalleryImage');
    Route::get('/user/image-delete/{id}', 'UserController@deleteJanataImageIndividual')->name('deleteJanataImageIndividual');

});


Route::get('/user/front/logout', 'UserController@userLogout')->name('userLogout');






Route::prefix('/admin')->group(function(){
    // Admin Login
    Route::match(['get', 'post'],'/login', 'AdminLoginController@login')->name('adminLogin');
    Route::group(['middleware' => ['admin']], function (){
        // Admin Dashboard
        Route::get('/dashboard', 'AdminLoginController@dashboard')->name('adminDashboard');
        // Admin ProfileAd
        Route::get('/profile', 'AdminProfileController@profile')->name('profile');
        // Admin Update
        Route::post('/profile/update/{id}', 'AdminProfileController@updateProfile')->name('updateProfile');
        // Change password
        Route::get('/profile/change_password', 'AdminProfileController@changePassword')->name('changePassword');
        // Check Current Password
        Route::post('/profile/check-password', 'AdminProfileController@chkUserPassword')->name('chkUserPassword');
        // Update Admin Password
        Route::post('/profile/update_password/{id}', 'AdminProfileController@updatePassword')->name('updatePassword');

        // Theme Settings
        Route::get('/theme', 'ThemeController@theme')->name('theme');
        Route::post('/theme/{id}', 'ThemeController@themeUpdate')->name('themeUpdate');
        // Social Media Management
        Route::get('/social', 'SocialMediaController@social')->name('social');
        Route::post('/social/update/{id}', 'SocialMediaController@socialUpdate')->name('socialUpdate');

        // Category Controller
        Route::get('/category', 'CategoryController@index')->name('category.index');
        Route::get('/category/add', 'CategoryController@add')->name('category.add');
        Route::post('/category/add', 'CategoryController@store')->name('category.store');
        Route::get('/table/category', 'CategoryController@dataTable')->name('table.category');
        Route::get('/category/show/{id}', 'CategoryController@show')->name('category.show');
        Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/category/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('/delete-category/{id}', 'CategoryController@destroy')->name('category.destroy');

        // Post
        Route::get('/post', 'PostController@index')->name('post.index');
        Route::get('/post/featured/', 'PostController@featured')->name('post.featured');
        Route::get('/post/add', 'PostController@add')->name('post.add');
        Route::post('/post/add', 'PostController@store')->name('post.store');
        Route::get('/table/post', 'PostController@dataTable')->name('table.post');
        Route::get('/table/featured', 'PostController@featuredPost')->name('featured.post');
        Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
        Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
        Route::post('/post/update/{id}', 'PostController@update')->name('post.update');
        Route::get('/delete-news/{id}', 'PostController@destroy')->name('post.destroy');
        Route::get('/delete-newsimage/{id}', 'PostController@deleteNewsImage')->name('deleteNewsImage');

        Route::get('/post/gallery/{id}', 'PostController@newsGallery')->name('newsGallery');
        Route::post('/post/gallery/store/{id}', 'PostController@newsStoreGallery')->name('newsStoreGallery');
        Route::post('/image/delete', 'PostController@deleteImage')->name('deleteImage');
        Route::get('/image-delete/{id}', 'PostController@deleteImageIndividual')->name('deleteImageIndividual');




        Route::get('/post/janata', 'JanataNewsController@index')->name('janata.index');
        Route::get('/table/janata', 'JanataNewsController@dataTable')->name('table.janata');
        Route::get('/post/janata/show/{id}', 'JanataNewsController@show')->name('janata.show');
        Route::get('/post/janata/edit/{id}', 'JanataNewsController@edit')->name('janata.edit');
        Route::post('/post/janata/update/{id}', 'JanataNewsController@update')->name('janata.update');
        Route::get('/delete-janatanews/{id}', 'JanataNewsController@destroy')->name('janata.destroy');




        // User Management
        Route::get('/users', 'AdminUserController@users')->name('users');
        Route::get('/table/user', 'AdminUserController@dataTable')->name('table.user');
        Route::get('/user/add/', 'AdminUserController@add')->name('user.add');
        Route::post('/user/store/', 'AdminUserController@store')->name('user.store');
        Route::get('/user/edit/{id}', 'AdminUserController@edit')->name('user.edit');
        Route::post('/user/update/{id}', 'AdminUserController@update')->name('user.update');
        Route::get('/delete-user/{id}', 'AdminUserController@destroy')->name('user.destroy');

        //Videos
        Route::resource('/videos', VideoController::class);
        Route::get('/table/videos', 'VideoController@dataTable')->name('table.videos');


        //Ads
        Route::resource('/posters', PosterController::class);
        Route::get('/table/posters', 'PosterController@dataTable')->name('table.posters');

    });
    // Admin Logout
    Route::get('/logout', 'AdminLoginController@adminLogout')->name('adminLogout');

    Route::post('ckeditor', 'CkeditorFileUploadController@store')->name('ckeditor.store');

});

