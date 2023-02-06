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

        <div class="col-lg-4 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Krijo nje Grup-Moshe</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ages.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h6 class="heading-small text-muted mb-4">Detaje</h6>

                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Emri<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name'), "" }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="percentage">Perqindja<span class="small text-danger">*</span></label>
                                        <input type="text" id="percentage" class="form-control" name="percentage" value="{{ old('percentage') }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="p-3"></div>
                                        <h3>%</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col">
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
