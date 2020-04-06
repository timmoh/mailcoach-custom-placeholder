<?php

use Timmoh\MailcoachCustomPlaceholder\Http\App\Controllers\EmailLists\PlaceholdersController;

Route::prefix('email-lists')->group(function () {
    Route::prefix('{emailList}')->group(function () {
        Route::prefix('placeholders')->group(function () {
            Route::get('/', ['\\' . PlaceholdersController::class, 'index'])->name('mailcoach.emailLists.placeholders');
            Route::post('/', ['\\' . PlaceholdersController::class, 'store'])->name('mailcoach.emailLists.placeholder.store');
            Route::prefix('{placeholder}')->group(function () {
                Route::get('/', ['\\' . PlaceholdersController::class, 'edit'])->name('mailcoach.emailLists.placeholder.edit');
                Route::put('/', ['\\' . PlaceholdersController::class, 'update']);
                Route::delete('/', ['\\' . PlaceholdersController::class, 'destroy'])->name('mailcoach.emailLists.placeholder.delete');
                Route::post('duplicate', ['\\' . PlaceholdersController::class, 'duplicate'])->name('mailcoach.emailLists.placeholder.duplicate');
            });
        });
    });
});
