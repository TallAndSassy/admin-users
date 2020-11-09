<?php
Route::middleware(['auth:sanctum', 'verified'])->get(
    '/admin/people/users/{sublevels?}',
    [\TallModSassy\AdminUsers\Http\Controllers\UsersPageController::class, 'getFrontView']
)->name('admin/users');
