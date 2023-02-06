<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Intersection;
use App\Road;
use App\Services\Admin\IntersectionService;
use Illuminate\Http\Request;

class IntersectionController extends Controller
{
    function __construct(IntersectionService $intersectionService) {
        $this->intersectionService = $intersectionService;
    }

    public function index()
    {

        $intersections = Intersection::with('road')->paginate(5);

        return view('Admin/intersection/index', compact('intersections'));

    }

    public function create()
    {

        try{
            $roads = Road::where('name','!=','rinas')->get();
        } catch (Exception $e){
            return $e;
        }

        return view('admin/intersection/create', compact('roads'));

    }

    public function store(Request $request)
    {

        try{
            $intersection = $this->intersectionService->storeService($request);
            $intersection = Intersection::create($intersection);
        } catch (Exception $e){
            return $e;
        }

        session()->flash('intersection_sucess', ''.$intersection->name.' u krijua!');
        return redirect()->route('intersections');

    }

    public function edit(Intersection $intersection)
    {

        try{
            $roads = Road::where('name','!=','rinas')->get();
        } catch (Exception $e){
            return $e;
        }

        return view('Admin/intersection/edit', compact('intersection', 'roads'));

    }

    public function update(Intersection $intersection, Request $request)
    {

        try{
            $intersection = $this->intersectionService->updateService($intersection, $request);
            $intersection->save();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('intersection_edited', ''.$intersection->name.' u ndryshua!');
        return redirect()->route('intersections');

    }

    public function delete(Intersection $intersection)
    {

        try{
            $intersection->delete();
        } catch (Exception $e){
            return $e;
        }

        session()->flash('intersection_deleted', ''.$intersection->name.' u fshi!');
        return redirect()->route('intersections');
    }

}
