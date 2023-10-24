<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MaintananceController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RatingCommentController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\WebsitesController;
use App\Http\Controllers\Admin\WingController;
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

// Route::get('/', function () {
//     return view('admin.dashboard.index');
// });


Route::get('/', function () {
	return redirect('/admin/dashboard');
});

// Route::get('/', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('logout', [AdminAuthController::class, 'logout'])->name('adminLogout');

Route::group(['prefix' => '','middleware' => 'adminAuth'], function () {
	// Admin Dashboard
	Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

	/**
	 * Blog Management
	 */
		Route::group(['prefix' => 'category'], function(){
			Route::get('/', [CategoriesController::class, 'index'])->name('admin.category');
			Route::get('/create', [CategoriesController::class, 'create'])->name('admin.category.create');
			Route::post('/store', [CategoriesController::class, 'store'])->name('admin.category.store');
			Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.category.edit');
			Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('admin.category.update');
			Route::delete('/delete/{id}', [CategoriesController::class, 'destroy'])->name('admin.category.delete');
		});

		Route::group(['prefix' => 'subcategory'], function(){
			Route::get('/', [SubCategoriesController::class, 'index'])->name('admin.subcategory');
			Route::get('/create', [SubCategoriesController::class, 'create'])->name('admin.subcategory.create');
			Route::post('/store', [SubCategoriesController::class, 'store'])->name('admin.subcategory.store');
			Route::get('/edit/{id}', [SubCategoriesController::class, 'edit'])->name('admin.subcategory.edit');
			Route::post('/update/{id}', [SubCategoriesController::class, 'update'])->name('admin.subcategory.update');
			Route::delete('/delete/{id}', [SubCategoriesController::class, 'destroy'])->name('admin.subcategory.delete');
		});

		Route::group(['prefix' => 'tags'], function(){
			Route::get('/', [TagsController::class, 'index'])->name('admin.tags');
			Route::get('/create', [TagsController::class, 'create'])->name('admin.tags.create');
			Route::post('/store', [TagsController::class, 'store'])->name('admin.tags.store');
			Route::get('/edit/{id}', [TagsController::class, 'edit'])->name('admin.tags.edit');
			Route::post('/update/{id}', [TagsController::class, 'update'])->name('admin.tags.update');
			Route::delete('/delete/{id}', [TagsController::class, 'destroy'])->name('admin.tags.delete');
		});

		Route::group(['prefix' => 'blogs'], function(){
			Route::get('/', [BlogsController::class, 'index'])->name('admin.blogs');
			Route::get('/create', [BlogsController::class, 'create'])->name('admin.blogs.create');
			Route::post('/store', [BlogsController::class, 'store'])->name('admin.blogs.store');
			Route::get('/edit/{id}', [BlogsController::class, 'edit'])->name('admin.blogs.edit');
			Route::post('/update/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
			Route::delete('/delete/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.delete');
		});

		Route::group(['prefix' => 'blog-comments'], function(){
			Route::get('/', [BlogCommentController::class, 'index'])->name('admin.blog-comments');
			Route::get('/create', [BlogCommentController::class, 'create'])->name('admin.blog-comments.create');
			Route::post('/store', [BlogCommentController::class, 'store'])->name('admin.blog-comments.store');
			Route::get('/reply/{id}', [BlogCommentController::class, 'edit'])->name('admin.blog-comments.edit');
			Route::post('/update/{id}', [BlogCommentController::class, 'update'])->name('admin.blog-comments.update');
			Route::post('/reply/{id}', [BlogCommentController::class, 'reply'])->name('admin.blog-comments.reply');
			Route::delete('/delete/{id}', [BlogCommentController::class, 'destroy'])->name('admin.blog-comments.delete');
		});

		Route::group(['prefix' => 'sliders'], function(){
			Route::get('/', [SlidersController::class, 'index'])->name('admin.sliders');
			Route::get('/create', [SlidersController::class, 'create'])->name('admin.sliders.create');
			Route::post('/store', [SlidersController::class, 'store'])->name('admin.sliders.store');
			Route::get('/edit/{id}', [SlidersController::class, 'edit'])->name('admin.sliders.edit');
			Route::post('/update/{id}', [SlidersController::class, 'update'])->name('admin.sliders.update');
			Route::delete('/delete/{id}', [SlidersController::class, 'destroy'])->name('admin.sliders.delete');
		});

	/**
	 * User Management
	 */
		Route::group(['prefix' => 'user'], function(){
			Route::get('/', [UserController::class, 'index'])->name('admin.user');
			Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
			Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
			Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
			Route::get('/view/{id}', [UserController::class, 'show'])->name('admin.user.view');
			Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
			Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
		});

		Route::group(['prefix' => 'role'], function(){
			Route::get('/', [RoleController::class, 'index'])->name('admin.role');
			Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
			Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
			Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
			Route::post('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
			Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.delete');
		});

		Route::group(['prefix' => 'rating-comment'], function(){
			Route::get('/', [RatingCommentController::class, 'index'])->name('admin.rating-comment');
			Route::get('/create', [RatingCommentController::class, 'create'])->name('admin.rating-comment.create');
			Route::post('/store', [RatingCommentController::class, 'store'])->name('admin.rating-comment.store');
			Route::get('/edit/{id}', [RatingCommentController::class, 'edit'])->name('admin.rating-comment.edit');
			Route::post('/update/{id}', [RatingCommentController::class, 'update'])->name('admin.rating-comment.update');
			Route::delete('/delete/{id}', [RatingCommentController::class, 'destroy'])->name('admin.rating-comment.delete');
		});
	
		Route::group(['prefix' => 'customer'], function(){
			Route::get('/', [CustomerController::class, 'index'])->name('admin.customer');
			Route::get('/create', [CustomerController::class, 'create'])->name('admin.customer.create');
			Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
			Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
			Route::get('/view/{id}', [CustomerController::class, 'show'])->name('admin.customer.view');
			Route::get('/customer-payment-history/{id}', [CustomerController::class, 'customerPlanHistory'])->name('admin.customer-payment-history.view');
			Route::post('/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
			Route::delete('/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.delete');
		});

	/**
	 * Setting Management
	 */
		Route::group(['prefix' => 'menu'], function(){
			Route::get('/', [AdminMenuController::class, 'index'])->name('admin.menu');
			Route::get('/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
			Route::post('/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
			Route::get('/edit/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
			Route::post('/update/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
			Route::delete('/delete/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.delete');
		});

		Route::group(['prefix' => 'website'], function(){
			Route::get('/', [WebsitesController::class, 'index'])->name('admin.website');
			Route::get('/create', [WebsitesController::class, 'create'])->name('admin.website.create');
			Route::post('/store', [WebsitesController::class, 'store'])->name('admin.website.store');
			Route::get('/edit/{id}', [WebsitesController::class, 'edit'])->name('admin.website.edit');
			Route::post('/update/{id}', [WebsitesController::class, 'update'])->name('admin.website.update');
			Route::delete('/delete/{id}', [WebsitesController::class, 'destroy'])->name('admin.website.delete');
		});

		Route::group(['prefix' => 'country'], function(){
			Route::get('/', [CountryController::class, 'index'])->name('admin.country');
			Route::get('/create', [CountryController::class, 'create'])->name('admin.country.create');
			Route::post('/store', [CountryController::class, 'store'])->name('admin.country.store');
			Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('admin.country.edit');
			Route::post('/update/{id}', [CountryController::class, 'update'])->name('admin.country.update');
			Route::delete('/delete/{id}', [CountryController::class, 'destroy'])->name('admin.country.delete');
		});

		Route::group(['prefix' => 'language'], function(){
			Route::get('/', [LanguageController::class, 'index'])->name('admin.language');
			Route::get('/create', [LanguageController::class, 'create'])->name('admin.language.create');
			Route::post('/store', [LanguageController::class, 'store'])->name('admin.language.store');
			Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('admin.language.edit');
			Route::post('/update/{id}', [LanguageController::class, 'update'])->name('admin.language.update');
			Route::delete('/delete/{id}', [LanguageController::class, 'destroy'])->name('admin.language.delete');
		});

		Route::group(['prefix' => 'notification'], function(){
			Route::get('/', [NotificationController::class, 'index'])->name('admin.notification');
			Route::get('/create', [NotificationController::class, 'create'])->name('admin.notification.create');
			Route::post('/store', [NotificationController::class, 'store'])->name('admin.notification.store');
			Route::get('/edit/{id}', [NotificationController::class, 'edit'])->name('admin.notification.edit');
			Route::post('/update/{id}', [NotificationController::class, 'update'])->name('admin.notification.update');
			Route::delete('/delete/{id}', [NotificationController::class, 'destroy'])->name('admin.notification.delete');
		});

		Route::group(['prefix' => 'configuration'], function(){
			Route::get('/', [ConfigurationController::class, 'index'])->name('admin.configuration');
			Route::get('/create', [ConfigurationController::class, 'create'])->name('admin.configuration.create');
			Route::post('/store', [ConfigurationController::class, 'store'])->name('admin.configuration.store');
			Route::get('/edit/{id}', [ConfigurationController::class, 'edit'])->name('admin.configuration.edit');
			Route::post('/update/{id}', [ConfigurationController::class, 'update'])->name('admin.configuration.update');
			Route::delete('/delete/{id}', [ConfigurationController::class, 'destroy'])->name('admin.configuration.delete');
		});

		Route::group(['prefix' => 'update-profile'], function(){
			Route::get('/', [CustomerController::class, 'profileIndex'])->name('admin.update-profile');
			Route::post('/update/{id}', [CustomerController::class, 'profileUpdate'])->name('admin.update-profile.update');
		});

	/**
	 * Maintanance
	 */
		Route::group(['prefix' => 'maintanance'], function(){
			Route::get('/', [MaintananceController::class, 'index'])->name('admin.maintanance');
			Route::get('/create', [MaintananceController::class, 'create'])->name('admin.maintanance.create');
			Route::get('/report-create', [MaintananceController::class, 'reportCreate'])->name('admin.maintanance.report-create');
			Route::post('/store', [MaintananceController::class, 'store'])->name('admin.maintanance.store');
			Route::post('/report-store', [MaintananceController::class, 'reportStore'])->name('admin.maintanance.report-store');
			Route::get('/edit/{id}', [MaintananceController::class, 'edit'])->name('admin.maintanance.edit');
			// Route::get('/report-view/{id}', [MaintananceController::class, 'reportView'])->name('admin.maintanance.report-view');
			Route::post('/update/{id}', [MaintananceController::class, 'update'])->name('admin.maintanance.update');
			Route::delete('/delete/{id}', [MaintananceController::class, 'destroy'])->name('admin.maintanance.delete');
		});

		Route::group(['prefix' => 'wing'], function(){
			Route::get('/', [WingController::class, 'index'])->name('admin.wing');
			Route::get('/create', [WingController::class, 'create'])->name('admin.wing.create');
			Route::post('/store', [WingController::class, 'store'])->name('admin.wing.store');
			Route::get('/edit/{id}', [WingController::class, 'edit'])->name('admin.wing.edit');
			Route::post('/update/{id}', [WingController::class, 'update'])->name('admin.wing.update');
			Route::delete('/delete/{id}', [WingController::class, 'destroy'])->name('admin.wing.delete');
		});

		Route::group(['prefix' => 'home'], function(){
			Route::get('/', [HomeController::class, 'index'])->name('admin.home');
			Route::get('/create', [HomeController::class, 'create'])->name('admin.home.create');
			Route::post('/store', [HomeController::class, 'store'])->name('admin.home.store');
			Route::post('/home-maintanance-store', [HomeController::class, 'storeMaintanance'])->name('admin.home.maintanance.store');
			Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('admin.home.edit');
			Route::post('/update/{id}', [HomeController::class, 'update'])->name('admin.home.update');
			Route::delete('/delete/{id}', [HomeController::class, 'destroy'])->name('admin.home.delete');
		});
});