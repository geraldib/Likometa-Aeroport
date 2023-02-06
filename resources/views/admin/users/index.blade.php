@extends('layouts.admin')

@section('main-content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session('user_edited'))
            <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                {{ session('user_edited') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('user_deleted'))
                <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                    {{ session('user_deleted') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        <!-- Users Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Perdoruesit</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Emri</th>
                            <th>Mbiemri</th>
                            <th>Email</th>
                            <th>Numri</th>
                            <th>Rezervimet</th>
                            <th>Ndrysho</th>
                            <th>Fshi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->number}}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('users.view', $user) }}" class="btn btn-primary btn-circle">
                                    <i class="fas fa-bus"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a onclick="getUserClicked({{$user}})" href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $users->links() }}
                    </div>
                </div>
                <span style="padding: 20px 30px;" data-href="/export/users" id="export" class="btn btn-dark btn-sm" onclick="exportTasks(event.target);">EKSPORTO</span>
            </div>
        </div>

        <!-- Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Do you want to Delete <span id="user-fullname">User</span>?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form id="delete-form" method="POST" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script>

        function getUserClicked(user){
            $('#delete-form').attr('action', '/users/'+ user.id +'/delete');
            $('#user-fullname').text(user.name + ' ' + user.surname);
        }

        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }

    </script>

@endsection
