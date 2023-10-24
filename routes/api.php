<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\GenreAPIController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\MusicAPIController;
use App\Http\Controllers\TypeaheadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * https://www.itsolutionstuff.com/post/how-to-send-sms-using-twilio-in-laravelexample.html
 * https://programmingfields.com/send-emails-using-twilio-sendgrid-in-laravel-8/
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/social-register/google', 'JWTAuthController@googleRegister');
// Route::post('/get-linkedin-data', 'JWTAuthController@getLinkidInData');
// Route::post('/social-register/facebook', 'JWTAuthController@facebookRegister');
// Route::post('/social-register/linkedin', 'JWTAuthController@linkedinRegister');
// Route::get( '/{social}/callback', 'JWTAuthController@getSocialCallback' );
// Route::post( '/social-login', 'JWTAuthController@socialLogin');
// Route::post( '/update-social-login', 'JWTAuthController@updateSocialLogin');

Route::group([ 'middleware' => 'api', 'namespace' => 'Api' ], function ($router) {
    Route::group([ 'prefix' => 'auth' ], function ($router) {
        Route::post('mobile-login', [AuthController::class, 'loginWithMobile']);// API: 2735
        Route::post('email-login', [AuthController::class, 'loginWithEmail']);// API: 2734

        Route::post('send-mobile-otp', [CustomerApiController::class, 'sendMobileOTP']);//API: 2727, Mobile Signup first step
        // Route::post('verify-mobile-otp', [CustomerApiController::class, 'verifyMobileOTP']);//Verify Mobile Signup second step

        Route::post('verify-otp', [CustomerApiController::class, 'verifyOTP']);//API: 2737, Verify Mobile Signup second step

        Route::post('send-email-otp', [CustomerApiController::class, 'sendEmailOTP']);//Email Signup first step
        // Route::post('verify-email-otp', [CustomerApiController::class, 'verifyEmailOTP']);//Verify Email Signup second step

        Route::post('create-customer', [CustomerApiController::class, 'createCustomer']);//Verify Mobile Signup second step
        Route::post('update-password', [CustomerApiController::class, 'updatePassword']);//API: 2764, update customer password
        Route::post('reset-password', [CustomerApiController::class, 'sendOTP']);//API: 2736, Check verify method and send appropriate OTP like, mobile or email

        Route::get('get-user-profile', [CustomerApiController::class, 'getUserDetails']);//API: 2762
        Route::post('update-user-profile', [CustomerApiController::class, 'updateProfileDetails']);//API: 2765

        Route::post('login-with-facebook', [CustomerApiController::class, 'loginWithFacebook']);//API: 2728
        Route::post('login-with-apple', [CustomerApiController::class, 'loginWithApple']);//API: 2728

        Route::post('logout', [AuthController::class, 'logout']);//API: 2767
    });

    Route::get('get-categories', [GenreAPIController::class, 'getCategoryList']);
    Route::post('get-genre', [GenreAPIController::class, 'getGenreList']);//API: 2716
    Route::get('get-genre-details/{id}', [GenreAPIController::class, 'getGenreDetails']);//API: 2759

    Route::post('get-sub-genre/{id?}', [GenreAPIController::class, 'getSubGenreList']);//API: 2761
    Route::get('get-sub-genre-details/{id}', [GenreAPIController::class, 'getSubGenreDetails']);//API: 2760

    //categories from user selection api
    Route::post('post-user-selected-genre', [GenreAPIController::class, 'submitUserSelectedGenre']);// API: 2732
    Route::get('get-user-selected-genre', [GenreAPIController::class, 'getUserSelectedGenre']);// API: 2739

    //language from customer selection api
    Route::post('post-customer-selected-language', [CustomerApiController::class, 'submitCustomerSelectedLanguage']);
    Route::get('get-customer-selected-language', [CustomerAPIController::class, 'getCustomerSelectedLanguage']);

    Route::post('get-authors', [HomeApiController::class, 'getAuthorList']);//API: 2717
    Route::get('get-author/{id}', [HomeApiController::class, 'getAuthorDetails']);//API: 2743
    Route::post('search-title-author', [HomeApiController::class, 'searchTitleAuthor']);// API: 2733

    Route::get('get-titles', [HomeApiController::class, 'getTitleList']);//API: 2752
    Route::get('get-title/{id}', [HomeApiController::class, 'getTitleDetails']);//API: 2752

    Route::post('get-types', [HomeApiController::class, 'getTypeList']);//API: 2718
    Route::get('get-language', [HomeApiController::class, 'getLanguageList']);// API: 2738
    Route::get('get-country', [HomeApiController::class, 'getCountryList']);

    Route::get('get-plans', [CustomerApiController::class, 'getPlanList']);// API: 2725
    Route::post('upgrade-plans', [CustomerApiController::class, 'upgradePlan']);// API: 2726
    Route::get('new-releases', [CustomerApiController::class, 'newReleases']);// API: 

    Route::get('get-season/{type?}', [GenreAPIController::class, 'getSeasonList']);//API: 2758, type: 1: Audio Drama, 2: Audio Book, 3: Podcast
    Route::get('get-season-details/{title}/{season}', [GenreAPIController::class, 'getSeasonDetails']);//API: 2758, type: 1: Audio Drama, 2: Audio Book, 3: Podcast
    Route::get('get-season-episode-details/{title}/{season}/{episode}', [GenreAPIController::class, 'getSeasonEpisodeDetails']);//API: 2758, type: 1: Audio Drama, 2: Audio Book, 3: Podcast
    Route::get('get-chapter/{type}', [GenreAPIController::class, 'getChapterList']);//API: 2756, type: 1: Audio Drama, 2: Audio Book, 3: Podcast
    Route::get('get-podcast', [GenreAPIController::class, 'getPodcastList']);//API: 2757
    Route::get('get-podcast-details/{podcast}', [GenreAPIController::class, 'getPodcastDetails']);//API: 2757

    Route::get('favourites/{titleId}', [MusicAPIController::class, 'musicFavouriteList']);//API: 2748
    Route::get('get-favourites', [MusicAPIController::class, 'getFavouriteList']);
    // Route::post('post-favourites', [MusicAPIController::class, 'postFavouriteList']);
    // Route::delete('delete-favourites/{id}', [MusicAPIController::class, 'deleteFavourite']);

    Route::get('get-rate-review/{titleId}', [CustomerApiController::class, 'getRateReviewList']);//API: 2749
    Route::post('post-rate-review', [CustomerApiController::class, 'postRateReviewList']);//API: 2749
    Route::delete('delete-rate-review/{id}', [CustomerApiController::class, 'deleteRateReview']);//API: 49
    Route::post('personal-message-api', [CustomerApiController::class, 'childPersonalMessage']);//API: 2742

    Route::get('get-recently-listen-listing', [MusicAPIController::class, 'getRecentListenList']);// API: 2724
    Route::post('add-listen-music', [MusicAPIController::class, 'addListenMusic']);//API: 2724
    // Route::post('listen-music', [MusicAPIController::class, 'musicListenList']);//API: 2724
    Route::delete('delete-listen-music/{id}', [MusicAPIController::class, 'deleteListenMusic']);// API: 2724
    Route::post('download-music', [MusicAPIController::class, 'downloadMusic']);//API: 2747
    Route::get('get-download-music', [MusicAPIController::class, 'getDownloadMusic']);// API: 2753

    Route::get('get-library-music', [MusicAPIController::class, 'getLibraryList']);//API: 2745
    Route::post('add-library-music', [MusicAPIController::class, 'addLibraryMusic']);//API: 2745
    Route::delete('delete-library-music/{id}', [MusicAPIController::class, 'deleteLibraryMusic']);//API: 2746

    Route::get('get-collection', [MusicAPIController::class, 'getCollectionList']);// API: 2766
    Route::post('create-collection/{id?}', [MusicAPIController::class, 'createCollection']);// API: 2766
    Route::delete('delete-collection-list/{id}', [MusicAPIController::class, 'deleteCollectionHistory']);//API: 2766

    Route::get('get-collection-details/{id}', [MusicAPIController::class, 'getCollectionDetails']);// API: 2766
    Route::post('update-collection', [MusicAPIController::class, 'addCollectionMusic']);//API: 2766
    Route::delete('delete-collection-music/{id}', [MusicAPIController::class, 'deleteCollectionMusic']);//API: 2766

    Route::get('get-collection-continue-listing/{id}', [MusicAPIController::class, 'getCollectionContinueListing']);// API: 2719
    Route::get('get-podcast-continue-listing/{id}', [MusicAPIController::class, 'getCollectionContinueListing']);// API: 2722

    Route::get('get-popular-category', [MusicAPIController::class, 'getPopularCategoryListing']);// API: 2720
    Route::post('create-popular-category', [MusicAPIController::class, 'createPopularCategory']);// API: 2720

    Route::get('get-trending-titles', [MusicAPIController::class, 'getTrendingTitlesListing']);// API: 2721
    Route::get('get-top-titles', [MusicAPIController::class, 'getTopTitlesListing']);// API: 2740

    Route::post('mark-as-finished', [MusicAPIController::class, 'createPopularCategory']);// API: 2750

    Route::get('finished-title', [MusicAPIController::class, 'getFinishedTitleListing']);// API: 2755

    Route::get('get-stats-graph-data', [MusicAPIController::class, 'getStatsGraphData']);// API: 2763

    Route::any('user-goal-limit', [MusicAPIController::class, 'userGoalLimit']);// API: 2763

    Route::any('not-started-music', [MusicAPIController::class, 'notStartedListeningMusic']);// API: 2754

    Route::any('our-recommended-radios', [MusicAPIController::class, 'ourRecommendedRadios']);// API: 2723
});

Route::post('/autocomplete-blog-tag-search', [TypeaheadController::class, 'autocompleteBlogTagSearch']);
Route::post('/autocomplete-category-search/{parent?}/{type?}', [TypeaheadController::class, 'autocompleteCategorySearch']);