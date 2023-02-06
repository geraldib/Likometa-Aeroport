@extends('layouts.admin')

@section('main-content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session('trip_edited'))
            <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                {{ session('trip_edited') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('trip_deleted'))
            <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                {{ session('trip_deleted') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

    <!-- Users Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Linjat</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nisja</th>
                            <th>Destinacioni</th>
                            <th>Vendet e Lira</th>
                            <th>Orari</th>
                            <th>Ndrysho</th>
                            <th>Fshi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trips as $trip)
                            <tr>
                                <td>{{$trip->st_location}}</td>
                                <td>{{$trip->end_location}}</td>
                                <td>{{$trip->empty_seats}}</td>
                                <td>
                                    @foreach($trip->hours as $key => $hour)
                                         {{explode(":",$hour->st_time)[0].":".explode(":",$hour->st_time)[1]}}
                                    @endforeach
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('trips.edit', $trip) }}" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a onclick="getTripClicked({{$trip}})" href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $trips->links() }}
                    </div>
                </div>
                <a href="{{ route('trips.create') }}" id="addBtnTxt">
                    <strong>Shto nje Linje</strong>
                    <i id="addBtnIcon" class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fshini Linjen</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Doni te fshini kete linje?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Anullo</button>

                        <form id="delete-form" method="POST" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-danger">Fshi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>
        function getTripClicked(trip){
            $('#delete-form').attr('action', '/trips/'+ trip.id +'/delete');
        }
    </script>

@endsection
