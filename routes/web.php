<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GrnController;
use App\Http\Controllers\GrnTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallationChangedSimController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\ProductModelForeignController;
use App\Models\InstallationChangedSim;
use App\Models\ProductModel;
use App\Models\warehouses;
use Illuminate\Support\Facades\Auth;

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

// Auth::routes();

Auth::routes([
    'register' => true,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [HomeController::class, 'logout'])->middleware('auth');

Route::get('/', function () {
    return view('/back_end/dashboard');
})->middleware('auth');

Route::get('/admin', function () {
    return view('/back_end/dashboard');
})->middleware('auth');

// On Ready Functons' Routes
Route::get('/admin/vat/get/vatlist', [VatController::class, 'getAllVAT']);
Route::get('/admin/foreign_models/get/foreignModelList', [ProductModelForeignController::class, 'getForeignModelList']);
Route::get('/admin/grnType/get/grnTypelist', [GrnTypeController::class, 'getAllGrnType']);
Route::get('/admin/warehouse/get/warehouselist', [warehouses::class, 'getAllWarehouses']);
Route::get('/admin/supplier/get/suggetions', [SupplierController::class, 'supplierSuggestions']);

Route::get('/admin/product/category', [ProductCategoryController::class, 'index'])->middleware('auth')->middleware('auth');
Route::get('/admin/product/category/get/suggetions', [ProductCategoryController::class, 'productCategorySuggetions'])->middleware('auth');
Route::get('/admin/product/category/db/save', [ProductCategoryController::class, 'save'])->middleware('auth');
Route::get('/admin/product/category/get/categoryList', [ProductCategoryController::class, 'categoryList'])->middleware('auth');
Route::get('/admin/product/category/get/category_view_for_update', [ProductCategoryController::class, 'categoryViewForUpdate'])->middleware('auth');
Route::get('/admin/product/category/get/category_view_for_disable', [ProductCategoryController::class, 'categoryViewForDisable'])->middleware('auth');
Route::post('/admin/product/category/uploadCategoryImage', [ProductCategoryController::class, 'uploadFile'])->name('uploadCategoryImage.action')->middleware('auth');

Route::get('/admin/brand/db/save', [BrandController::class, 'save'])->middleware('auth');
Route::get('/admin/brand/get/all', [BrandController::class, 'getALl'])->middleware('auth');

Route::get('/admin/product/models', [ProductModelController::class, 'index'])->middleware('auth');
Route::get('/admin/product/models/db/save', [ProductModelController::class, 'save'])->middleware('auth');
Route::get('/admin/product/models/get/all', [ProductModelController::class, 'modelList'])->middleware('auth');
Route::get('/admin/product/models/get/getModelByProductId', [ProductModelController::class, 'getModelByProductId'])->middleware('auth');
Route::get('/admin/product/models/get/getModelByBrandId', [ProductModelController::class, 'getModelByBrandId'])->middleware('auth');

Route::get('/admin/product', [ProductsController::class, 'index'])->middleware('auth');
Route::post('/admin/db/save', [ProductsController::class, 'save'])->middleware('auth');
Route::get('/admin/product_list', [ProductsController::class, 'productList_backend']);
Route::get('/admin/getAllProducts', [ProductsController::class, 'getAllProducts'])->middleware('auth');
Route::get('/admin/changeStatus', [ProductsController::class, 'changeStatus'])->middleware('auth');
Route::get('/admin/product/get/suggetions', [ProductsController::class, 'productSuggestions'])->middleware('auth');
Route::get('/admin/product/get/details', [ProductsController::class, 'productQuickView'])->middleware('auth');
Route::get('/admin/product/get/edit', [ProductsController::class, 'productQuickView'])->middleware('auth');
Route::post('/admin/product/db/updateDescription', [ProductsController::class, 'productDescriptionEdit'])->middleware('auth');
Route::get('/admin/product/db/updateDefaultPrice', [ProductsController::class, 'productDefaultPriceEdit'])->middleware('auth');
Route::get('/admin/product/view/updateCategory', [ProductsController::class, 'updateCategoryForview'])->middleware('auth');
Route::get('/admin/product/db/updateCategory', [ProductsController::class, 'updateCategory'])->middleware('auth');
Route::get('/admin/product/db/getProductPrice', [ProductsController::class, 'getProductPrice'])->middleware('auth');
Route::get('/admin/product/get/advanceEditView', [ProductsController::class, 'advanceEditView'])->middleware(['auth']);
Route::post('/admin/product/save/advanceEditSave', [ProductsController::class, 'advanceEditSave'])->middleware(['auth']);

Route::get('/admin/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::post('/admin/supplier/db/save', [SupplierController::class, 'save'])->middleware('auth');
Route::get('/admin/supplier/get/supplierList', [SupplierController::class, 'supplierList'])->middleware('auth');
Route::get('/admin/supplier/get/category_view_for_update', [SupplierController::class, 'supplierViewForUpdate'])->middleware('auth');
Route::post('/admin/supplier/db/updateSupplier', [SupplierController::class, 'updateSupplier'])->middleware('auth');
Route::get('/admin/supplier/db/changeStatus', [SupplierController::class, 'changeStatus'])->middleware('auth');

Route::get('/admin/grn', [GrnController::class, 'index'])->middleware('auth');
Route::get('/admin/grn/session/addProduct', [GrnController::class, 'addSessionProduct'])->middleware('auth');
Route::get('/admin/grn/session/grnAddedProductList', [GrnController::class, 'grnAddedProductList'])->middleware('auth');
Route::get('/admin/grn/session/removeProduct', [GrnController::class, 'grnRemoveSessionProduct'])->middleware('auth');
Route::get('/admin/grn/session/getTotal', [GrnController::class, 'getAddedSessionProductTotal'])->middleware('auth');
Route::get('/admin/grn/db/saveGRN', [GrnController::class, 'saveGRN'])->middleware('auth');

Route::get('/admin/grn/get/purchaseList', [GrnController::class, 'purchaseList'])->middleware('auth');
Route::get('/admin/grn/view/purchase', [GrnController::class, 'viewPurchase'])->middleware('auth');

Route::get('/admin/stock', [StockController::class, 'index'])->middleware('auth');
Route::get('/admin/stock/get/allstock', [StockController::class, 'getStock'])->middleware('auth');
Route::get('/admin/stock/get/product-wise_stock', [StockController::class, 'productwiseStock'])->middleware('auth');

Route::get('/admin/customer', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/admin/customer/get/customerList', [CustomerController::class, 'customerList'])->middleware('auth');
Route::post('/admin/customer/db/save', [CustomerController::class, 'save'])->middleware('auth');
Route::get('/admin/supplier/get/customer_view_for_update', [CustomerController::class, 'customerViewForUpdate'])->middleware('auth');
Route::post('/admin/customer/db/updateCustomer', [CustomerController::class, 'updateCustomer'])->middleware('auth');
Route::get('/admin/customer/db/changeStatus', [CustomerController::class, 'changeStatus'])->middleware('auth');

Route::get('/admin/invoice', [InvoiceController::class, 'index'])->middleware('auth');
Route::get('/admin/customer/get/suggetions', [CustomerController::class, 'customerSuggestions']);
Route::get('/admin/customer/get/suggetions/address', [CustomerController::class, 'getCustomerAddressById']);
Route::get('/admin/customer/get/primaryDetails', [CustomerController::class, 'getCustomerPrimaryDetails']);

Route::get('/admin/invoice/session/addProduct', [InvoiceController::class, 'addSessionProduct'])->middleware('auth');
Route::get('/admin/invoices/session/invoiceTableView', [InvoiceController::class, 'invoiceTableView'])->middleware('auth');
Route::get('/admin//invoices/removeFromSession', [InvoiceController::class, 'removeProductFromSession'])->middleware('auth');
Route::get('/admin/invoice/session/getTotal', [InvoiceController::class, 'getInvoiceTotal'])->middleware('auth');
Route::get('/admin/invoice/db/save', [InvoiceController::class, 'saveInvoice'])->middleware('auth');
Route::get('/admin/invoice/db/get/getInvoiceList', [InvoiceController::class, 'getInvoiceList'])->middleware('auth');
Route::get('/admin/invoice/view/invoice', [InvoiceController::class, 'viewInvoice'])->middleware('auth');

Route::get('/admin/new/installation', [InstallationController::class, 'index'])->middleware('auth');
Route::get('/admin/product/sim/get/suggetions', [InstallationController::class, 'getSIMSuggestions'])->middleware('auth');
Route::get('/admin/product/product/get/suggetions', [InstallationController::class, 'getProductSuggestions'])->middleware('auth');
Route::get('/admin/installation/save', [InstallationController::class, 'save'])->middleware('auth');
Route::post('/admin/installation/vehicle_images', [InstallationController::class, 'saveVehicleImages'])->middleware('auth');
Route::post('/admin/installation/nic_images', [InstallationController::class, 'saveNICImages'])->middleware('auth');
Route::get('/admin/installation/viewInstallationTotal', [InstallationController::class, 'viewInstallationTotal'])->middleware('auth');

Route::get('/admin/invoice/PRINT', [InstallationController::class, 'printInstallationInvoice']);
// Route::get('/admin/invoice/PRINT', [InstallationController::class, 'printInstallationInvoice'])->name('PRINT_INVOICE')->middleware('auth');

Route::get('/admin/installation/list', [InstallationController::class, 'installationList'])->middleware('auth');
Route::get('/admin/installation/sim-change/view-details', [InstallationController::class, 'viewSelectedInstallation'])->middleware('auth');

Route::get('/admin/installationList', function () {
    return view('/back_end/installation_list');
});

Route::get('/admin/re/installation', function () {
    return view('/back_end/installation_re');
});

Route::get('/admin/invoice_list', function () {
    return view('/back_end/invoice_list');
});

Route::get('admin/installation/lits', [InstallationController::class, 'installationList'])->middleware('auth');

Route::get('/admin/grn_list', function () {
    return view('/back_end/grn_list');
});

Route::get('/admin/online_orders', function () {
    return view('/back_end/online_orders');
});

Route::get('/invoice', function () {
    return view('/back_end/reports/invoice');
});
