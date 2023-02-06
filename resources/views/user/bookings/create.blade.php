<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-Admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Admin-custom.css') }}" rel="stylesheet">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    {{-- BootStrap CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/non-user-create.css') }}" rel="stylesheet">
</head>

        <div class="form-background"></div>

        <div class="form-front">
            @if (Route::has('login'))
                <nav class="transparent-bg navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="navbar-brand" href="{{ url('/home') }}"><img width="100" height="40" src="../../img/LIKOMETAJ-LOGO.png" /></a>
                            </li>
                        </ul>
                        @auth
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('user.bookings') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Paneli Perdoruesit') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Dilni') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            </ul>
                        @endauth
                    </div>
                </nav>
            @endif

            <div class="container-fluid">
                <div style="margin-bottom: 100px" class="row">
                    <div class="the-info col-md-1"></div>
                    <div class="the-info col-md-4">
                        <div>
                            <p class="the-title">Likometa Aeroport</p>
                            <p class="the-desc">Prenotoni udhetimin tuaj, me trasportin me te shpejt dhe te sigurt!.</p>
                        </div>
                    </div>
                    <div class="the-info col-md-2"></div>
                    <div class="col-md-4">
                        <h3 class="prenote-title">Prenotoni Tani</h3>
                        <div class="booking-form">

                            {{--        Errors     List          --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul id="error-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('user.bookings.store') }}" method="POST" >

                                @csrf

                                <div class="form-1">
                                    <div id="customLocationsStart"></div>
                                    <div class="form-group">
                                        <label for="start">Zgjidh Nisjen</label>
                                        <select name="startSelect" onchange="firstLocation()" class="form-control" id="startSelect" value="{{ old('startSelect') }}" required>
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="end">Zgjidh Destinacionin</label>
                                        <select name="endSelect" onchange="secondLocation()" class="form-control" id="endSelect">
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="customLocationsEnd"></div>
                                    <div class="form-group">
                                        <label for="dateStart">Data e nisjes</label>
                                        <input name="dateStart" type="date" class="form-control" id="dateStart" >
                                    </div>
                                    <div class="form-group">
                                        <label for="timeStart">Orari e nisjes</label>
                                        <select onchange="changeNewTime()" name="timeStart" class="form-control" id="timeStart">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-2">
                                    <div class="form-group">
                                        <label for="fname">Emer</label>
                                        <input name="fname" type="text" class="form-control" id="fname" value="{{ old('fname', $user->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Mbiemer</label>
                                        <input name="lname" type="text" class="form-control" id="lname" value="{{ old('lname', $user->surname) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="text" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="celNr">Numri i Telefonit</label>
                                        <input name="celNr" type="text" class="form-control" id="celNr" value="{{ old('celNr', $user->number) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="persNr">Numri i Personave</label>

                                        <select onchange="getMemberNumb()" name="persNr" id="persNr">

                                        </select>
                                    </div>

                                    <div id="member-forms"></div>

                                    <div class="form-group">
                                        <label for="notes">Shenime</label>
                                        <textarea rows="4" id="note" class="form-control" name="note" placeholder="Shenim"></textarea>
                                    </div>
                                </div>

                                <div class="form-3" style="margin-bottom: 20px">

                                    <div class="card" style="margin-bottom: 20px">
                                        <div class="card-header">
                                            Permbledhje
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Detajet:</h5>
                                            <p  class="card-text">Vendnisja: <span id="locStart"></span></p>
                                            <p  class="card-text">Destinacioni: <span id="locEnd"></span></p>
                                            <p  class="card-text">Data Nisjes: <span id="dtstart"></span></p>
                                            <p  class="card-text">Orari: <span id="tmStart"></span></p>
                                            <div class="form-group">
                                                <label for="price">Cmimi</label>
                                                <h5 class="p-2" style="background-color: #0f6848; color: white; width: 30%; border-radius: 4px;"><span id="priceText"></span> Lek</h5>
                                                <input name="price" type="hidden" class="form-control" id="price" value="{{ old('price') }}">
                                            </div>
                                            <button name="submit" value="submit" type="submit" class="btn btn-primary">Rezervo</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin-bottom: 20px">
                                    <div class="col-md-6">
                                        <div id="prevBtn" class="btn btn-dark" onclick="prevPage()">Kthehu</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="nextBtn" class="btn btn-dark" onclick="nextPage()">Vazhdo</div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="the-info col-md-1"></div>
                    </div>
                </div>
            </div>

            <div id="errorModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="color: #f80909;" class="modal-title">Kujdes!</h5>
                            <button onclick="hideModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="color: #f80909;" id="errorMsg">Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button style="background-color: #f80909;" onclick="hideModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<script>
    var page = 1;

    $( document ).ready(function() {
        var trips = {!! json_encode($trips->toArray()) !!};
        switchPage();
        firstLocation();
        getTripsHours(trips)
    });

    function getEmptyPlaces(){
        $.ajax({
            type:'POST',
            url:'/user/get/emtpy/seats',
            data: {
                "_token": "{{ csrf_token() }}",
                "st_location": $("#startSelect").val(),
                "end_location": $("#endSelect").val(),
                "st_date": $("#dateStart").val(),
                "st_time": $("#timeStart").val(),
            },
            success:function(data) {
                for(var i=1; i<=data; i++){
                    $("#persNr").append(new Option(i, i));
                }
            },
            error: function(xhr, status, error) {
                page = page - 1;
                switchPage();
                obj = JSON.parse(xhr.responseText);
                // alert(obj[0].error);
                $("#errorMsg").text(obj[0].error);
                $("#errorModal").show();
            }
        });
    }

    function getTripsHours(trips){

        $('#timeStart')
            .find('option')
            .remove()
            .end();

        for (var i=0; i<trips.length; i++){
            var startLc = $("#startSelect").val();
            var endLc = $("#endSelect").val();

            if(trips[i].st_location == startLc && trips[i].end_location == endLc){
                var hours = trips[i].hours;
                var price = trips[i].price;

                $('#price').val(price);
                $('#priceText').text(price);

                for(var j=0; j<hours.length; j++){
                    var hour = hours[j].st_time.split(':');
                    $('#timeStart')
                        .append($("<option></option>")
                            .attr("value", hours[j].st_time)
                            .text(hour[0] + ":" + hour[1]));
                }

            }

        }

    }

    function firstLocation(){
        var startLocation = $("#startSelect").val();
        if (startLocation != "rinas") {
            $("#endSelect").val("rinas");
            customStartLocationSelect();
        }
        if (startLocation == "rinas") {
            $("#endSelect").val("fier");
            customEndLocationSelect();
        }
        getTripsHours({!! json_encode($trips->toArray()) !!});
    }

    function secondLocation(){
        var endSelect = $("#endSelect").val();
        if (endSelect != "rinas") {
            $("#startSelect").val("rinas");
            customEndLocationSelect();
        }
        if (endSelect == "rinas") {
            $("#startSelect").val("fier");
            customStartLocationSelect();
        }
        getTripsHours({!! json_encode($trips->toArray()) !!});
    }

    function switchPage(){

        if (page == 1) {
            $(".form-1").show();
            $(".form-2").hide();
            $(".form-3").hide();
            $("#prevBtn").hide();
            $("#nextBtn").show();
            $('#persNr').find('option').remove().end();
            $("#member-forms").empty();
        }

        if (page == 2) {
            $(".form-1").hide();
            $(".form-2").show();
            $(".form-3").hide();
            $("#nextBtn").show();
            $("#prevBtn").show();
            $('#persNr').find('option').remove().end();
            $("#member-forms").empty();
            getEmptyPlaces();
        }

        if (page == 3) {

            var endSelect = $("#endSelect").val();
            var dateStart = $("#dateStart").val();
            var customStTm = $("#cs_time").val();
            var cutomSelect = $("#customSelect").val();
            var startSelect = $("#startSelect").val();
            var timeStart = $("#timeStart").val();

            if(customStTm == null){
                $("#locStart").text(startSelect);
                $("#tmStart").text(timeStart);
            } else {
                $("#locStart").text(cutomSelect);
                $("#tmStart").text(customStTm);
            }

            $("#locEnd").text(endSelect);
            $("#dtstart").text(dateStart);

            calculatePrice();

        }

        if (page == 3) {
            $(".form-1").hide();
            $(".form-2").hide();
            $(".form-3").show();
            $("#nextBtn").hide();
            $("#prevBtn").show();
        }

    }

    function prevPage(){
        page = page - 1;
        switchPage();
    }

    function nextPage(){
        page = page + 1;
        switchPage();
    }

    function hideModal() {
        $("#errorModal").hide();
    }

    function customStartLocationSelect() {
        $("#customLocationsStart").empty();
        $("#customLocationsEnd").empty();
        var startlocVal = $("#startSelect").val();
        var intesections = getIntersections(startlocVal);
        $("#customLocationsStart").append(
            "                                <div class=\"form-group\">\n" +
            "                                    <label style=\"color: #1cc88a;\" for=\"end\">Nisje Sipas Deshires</label>\n" +
            "                                    <select onchange=\"getNewTime()\" style=\"color: #1cc88a;\" name=\"customSelect\" class=\"form-control\" id=\"customSelect\">\n" +
            "                                        <option value=\""+startlocVal+"\">"+startlocVal+"</option>\n" +
            "                                    </select>\n" +
            "                                    <div id=\"new-time\"></div> \n"+
            "                                </div>");
        $.each( intesections, function( index, value ) {
            $("#customSelect").append(new Option(value.name, value.name));
        });
    }

    function customEndLocationSelect() {
        $("#customLocationsStart").empty();
        $("#customLocationsEnd").empty();
        var endlocVal = $("#endSelect").val();
        var intesections = getIntersections(endlocVal);
        $("#customLocationsEnd").append(
            "                                <div class=\"form-group\">\n" +
            "                                    <label style=\"color: #f6c23e;\" for=\"end\">Destinacion Sipas Deshires</label>\n" +
            "                                    <select onchange=\"getNewTime()\" style=\"color: #1cc88a;\" name=\"customSelectEnd\" class=\"form-control\" id=\"customSelect\">\n" +
            "                                        <option value=\""+endlocVal+"\">"+endlocVal+"</option>\n" +
            "                                    </select>\n" +
            "                                </div>");
        $.each( intesections, function( index, value ) {
            $("#customSelect").append(new Option(value.name, value.name));
        });
    }

    function getIntersections(startlocVal) {
        var intersections = null;
        $.ajax({
            type:'POST',
            url:'/user/get/city/intersections',
            async: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "name"  : startlocVal,
            },
            success:function(data) {
                intersections = data;
            }
        });
        return intersections;
    }

    function getNewTime() {
        var startlocVal = $("#customSelect").val();
        var timeSt = $("#timeStart").val();
        $("#new-time").empty();
        if(startlocVal != 'fier'){
            $.ajax({
                type:'POST',
                url:'/user/get/new/time',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name"  : startlocVal,
                    "time"  : timeSt
                },
                success:function(data) {
                    var newTime = data.split(':');
                    $("#new-time").empty();
                    $("#new-time").append("" +
                        "<input " +
                        "name=\"cs_time\" " +
                        "type=\"text\" " +
                        "class=\"form-control\" " +
                        "id=\"cs_time\" " +
                        "value=\""+newTime[0]+":"+newTime[1]+"\" + >");
                }
            });
        }
    }

    function changeNewTime() {
        getNewTime();
    }

    function getMemberNumb() {
        var personNr = $("#persNr").val();
        $("#member-forms").empty();

        if(personNr > 1){
            createMembersInpt(personNr);
        }

    }

    function createMembersInpt(personNr) {

        var ages = {!! json_encode($ages->toArray()) !!};

        $("#member-forms").append("<h5>Antaret: </h5>");

        for (var i=1; i<personNr; i++){
            $("#member-forms").append("          <div id=\"member"+ i +"\" class=\"form-group\">\n" +
                "                                    <label for=\"memberName\">Emri</label>\n" +
                "                                    <input name=\"memberName[]\" type=\"text\" class=\"form-control\" >\n" +
                "                                    @if($errors->has('memberName[]'))\n" +
                "                                        <small style=\"color: #ff0000\">{{ $errors->first('memberName[]') }}</small>\n" +
                "                                    @endif" +
                "                                    <label for=\"memberSurname\">Mbiemri</label>\n" +
                "                                    <input name=\"memberSurname[]\" type=\"text\" class=\"form-control\" >\n" +
                "                                    @if($errors->has('memberSurname[]'))\n" +
                "                                        <small style=\"color: #ff0000\">{{ $errors->first('memberSurname[]') }}</small>\n" +
                "                                    @endif" +
                "                                    <label for=\"member-type"+i+"\">Grup-Mosha</label>\n" +
                "                                    <select onchange=\"changePercentage("+i+")\" id=\"member-type"+i+"\" name=\"memberType[]\">\n" +
                "                                    </select>\n" +
                "                                    @if($errors->has('memberType[]'))\n" +
                "                                        <small style=\"color: #ff0000\">{{ $errors->first('memberType[]') }}</small>\n" +
                "                                    @endif\n" +
                "                                    <input id=\"member-price"+i+"\" type=\"hidden\" value=\"100\">\n" +
                "                                </div>");

            $.each(ages, function( index, value ) {
                $("#member-type"+i).append(new Option(value.name, value.name));
            });

        }

    }

    function changePercentage(memberId){

        var ages = {!! json_encode($ages->toArray()) !!};
        var group_age = $( "#member-type"+memberId).val();

        $.each(ages, function( index, value ) {
            if(value.name == group_age){
                $("#member-price"+memberId).val(value.percentage);
            }
        });

    }

    function calculatePrice(){

        var startLc = $("#startSelect").val();
        var endLc = $("#endSelect").val();
        var trips = {!! json_encode($trips->toArray()) !!};
        var price = 0;

        for (var i=0; i<trips.length; i++){
            if(trips[i].st_location == startLc && trips[i].end_location == endLc){
                price = parseInt(trips[i].price);
            }
        }

        var prsNum = parseInt($("#persNr").val());
        var sum = price;

        for (var i=1; i<prsNum; i++){
            var percentage = parseInt($("#member-price"+i).val());
            sum = sum + ((price*percentage)/100);
        }

        $("#price").val(sum);
        $('#priceText').text(sum);

    }

</script>
