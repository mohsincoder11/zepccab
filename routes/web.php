<?php

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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/clear-cache', function () {
  Artisan::call('cache:clear');
  Artisan::call('route:clear');
  Artisan::call('config:clear');
  Artisan::call('view:clear');
  return redirect()->back();
  //return "All cache cleared!";
});

// use for Register Member link For Website//
Route::get('StudentRegister', 'AboutController@StudentRegister')->name('StudentRegister');

/**
 * Social Media Routes
 */
Route::get('auth/{provider}', 'MemberAuth\LoginController@redirectToProvider');
Route::get('callback/{provider}', 'MemberAuth\LoginController@handleProviderCallback');

/**
 * Payment Gateway
 */
Route::get('payment/{id}', 'PaymentController@payment')->name('payment');
Route::post('make/payment', 'PaymentController@paymentStart')->name('paymentStart');
Route::get('payment-status', 'PaymentController@status')->name('payment.status');

/**
 * Course Content
 */
Route::get('course/content/{chapter_id},{topic_id}', 'CourseController@course_content')->name('course_content');
Route::get('test/portal', 'TestController@test')->name('member.test');
Route::get('test/result', 'TestController@result')->name('test.result');
Route::post('Test/', 'TestController@preTestAction')->name('preTestAction');
Route::get('Test/', 'TestController@index')->name('Test');
Route::post('preAdditionalTestAction/', 'TestController@preAdditionalTestAction')->name('preAdditionalTestAction');
Route::get('preAdditionalTestAction/', 'TestController@index')->name('preAdditionalTestAction');
Route::get('stepper/', 'TestController@stepper')->name('stepper');
Route::post('/addContact', 'Contact_us@addContact')->name('addContact');
Route::post('socialMedia', 'TestController@socialMedia')->name('socialMedia');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');


  // use for sidebar link //

  Route::get('vendor', 'VendorController@index')->name('vendor');

  Route::get('company', 'CompanyController@index')->name('company');

  Route::get('package-master', 'PackageMasterController@index')->name('package-master');
  


  Route::get('city', 'AdminAuthController@city')->name('city');
  Route::get('cartype', 'AdminAuthController@cartype')->name('cartype');
  Route::get('car', 'AdminAuthController@car')->name('car');
  Route::get('driver', 'AdminAuthController@driver')->name('driver');
  Route::get('get-driver', 'DriverController@get_driver')->name('get-driver');
  Route::get('package', 'AdminAuthController@package')->name('package');
  Route::get('outstation', 'AdminAuthController@outstation')->name('outstation');
  Route::get('shareride', 'AdminAuthController@shareride')->name('shareride');
  Route::get('coupon', 'AdminAuthController@coupon')->name('coupon');
  Route::get('customer', 'AdminAuthController@customer')->name('customer');
  Route::get('register_customer', 'AdminAuthController@register_customer')->name('register_customer');
  Route::get('notification', 'AdminAuthController@notification')->name('notification');
  Route::get('feedback', 'AdminAuthController@feedback')->name('feedback');
  Route::get('sos', 'AdminAuthController@sos')->name('sos');
  Route::get('enquiryrental', 'AdminAuthController@enquiryrental')->name('enquiryrental');
  Route::get('corporate', 'AdminAuthController@corporate')->name('corporate');
  Route::get('blog', 'AdminAuthController@blog')->name('blog');
  Route::get('video_section', 'AdminAuthController@video_section')->name('video_section');
  Route::get('restaurant', 'AdminAuthController@restaurant')->name('restaurant');
  Route::get('menus', 'AdminAuthController@menus')->name('menus');
  Route::get('category', 'AdminAuthController@category')->name('category');
  Route::get('orders', 'AdminAuthController@orders')->name('orders');
  Route::get('analytic', 'AdminAuthController@analytic')->name('analytic');


  Route::get('all-rides', 'AdminAuthController@all_rides')->name('all-rides');
  Route::get('get-all-rides', 'AdminAuthController@get_all_rides')->name('get-all-rides');

  Route::get('enquiry-section', 'AdminAuthController@enquiry_section')->name('enquiry-section');
  Route::get('enquiry-get-all-rides', 'AdminAuthController@enquiry_get_all_rides')->name('enquiry-get-all-rides');

  Route::get('website-contact', 'AdminAuthController@website_enquiry')->name('website-contact');
  Route::get('allwebsiteenquiry', 'AdminAuthController@allwebsiteenquiry')->name('allwebsiteenquiry');
  Route::get('removewebsiteenquiry', 'AdminAuthController@removewebsiteenquiry')->name('removewebsiteenquiry');

  Route::get('website-enquiry', 'AdminAuthController@website_enquiry2')->name('website-enquiry');
  Route::get('allwebsiteenquiry2', 'AdminAuthController@allwebsiteenquiry2')->name('allwebsiteenquiry2');
  Route::get('removewebsiteenquiry2', 'AdminAuthController@removewebsiteenquiry2')->name('removewebsiteenquiry2');
});

Route::get('/explore-contents', 'CourseController@explore_contents')->name('explore-contents');


Route::group(['prefix' => 'member'], function () {
  Route::get('/login', 'MemberAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'MemberAuth\LoginController@login');
  Route::post('/logout', 'MemberAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'MemberAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'MemberAuth\RegisterController@register');

  Route::post('/password/email', 'MemberAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'MemberAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'MemberAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'MemberAuth\ResetPasswordController@showResetForm');

  Route::get('student', 'HomeController@student')->name('student');
  Route::get('fees', 'HomeController@fees')->name('fees');
  Route::post('/addStudent', 'StudentController@store')->name('addStudent');
  Route::post('searchStudent', 'StudentController@searchStudent')->name('searchStudent');
  Route::get('/allStudents', 'StudentController@allStudents')->name('allStudents');
  Route::get('/allStudentsFees', 'FeesController@allStudentsFees')->name('allStudentsFees');
  Route::post('searchStudentFees', 'FeesController@searchStudentFees')->name('searchStudentFees');
});
