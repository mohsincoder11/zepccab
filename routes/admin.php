<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();
    if(Auth::guard('admin')->user()->role=='2'){
        return redirect()->route('all-rides');
    }

    return view('admin.home');
})->name('home');

