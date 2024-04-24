<?php

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}



use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('emailSentCab','EmailNodeController@emailSentCab')->name('emailSentCab');
Route::get('AppCarTypeShow','CarTypeController@AppCarTypeShow')->name('AppCarTypeShow');
Route::post('AppCarShowCity','CarTypeController@AppCarShowCity')->name('AppCarShowCity');
Route::get('AppApiLogin','AppApiController@AppApiLogin')->name('AppApiLogin');
Route::post('AppApiRegister','AppApiController@AppApiRegister')->name('AppApiRegister');
Route::post('AppApiLinking','AppApiController@AppApiLinking')->name('AppApiLinking');
Route::post('AppApiLinkingAgain','AppApiController@AppApiLinkingAgain')->name('AppApiLinkingAgain');
Route::post('AppApiCheckStatus','AppApiController@AppApiCheckStatus')->name('AppApiCheckStatus');
Route::post('AppApiCheckRentalsStatus','AppApiController@AppApiCheckRentalsStatus')->name('AppApiCheckRentalsStatus');
Route::post('DriverApiCheckRides','AppApiController@DriverApiCheckRides')->name('DriverApiCheckRides');
Route::post('DriverApiUpdateStatus','AppApiController@DriverApiUpdateStatus')->name('DriverApiUpdateStatus');
Route::post('getDriverDetails','AppApiController@getDriverDetails')->name('getDriverDetails');
Route::post('DriverUpdateLocation','AppApiController@DriverUpdateLocation')->name('DriverUpdateLocation');
Route::get('AppApiLoginDriver','AppApiController@AppApiLoginDriver')->name('AppApiLoginDriver');
Route::post('AddCustomerOutstation','AppApiController@AddCustomerOutstation')->name('AddCustomerOutstation');
Route::post('getPackages','AppApiController@getPackages')->name('getPackages');
Route::post('getPackageLinking','AppApiController@getPackageLinking')->name('getPackageLinking');
Route::post('customerPackageLinkingSubmit','AppApiController@customerPackageLinkingSubmit')->name('customerPackageLinkingSubmit');
Route::post('getRentalApp','AppApiController@getRentalApp')->name('getRentalApp');
Route::post('getOutstaionApp','AppApiController@getOutstaionApp')->name('getOutstaionApp');
Route::post('AddShareApp','AppApiController@AddShareApp')->name('AddShareApp');
Route::post('getShareRidesApp','AppApiController@getShareRidesApp')->name('getShareRidesApp');
Route::post('getShareRidesCities','AppApiController@getShareRidesCities')->name('getShareRidesCities');
Route::post('getDriverReports','AppApiController@getDriverReports')->name('getDriverReports');
Route::post('DriverLoginStatus','AppApiController@DriverLoginStatus')->name('DriverLoginStatus');
Route::post('applyCoupon','AppApiController@applyCoupon')->name('applyCoupon');
Route::post('getDriverPackageLinking','AppApiController@getDriverPackageLinking')->name('getDriverPackageLinking');
Route::post('driverGetRentals','AppApiController@driverGetRentals')->name('driverGetRentals');
Route::post('driverUpdateRentalsStatus','AppApiController@driverUpdateRentalsStatus')->name('driverUpdateRentalsStatus');
Route::post('getAllCities','AppApiController@getAllCities')->name('getAllCities');
Route::post('customerGetLocalRides','AppApiController@customerGetLocalRides')->name('customerGetLocalRides');
Route::post('customerGetOutstationRides','AppApiController@customerGetOutstationRides')->name('customerGetOutstationRides');
Route::post('customerGetRentalRides','AppApiController@customerGetRentalRides')->name('customerGetRentalRides');
Route::post('submitFeedback','AppApiController@submitFeedback')->name('submitFeedback');


Route::get('allCorporateCustomer','CorporateController@allCorporateCustomer')->name('allCorporateCustomer');
Route::post('EditCorporateLinkDriver','CorporateController@EditCorporateLinkDriver')->name('EditCorporateLinkDriver');
Route::post('updateCorporateLinkDriver','CorporateController@updateCorporateLinkDriver')->name('updateCorporateLinkDriver');
Route::post('CorporateBookingDetails','CorporateController@CorporateBookingDetails')->name('CorporateBookingDetails');
Route::post('AddCorporateBookingDetails','CorporateController@AddCorporateBookingDetails')->name('AddCorporateBookingDetails');
Route::post('editCorporateBooking','CorporateController@editCorporateBooking')->name('editCorporateBooking');
Route::post('UpdateCorporateBooking','CorporateController@UpdateCorporateBooking')->name('UpdateCorporateBooking');
Route::post('removeCorporateBooking','CorporateController@removeCorporateBooking')->name('removeCorporateBooking');
Route::post('editCorporateData','CorporateController@editCorporateData')->name('editCorporateData');
Route::post('UpdateCorporateData','CorporateController@UpdateCorporateData')->name('UpdateCorporateData');

Route::get('allCity','CityController@allCity')->name('allCity');
Route::post('addCity','CityController@store')->name('addCity');
Route::post('removeCity','CityController@removeCity')->name('removeCity');
Route::post('editCity','CityController@editCity')->name('editCity');
Route::post('updateCity','CityController@updateCity')->name('updateCity');

Route::get('allCompany','CompanyController@allCompany')->name('allCompany');
Route::post('addCompany','CompanyController@store')->name('addCompany');
Route::post('removeCompany','CompanyController@removeCompany')->name('removeCompany');
Route::post('editCompany2','CompanyController@editCompany')->name('editCompany2');
Route::post('updateCompany2','CompanyController@updateCompany')->name('updateCompany2');

Route::get('allVendor','VendorController@allVendor')->name('allVendor');
Route::post('addVendor','VendorController@store')->name('addVendor');
Route::post('removeVendor','VendorController@removeVendor')->name('removeVendor');
Route::post('editVendor2','VendorController@editVendor')->name('editVendor2');
Route::post('updateVendor2','VendorController@updateVendor')->name('updateVendor2');

Route::get('allPackageMaster','PackageMasterController@allPackageMaster')->name('allPackageMaster');
Route::post('addPackageMaster','PackageMasterController@store')->name('addPackageMaster');
Route::post('removePackageMaster','PackageMasterController@removePackageMaster')->name('removePackageMaster');
Route::post('editPackageMaster2','PackageMasterController@editPackageMaster')->name('editPackageMaster2');
Route::post('updatePackageMaster2','PackageMasterController@updatePackageMaster')->name('updatePackageMaster2');

Route::get('allCartype','CarTypeController@allCartype')->name('allCartype');
Route::post('addCartype','CarTypeController@store')->name('addCartype');
Route::post('editCarType','CarTypeController@editCarType')->name('editCarType');
Route::post('updateCartype','CarTypeController@updateCartype')->name('updateCartype');
Route::get('getCarType', 'CarTypeController@getCarType')->name('getCarType');
Route::post('removeCartype','CarTypeController@removeCartype')->name('removeCartype');
Route::post('editCar','SchoolController@editCar')->name('editCar');
Route::post('getCarTypeAdmin','CarTypeController@getCarTypeAdmin')->name('getCarTypeAdmin');

Route::get('allCar','CarController@allCar')->name('allCar');
Route::post('addCar','CarController@store')->name('addCar');
Route::post('removeCar','CarController@removeCar')->name('removeCar');
Route::post('removeCarStatus','CarController@removeCarStatus')->name('removeCarStatus');
Route::post('editCar','CarController@editCar')->name('editCar');
Route::post('updateCar','CarController@updateCar')->name('updateCar');
Route::post('searchCar','CarController@searchCar')->name('searchCar');
Route::post('showCar','CarController@showCar')->name('showCar');

Route::get('allDriver','DriverController@allDriver')->name('allDriver');
Route::post('addDriver','DriverController@store')->name('addDriver');
Route::post('editDriver','DriverController@editDriver')->name('editDriver');
Route::post('updateDriver','DriverController@updateDriver')->name('updateDriver');
Route::post('removeDriver','DriverController@removeDriver')->name('removeDriver');
Route::post('removeDriverStatus','DriverController@removeDriverStatus')->name('removeDriverStatus');
Route::post('searchDriver','DriverController@searchDriver')->name('searchDriver');
Route::post('showDriver','DriverController@showDriver')->name('showDriver');

Route::get('allPackage','PackageController@allPackage')->name('allPackage');
Route::post('addPackage','PackageController@store')->name('addPackage');
Route::post('editPackage','PackageController@editPackage')->name('editPackage');
Route::post('updatePackage','PackageController@updatePackage')->name('updatePackage');
Route::post('removePackage','PackageController@removePackage')->name('removePackage');
Route::post('addPackage1','PackageController@addPackage1')->name('addPackage1');

Route::get('allRental','RentalController@allRental')->name('allRental');
Route::post('addRental','RentalController@store')->name('addRental');
Route::post('tempaddRental','RentalController@temp_store')->name('tempaddRental');
Route::post('tempupdateRental','RentalController@tempupdateRental')->name('tempupdateRental');
Route::post('editLinkDriver','RentalController@editLinkDriver')->name('editLinkDriver');
Route::post('updateLinkDriver','RentalController@updateLinkDriver')->name('updateLinkDriver');
Route::post('removeRental','RentalController@removeRental')->name('removeRental');
Route::post('addCustomerRental','RentalController@addCustomerRental')->name('addCustomerRental');
Route::get('getAllCustomer', 'RentalController@getAllCustomer')->name('getAllCustomer');
Route::post('editOutstationDetails','RentalController@editOutstationDetails')->name('editOutstationDetails');
Route::post('updateOutstationDetails','RentalController@updateOutstationDetails')->name('updateOutstationDetails');
Route::post('get_pacakge_data','RentalController@get_pacakge_data')->name('get_pacakge_data');
Route::post('get_pacakge_info','RentalController@get_pacakge_info')->name('get_pacakge_info');
Route::post('get_all_drivers','RentalController@get_all_drivers')->name('get_all_drivers');


Route::get('allShare','ShareRideController@allShare')->name('allShare');
Route::post('addShare','ShareRideController@store')->name('addShare');
Route::post('removeShare','ShareRideController@removeShare')->name('removeShare');
Route::post('removeShareStatus','ShareRideController@removeShareStatus')->name('removeShareStatus');
Route::post('editShare','ShareRideController@editShare')->name('editShare');
Route::post('updateShare','ShareRideController@updateShare')->name('updateShare');
Route::post('showShareRide','ShareRideController@showShareRide')->name('showShareRide');

Route::get('allTravel','TravelTypeController@allTravel')->name('allTravel');
Route::post('addTravel','TravelTypeController@store')->name('addTravel');
Route::post('removeTravel','TravelTypeController@removeTravel')->name('removeTravel');

Route::post('AppLoginCab','CustomerController@AppLoginCab')->name('AppLoginCab');
Route::post('addCustomer','CustomerController@store')->name('addCustomer');
Route::post('addCustomer2','CustomerController@store2')->name('addCustomer2');
Route::post('tempaddCustomer','CustomerController@temp_store')->name('tempaddCustomer');
Route::post('update_tempaddCustomer','CustomerController@temp_update')->name('update_tempaddCustomer');
Route::get('allCustomer','CustomerController@allCustomer')->name('allCustomer'); //local ride
Route::get('allCustomerRegister','CustomerController@allCustomerRegister')->name('allCustomerRegister');
Route::post('showCustomer','CustomerController@showCustomer')->name('showCustomer');
Route::post('editCustomer','CustomerController@editCustomer')->name('editCustomer');
Route::post('editCustomer2','CustomerController@editCustomer2')->name('editCustomer2');
Route::post('updateCustomer','CustomerController@updateCustomer')->name('updateCustomer');
Route::post('updateCustomer2','CustomerController@updateCustomer2')->name('updateCustomer2');
Route::post('removeCustomer','CustomerController@removeCustomer')->name('removeCustomer');
Route::post('removeCustomer2','CustomerController@removeCustomer2')->name('removeCustomer2');
Route::post('customerBooking','CustomerController@customerBooking')->name('customerBooking');

//Enquiry
Route::get('allEnquiry','EnquiryController@allEnquiry')->name('allEnquiry'); //local ride
Route::post('addEnquiry','EnquiryController@store')->name('addEnquiry');
Route::post('removeEnquiry','EnquiryController@removeEnquiry')->name('removeEnquiry');
Route::post('editEnquiry','EnquiryController@editEnquiry')->name('editEnquiry');
Route::post('updateEnquiry','EnquiryController@updateEnquiry')->name('updateEnquiry');
Route::post('convertEnquiry','EnquiryController@convertEnquiry')->name('convertEnquiry');


Route::post('updateCompany','CustomerController@updateCompany')->name('updateCompany');
Route::post('editCompany','CustomerController@editCompany')->name('editCompany');

Route::get('allCoupon','CouponController@allCoupon')->name('allCoupon');
Route::post('addCoupon','CouponController@store')->name('addCoupon');
Route::post('removeCoupon','CouponController@removeCoupon')->name('removeCoupon');
Route::post('removeCouponWebsite','CouponController@removeCouponWebsite')->name('removeCouponWebsite');
Route::post('editCoupon','CouponController@editCoupon')->name('editCoupon');
Route::post('updateCoupon','CouponController@updateCoupon')->name('updateCoupon');
Route::post('showCoupon','CouponController@showCoupon')->name('showCoupon');

Route::get('allNotification','AdminNotificationController@allNotification')->name('allNotification');
Route::post('addNotification','AdminNotificationController@store')->name('addNotification');
Route::post('removeNotification','AdminNotificationController@removeNotification')->name('removeNotification');

Route::get('allSos','AdminNotificationController@allSos')->name('allSos');
Route::post('addSos','AdminNotificationController@addSos')->name('addSos');
Route::post('removeSos','AdminNotificationController@removeSos')->name('removeSos');
Route::post('editSos','AdminNotificationController@editSos')->name('editSos');
Route::post('updateSos','AdminNotificationController@updateSos')->name('updateSos');

Route::get('allRentalEnq','AdminNotificationController@allRentalEnq')->name('allRentalEnq');
Route::post('updateLinkDriverRental','AdminNotificationController@updateLinkDriverRental')->name('updateLinkDriverRental');
Route::post('editLinkDriverRental','AdminNotificationController@editLinkDriverRental')->name('editLinkDriverRental');
Route::post('addRentalEnquiry','AdminNotificationController@addRentalEnquiry')->name('addRentalEnquiry');
Route::post('tempaddRentalEnquiry','AdminNotificationController@tempaddRentalEnquiry')->name('tempaddRentalEnquiry');
Route::post('tempupdateRentalEnquiry','AdminNotificationController@tempupdateRentalEnquiry')->name('tempupdateRentalEnquiry');
Route::post('editRentalCustomer','AdminNotificationController@editRentalCustomer')->name('editRentalCustomer');
Route::post('updateRentalCustomer','AdminNotificationController@updateRentalCustomer')->name('updateRentalCustomer');
Route::post('getPackagesList','AdminNotificationController@getPackagesList')->name('getPackagesList');
Route::post('deleteRentalEnquiry','AdminNotificationController@deleteRentalEnquiry')->name('deleteRentalEnquiry');


Route::get('allFeedback','FeedbackController@allFeedback')->name('allFeedback');
Route::post('removeFeedback','FeedbackController@removeFeedback')->name('removeFeedback');

Route::get('allBlogs','BlogsController@allBlogs')->name('allBlogs');
Route::post('addBlogs','BlogsController@store')->name('addBlogs');
Route::post('removeBlog','BlogsController@removeBlog')->name('removeBlog');

Route::get('allVideo','VideoController@allVideo')->name('allVideo');
Route::post('addVideo','VideoController@store')->name('addVideo');
Route::post('removeVideo','VideoController@removeVideo')->name('removeVideo');

Route::get('allRestaurant','RestaurantController@allRestaurant')->name('allRestaurant');
Route::post('addRestaurant','RestaurantController@store')->name('addRestaurant');
Route::post('editRestaurant','RestaurantController@editRestaurant')->name('editRestaurant');
Route::post('updateRestaurant','RestaurantController@updateRestaurant')->name('updateRestaurant');
Route::post('removeRestaurant','RestaurantController@removeRestaurant')->name('removeRestaurant');

Route::get('allCategory','CategoryController@allCategory')->name('allCategory');
Route::post('addCategory','CategoryController@store')->name('addCategory');
Route::post('editCategory','CategoryController@editCategory')->name('editCategory');
Route::post('updateCategory','CategoryController@updateCategory')->name('updateCategory');
Route::post('removeCategory','CategoryController@removeCategory')->name('removeCategory');

Route::get('allMenus','MenusController@allMenus')->name('allMenus');
Route::post('addMenus','MenusController@store')->name('addMenus');
Route::post('editMenus','MenusController@editMenus')->name('editMenus');
Route::post('updateMenus','MenusController@updateMenus')->name('updateMenus');
Route::post('removeMenus','MenusController@removeMenus')->name('removeMenus');

Route::get('allOrder','OrderController@allOrder')->name('allOrder');
Route::post('orderDetails','OrderController@orderDetails')->name('orderDetails');

    Route::get('test_sms/','SendSmsController@test_sms')->name('send_sms');

