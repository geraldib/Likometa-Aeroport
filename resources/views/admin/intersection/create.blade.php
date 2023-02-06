@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    {{--    <h1 class="h3 mb-4 text-gray-800">{{ __('Krijo') }}</h1>--}}

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Krijo nje Degezim</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('intersections.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h6 class="heading-small text-muted mb-4">Detaje</h6>

                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Emri<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name'), "" }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="minutes">Minutat<span class="small text-danger">*</span></label>
                                        <input type="text" id="minutes" class="form-control" name="minutes" value="{{ old('minutes') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="number">Shenja<span class="small text-danger">*</span></label>
                                        <select id="sign" class="form-control" name="sign" value="{{ old('sign') }}" >
                                                <option value="poz">pozitive</option>
                                                <option value="neg">negative</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="road_id">Qyteti<span class="small text-danger">*</span></label>
                                        <select id="road_id" class="form-control" name="road_id" value="{{ old('road_id') }}" >
                                            @foreach($roads as $road)
                                                <option value="{{$road->id}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Ruaj Ndryshimet</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

@endsection
