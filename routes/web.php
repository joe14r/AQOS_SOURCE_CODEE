<?php

use Illuminate\Support\Facades\Route;

use App\Models\Order;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\QRCodeController;
// use App\Http\Controllers\ProductController;
use App\Livewire\HomePage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MenuPage;
use App\Livewire\TableMenuPage;
use App\Livewire\OrderTrackingPage;
use App\Livewire\FeedbackPage;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\OrderTracking;
use App\Livewire\Admin\OrderDetails;
use App\Livewire\Admin\AdminFeedbackPage;
use App\Livewire\Admin\FeedbackEditPage;
use App\Livewire\Admin\TransectionReportPage;
use App\Livewire\Admin\MenuManager;
use App\Livewire\Admin\TableManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\RoleManager;
use App\Livewire\Admin\PrintPage;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OrdersController;



Route::get('order/print/{uid}', [OrdersController::class, 'print'])->name('order.print');
Route::get('order/download/{uid}', [OrdersController::class, 'generatePDF'])->name('order.download');

   
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomePage::class)->name('home');
Route::get('/menu', MenuPage::class)->name('menu');
Route::get('/menu-table/{tid}', TableMenuPage::class)->name('table.menu');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/feedback', FeedbackPage::class)->name('feedback');
Route::get('/order-tracking', OrderTrackingPage::class)->name('order.tracking');
  
Auth::routes();
  

//Route::get('/home', [HomePage::class, 'index'])->name('home');
Route::get('/test-broadcast', function () {
    broadcast(new \App\Events\OrderPlaced(Order::find(38))); // Use a valid order ID
    return 'Broadcasting event!';
});

Route::middleware('auth')->get('/admin', Dashboard::class)->name('dashboard');
// Route::get('/admin', Dashboard::class)->name('dashboard');
  
Route::prefix('admin')->middleware(['auth'])->group(function() {

    // Admin middleware group - Admins get access to both routes
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/chart-data', [ChartController::class, 'getChartData']);
        Route::get('/chart-weekly-data', [ChartController::class, 'getWeeklyChartData']);
        Route::get('/chart-monthly-data', [ChartController::class, 'getMonthlyChartData']);
        Route::get('roles', RoleManager::class)->name('roles');
        Route::resource('roles2', RoleController::class);
        Route::get('users', UserManager::class)->name('users');
        Route::get('tables', TableManager::class)->name('tables');
        Route::get('/table/{tid}', [QRCodeController::class, 'index'])->name('table.qrcode');
        Route::get('menus', MenuManager::class)->name('menus');
        Route::get('admin-feedback', AdminFeedbackPage::class)->name('admin.feedback');
        Route::get('/feedback/edit/{feedbackId}', FeedbackEditPage::class)->name('admin.feedback-edit');
        Route::get('/order', OrderTracking::class)->name('admin.order');
        Route::get('/order-details/{order_id}', OrderDetails::class)->name('admin.order.details');
        Route::get('/print/{order_id}', PrintPage::class)->name('admin.order.print');
        Route::get('transections', TransectionReportPage::class)->name('transections.index');
    });

    // KH staf middleware group - KH staf can access their specific routes
    Route::middleware(['role:KH staf'])->group(function () {
        Route::get('/chart-data', [ChartController::class, 'getChartData']);
        Route::get('/chart-weekly-data', [ChartController::class, 'getWeeklyChartData']);
        Route::get('/chart-monthly-data', [ChartController::class, 'getMonthlyChartData']);
        
        Route::get('tables', TableManager::class)->name('tables');
        Route::get('/table/{tid}', [QRCodeController::class, 'index'])->name('table.qrcode');
        Route::get('menus', MenuManager::class)->name('menus');
        Route::get('admin-feedback', AdminFeedbackPage::class)->name('admin.feedback');
        Route::get('/feedback/edit/{feedbackId}', FeedbackEditPage::class)->name('admin.feedback-edit');
        Route::get('/order', OrderTracking::class)->name('admin.order');
        Route::get('/order-details/{order_id}', OrderDetails::class)->name('admin.order.details');
    });

});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');