<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Redirect;
use SocialAuth;

class SocialController extends Controller
{

    public function github_authorize()
    {
        return SocialAuth::authorize('github');
    }

    public function github_login()
    {
        try {
            SocialAuth::login('github', function ($user, $details) {
                $user->username = $details->nickname;
                $user->name = $details->full_name;
                $user->image_url = $details->avatar;
                $user->email = $details->email;
                $user->save();
            });
        } catch (ApplicationRejectedException $e) {
            // User rejected application
            return redirect('login');
        } catch (InvalidAuthorizationCodeException $e) {
            // Authorization was attempted with invalid
            // code,likely forgery attempt
            return redirect('login');
        }
        return redirect()->intended();
    }
}
