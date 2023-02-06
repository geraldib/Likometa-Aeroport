<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function adminAccess()
    {
        if(Auth::user()->isAdmin()){
            return true;
        } else {
            return false;
        }
    }

    public function officeAccess()
    {
        if(Auth::user()->isOffice()){
            return true;
        } else {
            return false;
        }
    }

    public function userAccess()
    {
        if(Auth::user()->isUser()){
            return true;
        } else {
            return false;
        }
    }

}
