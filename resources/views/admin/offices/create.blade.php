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
                    <h6 class="m-0 font-weight-bold text-primary">Krijo nje Zyre Shitje</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('offices.store') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h6 class="heading-small text-muted mb-4">Informacioni per Zyren</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Emri<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="surname">Mbiemri</label>
                                        <input type="text" id="surname" class="form-control" name="surname" placeholder="Last name" value="{{ old('surname') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email<span class="small text-danger">*</span></label>
                                        <input autocomplete="off" type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email'), "" }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="number">Numri<span class="small text-danger">*</span></label>
                                        <input type="text" id="number" class="form-control" name="number" placeholder="06########" value="{{ old('number') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Fjalkalimi RI</label>
                                        <input autocomplete="new-password" type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Konfirmo Fjalkalimin</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

@endsection
