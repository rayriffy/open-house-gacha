<?php

use Symfony\Component\HttpFoundation\Request;
use App\USER;
use App\ITEM;
use App\HISTORY;

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
    return view('pages.home');
})->name('home');

Route::post('auth', function(Request $request) {
    $ticket = $request["ticket"];
    if (USER::where('ticket', $ticket)->exists()) {
        return redirect()->route('home')->withCookie(cookie('ticketdata', Crypt::encryptString($ticket), 12*60*60));
    }
    else {
        return redirect()->route('home')->with('errorcode', 7001);
    }
})->name('auth');

Route::get('logout', function() {
    return redirect()->route('home')->withCookie(Cookie::forget('ticketdata'));
})->name('logout');

Route::prefix('dashboard')->middleware(['checkauth'])->group(function () {
    Route::get('random', function () {
        $items = ITEM::inRandomOrder()->get();
        $sum = ITEM::get()->sum('amount');
        $random_number = rand(0, $sum);
        foreach ($items as $item) {
            $random_number -= $item["amount"];
            if ($random_number <= 0) {
                $res = $item;
                break;
            }
        }
        return view('pages.dashboard.random.confirm')->with('item', $res);
    })->name('dashboard.random');

    Route::get('item', function () {
        $items = ITEM::get();
        return view('pages.dashboard.item.list')->with('items', isset($items)?$items:null);
    })->name('dashboard.item.list');

    Route::get('item/edit/{ref}', function ($ref) {
        if (!(ITEM::where('ref', $ref)->exists()))
            return 'ERR NOT FOUND';
        $item = ITEM::where('ref', $ref)->first();
        return view('pages.dashboard.item.edit')->with('item', isset($item)?$item:null);
    })->name('dashboard.item.edit');

    Route::get('history', function() {

    });
});

Route::prefix('system')->middleware(['checkauth'])->group(function () {
    Route::post('item/add', function (Request $request) {
        $ref = str_random(64);
        $item = new ITEM;
        $item->ref = $ref;
        $item->name = $request["name"];
        $item->save();
        $trans = new HISTORY;
        $trans->ticket = Crypt::decryptString(Cookie::get('ticketdata'));
        $trans->action = "item.add";
        $trans->item = $ref;
        $trans->amount = 0;
        $trans->save();
        return redirect()->route('dashboard.item.list');
    })->name('system.item.add');

    Route::post('item/take', function (Request $request) {
        $ref = $request["ref"];
        if (!(ITEM::where('ref', $ref)->exists()))
            return 'ERR NOT FOUND';
        $item = ITEM::select('amount')->where('ref', $ref)->first();
        if (ITEM::where('ref', $ref)->update(['amount' => $item["amount"] - 1])) {
            $trans = new HISTORY;
            $trans->ticket = Crypt::decryptString(Cookie::get('ticketdata'));
            $trans->action = "item.take";
            $trans->item = $ref;
            $trans->amount = 1;
            $trans->save();
            return view('pages.dashboard.random.success');
        }
        else
            return 'UNEXPECTED ERROR';
    })->name('system.item.take');

    Route::put('item/edit/{ref}', function ($ref, Request $request) {
        if (!(ITEM::where('ref', $ref)->exists()))
            return 'ERR NOT FOUND';
        if (ITEM::where('ref', $ref)->update($request->except(['_token', '_method']))) {
            $trans = new HISTORY;
            $trans->ticket = Crypt::decryptString(Cookie::get('ticketdata'));
            $trans->action = "item.update";
            $trans->item = $ref;
            $trans->amount = $request["amount"];
            $trans->save();
            return redirect()->route('dashboard.item.list');
        }
        else
            return 'UNEXPECTED ERROR';
    })->name('system.item.update');

    Route::delete('item/delete/{ref}', function ($ref) {
        if (!(ITEM::where('ref', $ref)->exists()))
            return 'ERR NOT FOUND';
        $res = ITEM::where('ref', $ref)->delete();
        $trans = new HISTORY;
        $trans->ticket = Crypt::decryptString(Cookie::get('ticketdata'));
        $trans->action = "item.delete";
        $trans->item = $ref;
        $trans->amount = 0;
        $trans->save();
        return redirect()->route('dashboard.item.list');
    })->name('system.item.delete');
});