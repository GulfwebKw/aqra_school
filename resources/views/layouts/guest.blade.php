<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
        Iqra'a American School.::. APPLCIATION
    </title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600,700" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
          type="text/css"/>
</head>
<body onkeydown="return (event.keyCode!=13)"  data-theme="light" >


<div class="bg-dark banner" style="height: 100px; vertical-align: central; text-align: center !important;">
    <a class="navbar-brand banner_content" href="#">
        <img src="images/logo.png" class="logo img-fluid" title="Iqra'a American School"
             alt="Iqra'a American School Logo"/></a>
</div>


<div id="loading"></div>
<div class="container">
    @hasSection('content')
        @yield('content')
    @endif
    @if( isset($slot))
        {{ $slot }}
    @endif
</div>

<footer class="py-3 bg-dark float-bottom">
    <div class="container">
        <p class="m-0 text-center text-white">Copyrights © 2020 All Rights Reserved by Iqra'a American School </p>
    </div>
    <!-- /.container -->
</footer>
<!------------------------------------------------------------------------------------------------------------------->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function isNumericKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return true;
        return false;
    }

    $(document).ready(function () {

        var dd = '';
        var mm = '';
        var yyyy = '';
        $("#dob-day").on('focus', function () {
            dd = $("#dob-day option:selected").text();
        }).change(function () {
            dd = $("#dob-day option:selected").text();
            $('#txtDOB').val(mm + '/' + dd + '/' + yyyy);

        });

        $("#dob-month").on('focus', function () {
            mm = $("#dob-month option:selected").val();
        }).change(function () {
            mm = $("#dob-month option:selected").val();
            $('#txtDOB').val(mm + '/' + dd + '/' + yyyy);

        });

        $("#dob-year").on('focus', function () {
            yyyy = $("#dob-year option:selected").text();
        }).change(function () {
            yyyy = $("#dob-year option:selected").text();
            $('#txtDOB').val(mm + '/' + dd + '/' + yyyy);

        });
    });

</script>
</body>
</html>
