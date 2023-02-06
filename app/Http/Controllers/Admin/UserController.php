<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Services\Admin\UserService;
use App\User;
use \Illuminate\Http\Request;


class UserController extends Controller
{

    function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index()
    {

        try {
            $users = User::where('role', 'u')->paginate(5);
        } catch (Exception $e){
            return $e;
        }

        return view('Admin/users/index', compact('users'));

    }

    public function show(User $user)
    {

        try {
            $bookings = $this->userService->showService($user)->paginate(5);
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/users/show', compact('bookings', 'user'));

    }

    public function edit(User $user)
    {

        return view('Admin/users/edit', compact('user'));

    }

    public function update(UserEditRequest $request, User $user)
    {

        $validatedData = $request->validated();

        try {
            $user = $this->userService->updateService($validatedData, $user);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('user_edited', ''.$user->name.' '.$user->surname.' was Edited!');
        return redirect()->route('users');

    }

    public function delete(User $user)
    {

        try {
            $user->delete();
            $this->userService->deleteUserBookingsService($user);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('user_deleted', ''.$user->name.' '.$user->surname.' was Deleted!');
        return redirect()->route('users');

    }

}
