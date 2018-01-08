<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))
        ->firstOrFail()
        ->confirm();
        return redirect('/threads')
        ->with('flash', 'Your account is now confirmed! You may post to the forum');
    }
}
