<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DayworkController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DayworkPDFController;
use App\Http\Controllers\ManageAdminController;
use App\Http\Controllers\SearchItemsController;
use App\Http\Controllers\DayworkOrderController;
use App\Http\Controllers\DayworksIndexController;
use App\Http\Controllers\ItemMasterDataController;
use App\Http\Controllers\DayworkOrderEditController;
use App\Http\Controllers\MaterialRequisitionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//AUTHENTICATION ROUTES
Route::get('/', [UserController::class, 'checkauth']);
Route::get('/login', [UserController::class, 'showloginpage'])->name('login');
Route::get('/register', [UserController::class, 'showregisterpage']);

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);



Route::middleware(['auth'])->group(function () {

    //PROJECTS ROUTES
    Route::get('/projects', [ProjectsController::class, 'projectindex'])->name('projects.index'); //USED TO SHOW ALL PROJECTS ON HOMEPAGE
    Route::get('/projects/new', [ProjectsController::class, 'showaddprojectpage']); //USED TO SHOW ADD PROJECT PAGE
    Route::post('/projects/create', [ProjectsController::class, 'store']); //USED TO CREATE NEW PROJECT

    Route::get('/project/edit/{id}', [ProjectsController::class, 'edit']); //USED TO SHOW EDIT PROJECT PAGE
    Route::post('/project/edit/{id}', [ProjectsController::class, 'update']); //USED TO UPDATE PROJECT DETAILS
    Route::post('/project/delete/{id}', [ProjectsController::class, 'destroy']); //NOT BEING USED CURRENTLY


    //CREATE DAYWORKS ROUTES
    Route::get('/createdayworks/{id}', [DayworkOrderController::class, 'createNewDayworks'])->name('daywork_orders.create'); //USED TO SHOW CREATE NEW DAYWORK ORDER
    Route::post('/createdayworks/store', [DayworkOrderController::class, 'storeNewDayworks'])->name('daywork_orders.store'); //USED TO SUBMIT NEW DAYWORK ORDER


    //UPDATE DAYWORKS ROUTES
    Route::get('/daywork_order/{id}', [DayworkOrderController::class, 'loadDayworkOrder'])->name('load.daywork_orders'); //USED TO LOAD DAYWORK ORDER
    Route::get('/daywork_order/edit/{id}', [DayworkOrderEditController::class, 'editDayworkOrder'])->name('edit.daywork_orders'); //USED TO EDIT DAYWORK ORDER
    Route::POST('/daywork_order/save/{id}', [DayworkOrderEditController::class, 'saveEditedDayworkOrder'])->name('save.daywork_orders'); //USED TO SAVE DAYWORK ORDER


    //ITEM MASTER DATA ROUTES
    Route::get('/items', [ItemMasterDataController::class, 'showItemIndex'])->name('item_master_data.index'); //USED TO SHOW ALL ITEMS ON ITEM MASTER DATA PAGE
    Route::post('/replaceitems', [ItemMasterDataController::class, 'replaceItems'])->name('admin.upload'); //USED TO REPLACE ALL ITEMS WITH NEW CSV FILE

    //SEARCH ITEMS ROUTES
    Route::get('/autocomplete', [SearchItemsController::class, 'autocomplete']); //USED TO SHOW AUTOCOMPLETE RESULTS ON CREATE DAYWORKS PAGE
    Route::get('getItemDetails', [SearchItemsController::class, 'getItemDetails']); //USED TO SHOW ITEM DETAILS ON CREATE DAYWORKS PAGE

    //PROJECT INDEX ROUTES
    Route::get('/view/dayworks/{id}', [DayworksIndexController::class, 'showDayworkIndex'])->name('daywork_orders.index');

    //MANAGE ATTACHMENTS ROUTES
    Route::get('/daywork_order/attachments/{id}', [DayworkOrderController::class, 'editAttachments'])->name('edit.attachments');
    Route::post('/daywork_order/attachment/{id}', [DayworkOrderController::class, 'deleteAttachment'])->name('delete.attachment');


    //GENERATE PDF ROUTES
    Route::get('/daywork/order/{id}/print', [DayworkPDFController::class, 'generatePDF'])->name('generate.pdf');
    
    //MANAGE ADMIN ROUTES
    Route::get('/admin', [ManageAdminController::class, 'showUsersMenu'])->name('admin.usersmenu');
    Route::get('/user/edit/{id}', [ManageAdminController::class, 'showUserDetails'])->name('admin.userdetails');
    Route::post('/user/edit/{id}', [ManageAdminController::class, 'updateUserDetails'])->name('admin.updateuserdetails');



//Material Requisition Routes
    Route::get('/material/order/create', [MaterialRequisitionController::class, 'displayCreateForm'])->name('material_requisition.create');
    Route::post('/material/order/create', [MaterialRequisitionController::class, 'createMaterialRequisitionOrder'])->name('material_requisition.store');
});