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

    @php
        $timeArr = ["00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00",
                    "12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00","24:00"]
    @endphp

    <!-- Begin Page Content -->

    <div class="row">

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Krijoni nje Linje</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('trips.store') }}" autocomplete="off">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h6 class="heading-small text-muted mb-4">Informacioni per Linjen</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="st_location">Nisja<span class="small text-danger">*</span></label>
                                        <select id="st_location" onchange="firstLocation()" class="form-control" name="st_location" value="{{ old('st_location') }}" >
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="end_location">Destinacioni<span class="small text-danger">*</span></label>
                                        <select id="end_location" onchange="secondLocation()" class="form-control" name="end_location" value="{{ old('end_location') }}" >
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="form-control-label" for="empty_seats">Vendet<span class="small text-danger">*</span></label>
                                        <input type="text" id="empty_seats" class="form-control" name="empty_seats" value="{{ old('empty_seats')}}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="price">Cmimi<span class="small text-danger">*</span></label>
                                        <input type="text" id="price" class="form-control" name="price" value="{{ old('price')}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="heading-small text-muted mb-4">Orari</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="st_time">Ora<span class="small text-danger">*</span></label>
                                        <select id="st_time" class="form-control" name="st_time">
                                            @foreach($timeArr as $time)
                                                <option value="{{$time}}">{{$time}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group focused">
                                        <label style="opacity: 0;">Shto</label>
                                        <button onclick="getTime()" type="button" class="form-control btn btn-primary"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <div id="timeInputs"></div>
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

        <div class="col-lg-4 order-lg-1">

             <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rruget</h6>
                    </div>

                    <div class="card-body">
                        <form method="" action="" autocomplete="off">
                            <div class="registered-roads">
                                @foreach($roads as $road)
                                    <div id="road{{$road->id}}" class="row">
                                        <div class="col-lg-10">
                                            <input style="margin-bottom: 10px;" type="text" class="form-control" value="{{ $road->name }}" disabled>
                                        </div>
                                        <div class="col-lg-2">
                                            <a onclick="deleteNewRoad({{$road->id}})"><i id="deleteBtnIcon" class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <h6 class="heading-small text-muted mb-4">Shto nje Rruge</h6>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Emri<span class="small text-danger">*</span></label>
                                            <input type="text" id="road-name" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <a style="color: white;" onclick="createNewRoad()" class="btn btn-primary">Shto</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

        </div>

    </div>

    <script>

        var inptNum = 0;

        $( document ).ready(function() {
            firstLocation();
            secondLocation();
        });

        function createNewRoad() {
            $.ajax({
                type:'POST',
                url:'/roads/create',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $("#road-name").val()
                },

                success:function(road){
                    $("#st_location").append(new Option(road.name, road.name));
                    $("#end_location").append(new Option(road.name, road.name));
                    $(".registered-roads").append(
                        " <div id=\"road"+road.id+"\" class=\"row\">\n" +
                        "  <div class=\"col-lg-10\">\n" +
                        "  <input style=\"margin-bottom: 10px;\" type=\"text\" class=\"form-control\" value=\""+ road.name +"\" disabled>\n" +
                        "  </div>\n" +
                        "  <div class=\"col-lg-2\">\n" +
                        "  <a onclick=\"deleteNewRoad("+ road.id +")\"><i id=\"deleteBtnIcon\" class=\"fas fa-trash\"></i></a>\n" +
                        "  </div>\n" +
                        "  </div>");
                    $("#road-name").val("");
                }
            });
        }

        function deleteNewRoad(road) {
            $.ajax({
                type: 'DELETE',
                url:'/roads/'+road+'/delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $("#road-name").val()
                },

                success:function(road){
                    $("#st_location option[value='"+road.name+"']").remove();
                    $("#end_location option[value='"+road.name+"']").remove();
                    $("#road"+road.id).remove();
                    $("#road-name").val("");
                }
            });
        }

        function firstLocation(){
            var startLocation = $("#st_location").val();
            if (startLocation != "rinas") {
                $("#end_location").val("rinas");
            }
            if (startLocation == "rinas") {
                $("#end_location").val("fier");
            }
        }

        function secondLocation(){
            var endSelect = $("#end_location").val();
            if (endSelect != "rinas") {
                $("#st_location").val("rinas");
            }
            if (endSelect == "rinas") {
                $("#st_location").val("fier");
            }
        }

        function getTime(){

            inptNum++;

           var selectedTime =  $("#st_time").val();
           $("#timeInputs").append("                <div id=\"time"+inptNum+"\" class=\"row\">\n" +
               "                                        <div class=\"col-lg-6\">\n" +
               "                                            <input name=\"times[]\" style=\"margin-bottom: 10px;\" type=\"text\" class=\"form-control\" value=\""+ selectedTime +"\">\n" +
               "                                        </div>\n" +
               "                                        <div class=\"col-lg-2\">\n" +
               "                                            <button value=\""+ inptNum +"\" class=\"form-control btn btn-outline-danger\" type='button' onclick=\"deleteNewTime(this)\"><i class=\"fas fa-trash\"></i></button>\n" +
               "                                        </div>\n" +
               "                                    </div>");
        }

        function deleteNewTime(id){
            var inptIdNr = $(id).val();
            $("#time"+inptIdNr).remove();
        }

    </script>

@endsection
