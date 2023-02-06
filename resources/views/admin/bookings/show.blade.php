@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
{{--    <h1 class="h3 mb-4 text-gray-800">{{ __('Shiko Rezervimin') }}</h1>--}}

    <div class="row">

        <div class="col-lg-10 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rezervimi</h6>
                </div>

                <div class="card-body">

                        <h6 class="heading-small text-muted mb-4">Informacione</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="st_location">Nisja</label>
                                        <input type="text" id="st_location" class="form-control" value="{{$booking->intersection == null ? $booking->st_location : $booking->intersection}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="end_location">Destinacioni</label>
                                        <input type="text" id="end_location" class="form-control" value="{{$booking->intersection_end == null ? $booking->end_location : $booking->intersection_end}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="st_date">Data</label>
                                        <input type="text" id="st_date" class="form-control" value="{{$booking->st_date}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="st_time">Orari</label>
                                        <input type="text" id="st_time" class="form-control" value="{{$booking->int_time == null ? $booking->st_time : $booking->int_time}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="nr_persons">Numri Personave</label>
                                        <input type="text" id="nr_persons" class="form-control" value="{{$booking->nr_persons}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Emri</label>
                                        <input type="text" id="name" class="form-control" value="{{$booking->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="surname">Mbiemri</label>
                                        <input type="text" id="surname" class="form-control" value="{{$booking->surname}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="number">Numri</label>
                                        <input type="text" id="number" class="form-control" value="{{$booking->number}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="email">Email</label>
                                        <input type="text" id="email" class="form-control" value="{{$booking->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="price">Cmimi</label>
                                        <input type="text" id="price" class="form-control" value="{{$booking->price}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="note">Shenim</label>
                                        <textarea style="text-align: left;" rows="4" class="form-control" disabled>{{$booking->note}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <h6 class="heading-small text-muted mb-4 mt-4">Personat e Rezervuar</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Emri</th>
                                        <th>Mbiemri</th>
                                        <th>Grup-Mosha</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->surname}}</td>
                                            <td>{{$member->age_group}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>


                </div>

                <a id="ticket-btn" href="{{URL::to('/')}}/download/email/{{$booking->id}}">Printoni Bileten</a>

            </div>

        </div>

    </div>

@endsection
