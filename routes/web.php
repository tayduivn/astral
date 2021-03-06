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

Route::get('/', function () {
  return view('auth.login');
})->middleware('guest');

// Admin Routes
Route::group(
  ['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'],
  function () {
    // Index
    Route::get('/', 'AdminController@index')->name('index');
    // Calendar
    Route::get('calendar', 'CalendarController@index')->name('calendar.index');
    Route::get('calendar/events', 'CalendarController@events')->name('calendar.events');
    Route::get('calendar/sales', 'CalendarController@sales')->name('calendar.sales');
    // Shows resource
    Route::resource('products', 'ProductController');
    // Shows resource
    Route::resource('shows', 'ShowController');
    Route::get('shows/{show}/delete', 'ShowController@delete')->name('shows.delete');
    // Members Resource
    Route::resource('members', 'MemberController');
    // Users resource
    Route::resource('users', 'UserController');
    Route::get('users/{user}/delete', 'UserController@delete')->name('shows.delete');
    // Organizations resource
    Route::resource('organizations', 'OrganizationController');
    // Events resource
    Route::resource('events', 'EventController');
    // Product Types
    Route::resource('product-types', 'ProductTypeController');
    // Member Types
    Route::resource('member-types', 'MemberTypeController');
    // Grades
    Route::resource('grades', 'GradeController');
    // Show Types
    Route::resource('show-types', 'ShowTypeController');
    //Announcements
    Route::resource('announcements', 'AnnouncementController');
    // Reports
    Route::get('reports/closeout', 'ReportController@closeout')->name('reports.closeout');
    Route::get('reports/transactionDetail', 'ReportController@transactionDetail')->name('reports.transactionDetail');
    Route::get('reports/royalty', 'ReportController@royalty')->name('reports.royalty');
    Route::get('reports/newMembers', 'ReportController@newMembers')->name('reports.newMembers');
    Route::get('reports/overall', 'ReportController@overall')->name('reports.overall');
    Route::get('reports', 'ReportController@index')->name('reports.index');
    Route::get('reports/attendance', 'ReportController@attendance')->name('reports.attendance');
    Route::post('reports/attendance/show-type', 'ReportController@attendanceByShowType')->name('reports.show-type');
    Route::get('reports/product', 'ReportController@product')->name('reports.product');
    Route::get('reports/users/{type}', 'ReportController@users')->name('reports.users');
    // Sales Resource
    //Route::resource('sales', 'SaleController', ['except' => ['create']]);
    Route::resource('sales', 'SaleController');
    Route::post('sales/refund/{sale}', 'SaleController@refund')->name('sales.refund');
    Route::post('sales/refundPayment/{payment}', 'SaleController@refundPayment')->name('sales.refundPayment');
    Route::get('sales/{sale}/confirmation', 'SaleController@confirmation')->name('sales.confirmation');
    Route::get('sales/{sale}/invoice', 'SaleController@invoice')->name('sales.invoice');
    Route::get('sales/{sale}/receipt', 'SaleController@receipt')->name('sales.receipt');
    Route::get('sales/{sale}/cancelation', 'SaleController@cancelation')->name('sales.cancelation');
    Route::get('sales/{sale}/mail', 'SaleController@mail')->name('sales.mail');
    Route::get('sales/{sale}/tickets', 'SaleController@tickets')->name('sales.tickets');
    // Setting resource
    Route::resource('settings', 'SettingController');
    // Roles
    Route::resource('roles', 'RoleController');
    // Bulletin
    Route::resource('posts', 'PostController');
    Route::resource('replies', 'ReplyController');
    Route::resource('categories', 'CategoryController');
    // HTTP PUT route for updating general settings
    Route::put('settings', 'SettingController@update');
    // Settings Resources
    Route::resource('ticket-types', 'TicketTypeController');
    Route::resource('event-types', 'EventTypeController');
    Route::resource('organization-types', 'OrganizationTypeController');
    // HTTP PUT route for adding managing Organization Types
    Route::post('settings/addOrganizationType', 'SettingController@addOrganizationType')->name('settings.addOrganizationType');
    // HTTP PUT route for adding managing Payment Methods
    Route::post('settings/addPaymentMethod', 'SettingController@addPaymentMethod')->name('settings.addPaymentMethod');
    // HTTP PUT route for adding managing Member Types
    Route::post('settings/addMemberType', 'SettingController@addMemberType')->name('settings.addMemberType');
    // Member Card
    Route::get('members/{member}/card', 'MemberController@card')->name('members.card');
    // Membership Receipt
    Route::get('members/{member}/receipt', 'MemberController@receipt')->name('members.receipt');
    // Membersihp Secondary
    Route::put('members/{member}/addSecondary', 'MemberController@addSecondary')->name('members.addSecondary');
    // New Member Wizard
    Route::get('members/create/wizard', 'MemberController@wizard')->name('members.wizard');
    // Mail Preview
    Route::get('mail/confirmation/{sale}', function (App\Sale $sale) {
      return new App\Mail\ConfirmationLetter($sale);
    });
    // Tickets
    Route::resource('tickets', 'TicketController');
    // Logs
    Route::get('logs', 'LogController@index')->name('logs');
    Route::get('logs/clear', 'LogController@clear')->name('logs.clear');
    // Shifts
    Route::resource('shifts', 'ShiftController');
    Route::post('shifts/overview', 'ShiftController@overview')->name('shifts.overview');
    Route::post('shifts/mail', 'ShiftController@mail')->name('shifts.mail');
    // Schedules
    Route::resource('schedules', 'ScheduleController');
    Route::get('schedules/{schedule}/mail/', 'ScheduleController@mail')->name('schedules.mail');
    Route::get('schedules/{schedule}/mail/preview', function (\App\Schedule $schedule) {
      return new \App\Mail\NewSchedule($schedule, auth()->user());
    });
    Route::resource('positions', 'PositionController');
  }
);
// Cashier Routes
Route::group(
  ['prefix' => 'cashier', 'as' => 'cashier.', 'namespace' => 'Cashier', 'middleware' => 'auth'],
  function () {
    // Index
    Route::get('/', 'CashierController@index')->name('index');
    // Store Cashier Sale
    Route::post('/', 'CashierController@store')->name('store');
    // Reports
    Route::get('reports/{type}', 'ReportController@reports')->name('reports');
    // Find Sale
    Route::post('query', 'SaleController@query')->name('query');
    // Sales
    Route::resource('sales', 'SaleController');
    Route::get('sales/{sale}/confirmation', 'SaleController@confirmation')->name('sales.confirmation');
    Route::get('sales/{sale}/invoice', 'SaleController@invoice')->name('sales.invoice');
    Route::get('sales/{sale}/receipt', 'SaleController@receipt')->name('sales.receipt');
    Route::get('sales/{sale}/cancelation', 'SaleController@cancelation')->name('sales.cancelation');
    // Members
    Route::resource('members', 'MemberController');
    // Users (edit member only)
    Route::resource('users', 'UserController');
    // Member Card
    Route::get('members/{member}/card', 'MemberController@card')->name('members.card');
    // Membership Receipt
    Route::get('members/{member}/receipt', 'MemberController@receipt')->name('members.receipt');
    // Membersihp Secondary
    Route::put('members/{member}/addSecondary', 'MemberController@addSecondary')->name('members.addSecondary');
    // New
    Route::get('new', function () {
      return view('cashier.new');
    })->name('new');
  }
);


Auth::routes();

Route::get("/login", "Auth\LoginController@login")->name("login");
Route::post("/login", "Auth\LoginController@authenticate");

Route::put('account/selfupdate', 'Admin\UserController@selfupdate')->middleware('auth')->name('selfupdate');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'HomeController@account')->name('account')->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/events', function () {
  return view('events');
})->name('events');

Route::get('/sales', function () {
  return view('sales');
})->name('sales')->middleware('auth'); // PROTECT THIS ROUTE IN A FUTURE RELEASE!

Route::get('/sales/{sale}', 'SaleController@show')->name('sale');
Route::get('/sales/{sale}/confirm', 'SaleController@update')->name('sale.confirm');