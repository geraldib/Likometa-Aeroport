@extends('layouts.admin')

@section('main-content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session('intersection_sucess'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                {{ session('intersection_sucess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('intersection_edited'))
            <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                {{ session('intersection_edited') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('intersection_deleted'))
            <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                {{ session('intersection_deleted') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

    <!-- Users Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Degezimet</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Emri</th>
                            <th>Minutat</th>
                            <th>Shenja</th>
                            <th>Qyteti</th>
                            <th>Ndrysho</th>
                            <th>Fshi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($intersections as $intersection)
                            <tr>
                                <td>{{$intersection->name}}</td>
                                <td>{{$intersection->minutes}}</td>
                                <td>{{$intersection->sign == 'poz' ? 'pozitive' : 'negative'}}</td>
                                <td>{{$intersection->road->name}}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('intersections.edit', $intersection) }}" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <a onclick="getIntersectionClicked({{$intersection}})" href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $intersections->links() }}
                    </div>
                </div>
                <a href="{{ route('intersections.create') }}" id="addBtnTxt">
                    <strong>Shto nje Degezim</strong>
                    <i id="addBtnIcon" class="fas fa-plus"></i>
                </a>
            </div>
        </div>

        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fshini Degezimin</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Doni te fshini kete Degezim?</div>
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
        function getIntersectionClicked(intersection){
            $('#delete-form').attr('action', '/intersections/'+ intersection.id +'/delete');
        }
    </script>

@endsection
