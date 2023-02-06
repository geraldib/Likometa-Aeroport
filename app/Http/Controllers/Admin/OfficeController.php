<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Booking;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Services\Admin\OfficeService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OfficeController extends Controller
{

    function __construct(OfficeService $officeService) {
        $this->officeService = $officeService;
    }

    public function index()
    {

        try {
            $offices = $this->officeService->indexService()->paginate(5);
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/offices/index', compact('offices'));

    }

    public function show(User $office)
    {

        try {
            $bookings = $this->officeService->showService($office)->paginate(5);
        } catch (Exception $e) {
            return $e;
        }

        return view('Admin/offices/show', compact('bookings', 'office'));

    }

    public function create()
    {
        return view('Admin/offices/create');
    }

    public function store(UserCreateRequest $request)
    {

        $validatedData = $request->validated();

        try{
            $office = $this->officeService->storeService($validatedData);
            $office = User::create($office);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('office_stored', ''.$office->name.' '.$office->surname.' u krijua!');
        return redirect()->route('offices');

    }

    public function edit(User $office)
    {
        return view('Admin/offices/edit', compact('office'));
    }

    public function update(User $office, UserEditRequest $request)
    {

        $validatedData = $request->validated();

        try{
            $office = $this->officeService->updateService($office, $validatedData);
            $office->save();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('office_edited', ''.$office->name.' '.$office->surname.' u ndryshua!');
        return redirect()->route('offices');

    }

    public function delete(User $office)
    {

        try{
            $office->delete();
            $this->officeService->deleteService($office);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('office_deleted', ''.$office->name.' '.$office->surname.' u fshi!');
        return redirect()->route('offices');
    }

}
