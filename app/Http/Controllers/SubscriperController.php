<?php

namespace App\Http\Controllers;

use App\Subscriper;
use Illuminate\Http\Request;
use App\Notifications\SubscriperNotification;
use App\User;
use Notification;

class SubscriperController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');
        $subscriper = new Subscriper;
        $subscriper->email = $email;
        $subscriper->save();
        //youe need notifiy admin
        $admin = User::where('name', 'admin')->get();
        //if notifiy muti users or one user can use notiifction send when use
        //user notiify metod can use one user admin is get collelection so use send method
        Notification::send($admin, new SubscriperNotification($subscriper));
        return response()->json($subscriper);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriper  $subscriper
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriper $subscriper) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriper  $subscriper
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriper $subscriper) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriper  $subscriper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriper $subscriper) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriper  $subscriper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriper $subscriper) {
        //
    }

 public   function unreadNotification() {
        $user = auth()->user();
        return $user->unReadNotifications()->get()->toArray();
    }

}
