<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FinaceController;
use App\Http\Controllers\OrphanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ViewOrphanController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\ActionOrphanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UplodeOrphanController;
use App\Http\Controllers\Admin\EmployeeController;



// action orphan route
Route::middleware('auth')->group(function () {

    Route::get('/' , [HomeController::class , 'index'])->name('home');

    Route::post('/orphans/search', [ActionOrphanController::class, 'search'])->name('orphans.action.search');
    Route::post('orphan/approved' , [ActionOrphanController::class , 'approveOrphans'])->name('orphans.action.approve');
    Route::post('orphan/waiting' , [ActionOrphanController::class , 'waitingOrphans'])->name('orphans.action.wait');
    Route::post('orphan/sponsored' , [ActionOrphanController::class , 'sponsorOrphans'])->name('orphans.action.sponsor');
    Route::post('create/sponsorship' , [ActionOrphanController::class , 'addSponsorship'])->name('sponsorship.create');
    Route::post('orphan/archived/{id}' , [ActionOrphanController::class , 'archivedOrphan'])->name('orphans.action.archived');


    Route::post('/orphans/send-email', [ActionOrphanController::class, 'sendEmail'])->name('orphans.email.send');
    Route::delete('orphan/destroy' , [ActionOrphanController::class , 'destroyOrphans'])->name('orphans.action.delete');


    Route::get('orphan/sponsorship' , [SponsorshipController::class , 'index'])->name('orphans.sponsorship.index');
    Route::post('orphan/delivery/sponsorship/' , [SponsorshipController::class , 'deliverySponsorship'])->name('orphans.sponsorship.delivery');

    Route::get('orphan/finance' , [FinaceController::class , 'index'])->name('orphans.finance.index');
    Route::post('orphan/finance/delivery/sponsorship/' , [FinaceController::class , 'deliverySponsorship'])->name('orphans.finance.delivery');
    Route::get('orphan/financial/documents' , [FinaceController::class , 'financialDocuments'])->name('orphans.financial.documents.index');
    Route::post('orphan/financial/documents' , [FinaceController::class , 'financialDocumentsStore'])->name('orphans.financial.documents.store');
    Route::get('orphan/financial/documents/{id}' , [FinaceController::class , 'financialDocumentsDownload'])->name('orphans.financial.documents.download');


    Route::get('/notification' , [NotificationController::class , 'ShowNotification'])->name('notification');



    // view orphan route
    Route::get('orphan/registerd' , [ViewOrphanController::class , 'registerOrphan'])->name('orphan.registerd');
    Route::get('orphan/waiting' , [ViewOrphanController::class , 'waitingOrphan'])->name('orphan.waiting');
    Route::get('orphan/certified' , [ViewOrphanController::class , 'certifiedOrphan'])->name('orphan.certified');
    Route::get('orphan/sponsored' , [ViewOrphanController::class , 'sponsoredOrphan'])->name('orphan.sponsored');


    Route::post('orphan/uplode/excel' , [UplodeOrphanController::class , 'uplodeExcel'])->name('orphan.uplode.excel');
    // Route::post('orphan/uplode/access' , [UplodeOrphanController::class , 'uplodeAccess'])->name('orphan.uplode.access');

    Route::post('orphan/download/pdf' , [DownloadController::class , 'downloadPdf'])->name('orphan.download.pdf');
    Route::post('orphan/download/excel' , [DownloadController::class , 'downloadExcel'])->name('orphan.download.excel');
    Route::post('statement/download/pdf' , [DownloadController::class , 'downloadPdfStatement'])->name('statement.download.pdf');
    Route::post('statement/download/excel' , [DownloadController::class , 'downloadExcelStatement'])->name('statement.download.excel');


    Route::resource('orphan' , OrphanController::class);
    Route::get('orphan/group/create' , [OrphanController::class , 'create_group'])->name('orphan.group.create');
    Route::get('orphan/image/show' , [OrphanController::class , 'showImage'])->name('orphan.show.image');


    Route::resource('employee' , EmployeeController::class)->middleware(['can:is-admin']);

});



Route::get('/clear-all', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');

    return 'All caches cleared!';
});

Route::get('/cache-all', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');


    return 'All caches cached!';
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
