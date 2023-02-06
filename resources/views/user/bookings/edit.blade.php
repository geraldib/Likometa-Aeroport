@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    {{--    <h1 class="h3 mb-4 text-gray-800">{{ __('Ndrysho') }}</h1>--}}

    <div class="row">

        <div class="col-lg-9 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ndrysho Rezervimin</h6>
                </div>

                <div class="card-body">

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

                    <form method="POST" action="{{ route('user.bookings.update', $booking) }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Informacioni Rezervimit</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <div id="customLocationsStart"></div>
                                        <div id="customLocationsEnd"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="startSelect">Nisja<span class="small text-danger">*</span></label>
                                        <select name="startSelect" onchange="firstLocation()" class="form-control" id="startSelect" value="{{ old('startSelect') }}" required>
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="endSelect">Destinacioni<span class="small text-danger">*</span></label>
                                        <select name="endSelect" onchange="secondLocation()" class="form-control" id="endSelect">
                                            @foreach($roads as $road)
                                                <option value="{{$road->name}}">{{$road->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="dateStart">Data<span class="small text-danger">*</span></label>
                                        <input name="dateStart" onchange="getEmptyPlaces()" type="date" class="form-control" id="dateStart" value="{{ old('fname', $booking->st_date) }}" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="timeStart">Orari<span class="small text-danger">*</span></label>
                                        <select name="timeStart" onchange="getEmptyPlaces()" class="form-control" id="timeStart">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="persNr">Numri Personave<span class="small text-danger">*</span></label>
                                        <select onchange="getNewMembers()" class="form-control" name="persNr" id="persNr">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="price">Cmimi<span class="small text-danger">*</span></label>
                                        <input style="display: none" type="text" id="price" class="form-control" name="price" value="{{ old('price') }}">
                                        <h5 class="p-2" style="border-radius: 4px; background-color: #36b9cc; color: white;">
                                            <span id="priceText"></span> LEK
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="fname">Emri<span class="small text-danger">*</span></label>
                                        <input type="text" id="fname" class="form-control" name="fname" placeholder="Emri" value="{{ old('fname', $booking->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="lname">Mbiemri<span class="small text-danger">*</span></label>
                                        <input type="text" id="lname" class="form-control" name="lname" placeholder="Mbiemri" value="{{ old('lname', $booking->surname) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="celNr">Numri Cel<span class="small text-danger">*</span></label>
                                        <input type="text" id="celNr" class="form-control" name="celNr" placeholder="Numri" value="{{ old('celNr', $booking->number) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="email">Email<span class="small text-danger">*</span></label>
                                        <input type="text" id="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', $booking->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group focused">

                                        <div id="member-forms"></div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="note">Shenime</label>
                                        <textarea rows="4" id="note" class="form-control" name="note" placeholder="Shenim">{{ old('note', $booking->note) }}</textarea>
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

    <script>
        var page = 1;
        var trips = {!! json_encode($trips->toArray()) !!};
        var booking = {!! $booking !!};
        getbookingData(booking);
        getTripsHours(trips, booking);
        defaultLocation(booking);
        getMembers();
        getBookingPrice(booking);

        function getEmptyPlaces(){
            $('#persNr').find('option').remove().end();
            var nrPrs = {!! $booking->nr_persons !!};
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
                        if(i != 1){
                            $("#persNr").append(new Option(i, i));
                        } else {
                            $("#persNr").append("<option selected='selected' value='"+i+"'>"+i+"</option>");
                        }
                    }
                    $("#member-forms").empty();
                    var price = getTripPrice();
                    $("#price").val(price);
                    $('#priceText').text(price);
                },
                error: function(xhr, status, error) {
                    page = page - 1;
                    obj = JSON.parse(xhr.responseText);
                    $("#errorMsg").text(obj[0].error);
                    $("#errorModal").show();
                }
            });
        }

        function getTripPrice() {

            for (var i=0; i<trips.length; i++){
                var startLc = $("#startSelect").val();
                var endLc = $("#endSelect").val();

                if(trips[i].st_location == startLc && trips[i].end_location == endLc){

                    var price = trips[i].price;

                    $('#price').val(price);
                    $('#priceText').text(price);

                    return price;

                }

            }

        }

        function getEmptyPlacesDefault(){
            $('#persNr').find('option').remove().end();
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
                    for(var i=1; i<=data + {!! $booking->nr_persons !!}; i++){
                        if(i != {!! $booking->nr_persons !!}){
                            $("#persNr").append(new Option(i, i));
                        } else {
                            $("#persNr").append("<option selected='selected' value='"+i+"'>"+i+"</option>");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    page = page - 1;
                    obj = JSON.parse(xhr.responseText);
                    $("#errorMsg").text(obj[0].error);
                    $("#errorModal").show();
                }
            });

            getNewTime();
        }

        function getTripsHours(trips, booking){
            $('#price').text(null).val(null);

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

                    calculatePrice();

                    for(var j=0; j<hours.length; j++){
                        var hour = hours[j].st_time.split(':');

                        if(hours[j].st_time != booking.st_time){

                            $('#timeStart')
                                .append($("<option></option>")
                                    .attr("value", hours[j].st_time)
                                    .text(hour[0] + ":" + hour[1]));
                        } else {
                            $('#timeStart')
                                .append($("<option></option>")
                                    .attr("value", hours[j].st_time)
                                    .attr("selected", "selected")
                                    .text(hour[0] + ":" + hour[1]));
                        }



                    }

                }

            }

            getEmptyPlacesDefault();
        }

        function getbookingData(booking){
            $("#startSelect").val(booking.st_location);
            $("#endSelect").val(booking.end_location);
        }

        function defaultLocation(booking) {
            var startLocation = $("#startSelect").val();
            if (startLocation != "rinas") {
                customStartLocationSelect();
                $("#customSelect").val(booking.intersection);
                if(booking.int_time != null){
                    getNewTime();
                }
            }
            if (startLocation == "rinas") {
                customEndLocationSelect();
                $("#customSelect").val(booking.intersection_end);
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

            getTripsHours(trips, booking);
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

            getTripsHours(trips, booking);
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

        function getBookingPrice(booking){
            $("#price").val(booking.price);
            $('#priceText').text(booking.price);
        }

        function getMembers() {

            var members = {!! json_encode($members->toArray()) !!};
            var ages = {!! json_encode($ages->toArray()) !!};

            if(members.length > 0){

                $("#member-forms").append("<h5>Antaret: </h5>");

                for (var i=0; i < members.length; i++) {
                    members[i].age_group
                    $("#member-forms").append("          <div id=\"member" + i + "\" class=\"form-group\">\n" +
                        "                                    <label for=\"memberName\">Emri</label>\n" +
                        "                                    <input name=\"memberName[]\" type=\"text\" class=\"form-control\" value=\""+members[i].name+"\" >\n" +
                        "                                    <label for=\"memberSurname\">Mbiemri</label>\n" +
                        "                                    <input name=\"memberSurname[]\" type=\"text\" class=\"form-control\" value=\""+members[i].surname+"\" >\n" +
                        "                                    <label for=\"member-type" + i + "\">Grup-Mosha</label>\n" +
                        "                                    <select onchange=\"changePercentage(" + i + ")\" id=\"member-type" + i + "\" name=\"memberType[]\">\n" +
                        "                                    </select>\n" +
                        "                                    <input id=\"member-price" + i + "\" type=\"hidden\" >\n" +
                        "                                </div>");

                    $.each(ages, function (index, value) {
                        if(value.name ==  members[i].age_group){
                            $("#member-price" + i).val(value.percentage);
                            $("#member-type" + i).append("<option value=\""+value.name+"\" selected=\"selected\">"+value.name+"</option>");
                        } else {
                            $("#member-type" + i).append("<option value=\""+value.name+"\">"+value.name+"</option>");
                        }
                    });
                }

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

            calculatePrice();

        }

        function calculatePrice(){

            var startLc = $("#startSelect").val();
            var endLc = $("#endSelect").val();
            var trips = {!! json_encode($trips->toArray()) !!};
            var price = 0;
            var percentage = 0;

            for (var i=0; i<trips.length; i++){
                if(trips[i].st_location == startLc && trips[i].end_location == endLc){
                    price = parseInt(trips[i].price);
                }
            }

            var prsNr =  parseInt($("#persNr").val());
            var sum = price;


            for (var i=0; i<prsNr - 1; i++){
                percentage = parseInt($("#member-price"+i).val());
                sum = sum + ((price*percentage)/100);
            }

            $("#price").val(sum);
            $('#priceText').text(sum);

        }

        function getNewMembers(){

            $("#member-forms").empty();

            var ages = {!! json_encode($ages->toArray()) !!};
            var prsNr = parseInt($("#persNr").val());

            if(prsNr > 1){

                $("#member-forms").append("<h5>Antaret: </h5>");

                for (var i=0; i < prsNr - 1; i++) {
                    $("#member-forms").append("          <div id=\"member" + i + "\" class=\"form-group\">\n" +
                        "                                    <label for=\"memberName\">Emri</label>\n" +
                        "                                    <input name=\"memberName[]\" type=\"text\" class=\"form-control\" >\n" +
                        "                                    <label for=\"memberSurname\">Mbiemri</label>\n" +
                        "                                    <input name=\"memberSurname[]\" type=\"text\" class=\"form-control\" >\n" +
                        "                                    <label for=\"member-type" + i + "\">Grup-Mosha</label>\n" +
                        "                                    <select onchange=\"changePercentage(" + i + ")\" id=\"member-type" + i + "\" name=\"memberType[]\">\n" +
                        "                                    </select>\n" +
                        "                                    <input id=\"member-price" + i + "\" type=\"hidden\" value=\"100\">\n" +
                        "                                </div>");

                    $.each(ages, function( index, value ) {
                        $("#member-type"+i).append(new Option(value.name, value.name));
                    });

                }

            }

            calculatePrice();

        }

    </script>

@endsection
