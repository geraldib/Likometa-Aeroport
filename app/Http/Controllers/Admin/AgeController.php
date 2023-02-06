<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Age;
use App\Services\Admin\AgeService;
use Illuminate\Http\Request;

class AgeController extends Controller
{

    function __construct(AgeService $ageService) {
        $this->ageService = $ageService;
    }

    public function index()
    {

        $ages = Age::paginate(5);

        return view('Admin/ages/index', compact('ages'));

    }

    public function create()
    {

        return view('admin/ages/create');

    }

    public function store(Request $request)
    {

        try{
            $age = $this->ageService->storeService($request);

            $age = Age::create($age);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('age_sucess', ''.$age->name.' u krijua!');
        return redirect()->route('ages');

    }

    public function edit(Age $age)
    {

        return view('Admin/ages/edit', compact('age'));

    }

    public function update(Age $age,Request $request)
    {

        try{
            $age = $this->ageService->updateService($age, $request);
            $age->save();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('age_edited', ''.$age->name.' u ndryshua!');
        return redirect()->route('ages');

    }

    public function delete(Age $age)
    {

        try{
            $age->delete();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('age_deleted', 'Grup-Mosha '.$age->name.' u fshi!');
        return redirect()->route('ages');
    }

}
