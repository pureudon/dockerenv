<?php

// Facades
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DatatypeController;

// Resource
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;

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
    return view('welcome');
})->name('welcome');
Route::get('/apple', function () {
    return 'hihi apple';
});
Route::get('/bootstrap5', function () {
    return view('bootstrap5.test');
})->middleware(['auth'])->name('bootstrap5');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::view('profile','profile')->name('profile');
    Route::get('profile',[\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});

require __DIR__.'/auth.php';



# Datatypes
// Route::resource('datatypes', DatatypeController::class);
Route::get('datatypes',[DatatypeController::class, 'index'])->name('datatypes.index');
Route::get('datatypes/create',[DatatypeController::class, 'create'])->name('datatypes.create');
Route::post('datatypes',[DatatypeController::class, 'store'])->name('datatypes.store');
Route::get('datatypes/{id}',[DatatypeController::class, 'show'])->name('datatypes.show');
Route::get('datatypes/{id}/edit',[DatatypeController::class, 'edit'])->name('datatypes.edit');
Route::patch('datatypes/{id}',[DatatypeController::class, 'update'])->name('datatypes.update');
Route::delete('datatypes/{id}',[DatatypeController::class, 'destroy'])->name('datatypes.destroy');

# Company
// Route::resource('company', CompanyController::class);
Route::get('company',[CompanyController::class, 'index'])->middleware(['auth'])->name('company.index');
Route::get('company/create',[CompanyController::class, 'create'])->name('company.create');
Route::post('company',[CompanyController::class, 'store'])->name('company.store');
Route::get('company/{id}/edit',[CompanyController::class, 'edit'])->name('company.edit');
Route::patch('company/{id}',[CompanyController::class, 'update'])->name('company.update');
Route::delete('company/{id}',[CompanyController::class, 'destroy'])->name('company.destroy');
Route::get('company/{id}/duplicate',[CompanyController::class, 'duplicate'])->name('company.duplicate');
Route::post('company/data',[CompanyController::class, 'data'])->name('company.data');
Route::get('groupchangeform',[CompanyController::class, 'groupchangeform'])->name('company.groupchangeform');
Route::post('groupchangefontcolor',[CompanyController::class, 'groupchangefontcolor'])->name('company.groupchangefontcolor');
// company.show place to the last row, conflict with others GET route
Route::get('company/{id}',[CompanyController::class, 'show'])->name('company.show');

# Jobbook Profile
Route::get('jobbookprofile',[\App\Http\Controllers\JobbookProfileController::class, 'index'])->name('jobbookprofile.index');
Route::put('jobbookprofile', [\App\Http\Controllers\JobbookProfileController::class, 'update'])->name('jobbookprofile.update');

# Invoice
// Route::resource('invoice', \App\Http\Controllers\InvoiceController::class);
Route::get('invoice',[\App\Http\Controllers\InvoiceController::class, 'index'])->middleware(['auth'])->name('invoice.index');
Route::get('invoice/create',[\App\Http\Controllers\InvoiceController::class, 'create'])->name('invoice.create');
Route::post('invoice',[\App\Http\Controllers\InvoiceController::class, 'store'])->name('invoice.store');
Route::get('invoice/{invoice}/edit',[\App\Http\Controllers\InvoiceController::class, 'edit'])->name('invoice.edit');
Route::patch('invoice/{invoice}',[\App\Http\Controllers\InvoiceController::class, 'update'])->name('invoice.update');
Route::delete('invoice/{invoice}',[\App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoice.destroy');
Route::get('invoice/{invoice}/duplicate',[\App\Http\Controllers\InvoiceController::class, 'duplicate'])->name('invoice.duplicate');
Route::post('invoice/data',[\App\Http\Controllers\InvoiceController::class, 'data'])->name('invoice.data');
// Route::get('groupchangeform',[\App\Http\Controllers\InvoiceController::class, 'groupchangeform'])->name('invoice.groupchangeform');
// Route::post('groupchangefontcolor',[\App\Http\Controllers\InvoiceController::class, 'groupchangefontcolor'])->name('invoice.groupchangefontcolor');
Route::get('invoice/{invoice}/pdf',[\App\Http\Controllers\InvoiceController::class, 'pdf'])->name('invoice.pdf');
Route::get('invoice/{invoice}/pdf2',[\App\Http\Controllers\InvoiceController::class, 'pdf2'])->name('invoice.pdf2');
Route::get('invoice/{invoice}/pdf3',[\App\Http\Controllers\InvoiceController::class, 'pdf3'])->name('invoice.pdf3');
Route::get('invoice/{invoice}/pdf4',[\App\Http\Controllers\InvoiceController::class, 'pdf4'])->name('invoice.pdf4');

// invoice.show place to the last row, conflict with others GET route
Route::get('invoice/{invoice}',[\App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.show');


Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});
Route::get('/users', function () {
    // return UserResource::collection(User::all());
    // return new UserCollection(User::all());
    // return UserResource::collection(User::all()->keyBy->id);
    return new UserCollection(User::paginate());

    // return (new UserCollection(User::all()->load('roles')))
    //             ->additional(['meta' => [
    //                 'key' => 'value',
    //             ]]);
});

// Route::get('/user', function () {
//     return (new UserResource(User::find(1)))
//                 ->response()
//                 ->header('X-Value', 'True');
// });
