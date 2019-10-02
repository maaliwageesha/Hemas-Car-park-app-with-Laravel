<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('./css/starter-template.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

        <style>

            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        </style>
    </head>
    <body data-gr-c-s-loaded="true" style="background-image: url('../img/background.jpg')">

        <div class="flex-center position-ref full-height" id="app">


            {{-- <div class="content"> --}}
                <nav class="navbar navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Hemas Hospitals Parking Reservation Posrtal</a>
        <span class="navbar-text">
      Welcome +94 77 588 6997
    </span>
    </nav>
                <main role="main" class="container">

        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div style="margin-top: 135px;">
                    <div class="col-sm-12" id="bkn-btn">
                        <button type="submit" class="btn btn-warning" onclick="selectCatogery(2)" style="width: 230px; height: 80px;">Bookings</button>
                    </div>
                    <div class="col-sm-12" id="com-btn" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-danger" onclick="selectCatogery(1)" style="width: 230px; height: 80px;">complaints</button>
                    </div>
                    <div class="col-sm-12" id="com-btn" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-primary" onclick="openMoal()" style="width: 230px; height: 80px;">End Session</button>
                    </div>
                </div>
            </div>

            <parking-grid></parking-grid>
            <vue-progress-bar></vue-progress-bar>

            <customer-complaint></customer-complaint>
        </div>
        {{-- <parking-grid-user></parking-grid-user> --}}


    </main>
            {{-- </div> --}}
        </div>


    <!-- /.container -->

    {{-- <script type=" " src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <!-- <script src="./js/bootstrap.bundle.min.js "></script> -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}

    <script>
        function selectCatogery(catogery) {
            console.log("cat : " + catogery);
            var cat = catogery;

            if (cat == 1) {
                document.getElementById('grid').style.display = 'none';
                document.getElementById('complaints').style.display = 'block';
            } else {
                document.getElementById('grid').style.display = 'block';
                document.getElementById('complaints').style.display = 'none';
            }
        }
    </script>

    <script>
        // Get the modal
        var modal = document.getElementById("addnewuser");

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        function displayModal(id) {
            $('#addnewuser').modal('show');
        }
        function openMoal() {
            $('#enterPhoneNumber').modal('show');
        }

    </script>

    <script>
        $(document).ready(function () {
            $('#reserved_time').timepicker({
            uiLibrary: 'bootstrap4'
        });
            $('#checkPhoneNumber').on('submit', function (event) {
                event.preventDefault();
                let _token = $('meta[name=csrf-token]').attr('content');
                let phoneOrId = $('#phoneOrId').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('parking.check') }}",
                    data: { _token, phoneOrId },
                    success: function (response) {
                        if (response.status == 400) {
                            swal("Error!", response.message, "error", { timer: 3000 });
                        } else {
                            console.log(response);
                            $('#enterPhoneNumber').modal('hide');
                            $('#cn').text(response.phone_number);
                            $('#in_time').text(response.in_Time);
                            $('#out_time').text(response.out_Time);
                            $('#total_time').text(response.diff);
                            $('#charge').text('LKR ' + response.charges);
                            $('#paymentDetails').modal('show');
                        }

                    }, error: function(err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
    <!-- <iframe frameborder="0 " scrolling="no " style="background-color: transparent; border: 0px; display: none; "
    src="./saved_resource.html "></iframe> -->

    <div id="GOOGLE_INPUT_CHEXT_FLAG " input=" " input_stat="{&quot;tlang&quot;:true,&quot;tsbc&quot;:true,&quot;pun&quot;:true,&quot;mk&quot;:true,&quot;ss&quot;:true} " style="display: none; "></div>

</body>

</html>
