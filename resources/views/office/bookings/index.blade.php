@extends('layouts.admin')

@section('main-content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session('booking_edited'))
            <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                {{ session('booking_edited') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('booking_deleted'))
            <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                {{ session('booking_deleted') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('booking_pending'))
            <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                {{ session('booking_pending') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('booking_sucess'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('booking_sucess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

    <!-- Users Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rezervimet</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nisja</th>
                            <th>Destinacioni</th>
                            <th>Data</th>
                            <th>Orari</th>
                            <th>Detaje</th>
                            <th>Ndrysho</th>
                            <th>Fshi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->intersection == null ? $booking->st_location : $booking->intersection}}</td>
                                <td>{{$booking->intersection_end == null ? $booking->end_location : $booking->intersection_end}}</td>
                                <td>{{$booking->st_date}}</td>
                                <td>{{$booking->int_time == null ? $booking->st_time : $booking->int_time}}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('office.bookings.show', $booking->id) }}" class="btn btn-primary btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('office.bookings.edit', $booking) }}" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a onclick="getBookingClicked({{$booking}})" href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fshi Rezervimin</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Doni te fshini Rezervimin e bere?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Jo</button>

                        <form id="delete-form" method="POST" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-danger">Fshije</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        function getBookingClicked(booking){
            $('#delete-form').attr('action', '/office/bookings/'+ booking.id +'/delete');
        }
    </script>

@endsection
