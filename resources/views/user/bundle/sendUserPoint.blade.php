@extends('layouts.app')
@section('title')
   Send User Points
@endsection

@section('content')
   <div class="container my-3 p-5 rounded shadow">
        <h1 class="text-center">Send User Points <a href="{{ url()->previous() }}" class="btn btn-warning">Back To Home</a></h1>
        <div class="container">
            <form action="{{ route('sendUserPointToUser') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Enter User Name</label>               
                    <input type="search"  required name="username" class="form-control @error('username') is-invalid @enderror" id="username">
                    <div id="username_msg"></div>
                   
                </div>
                <div class="form-group">
                    <label for="">Enter Points <span class="text-danger">You have Points {{ $points }}</span></label>
                    <input type="number" name="points" id="points" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Enter Your Username for confirmation</label>
                    <input type="text" name="confirmation" id="confirmation" class="form-control" required>
                </div>
                <button id="register_verify" class="btn btn-danger my-2">Submit</button>
            </form>
        </div>
   </div>
   <input type="hidden" value="{{ $points }}" name="getPoints" id="getPoints">
   <input type="hidden" value="{{ auth()->user()->username }}" id="getUsername" name="getUsername">

   @push('scripts')
   <script>
    var verifyUserPoints = false;
    var verifyConfirmation = false;
    var verifyUsername = false;
   
$(document).ready(function() {
    // verifyUsername = true;
    $("#username").on('keyup', function() {
        var username = $('#username').val();
        // console.log(username);
        if (username !== "") {
            // console.log(username);
            $.ajax({
                type: 'get',
                url: "{{ route('otherUserSearching') }}",
                data: {
                    'username': username
                },
                success: function(data) {
                    console.log(data);

                    if (data.username != 'none') {
                        $("#username").val(data.username);
                        $("#username_msg").empty().append(`This username is exits`);
                        $("#username_msg").addClass("text-success");
                        $("#username_msg").removeClass("text-danger");
                        verifyUsername = true;
                    } else {
                        $("#username_msg").empty().text('This username is not exists');
                        $("#username_msg").removeClass("text-success");
                        $("#username_msg").addClass("text-danger");
                        verifyUsername = false;
                    }

                }

            });
        }
    });
   
    $('button').click(function(e){
        // alert('working');
        var getPoints = $("#getPoints").val();
        var getUsername = $("#getUsername").val();
        var points = $("#points").val();
            getPoints = getPoints - 1000;
        var confirmation = $("#confirmation").val();
        if(getPoints >= points){
            // alert('you do not have enough points please enter less points');
            verifyUserPoints = true;
        }
        if(getUsername  === confirmation){
            verifyConfirmation = true;
        }
       
        if(verifyConfirmation && verifyUserPoints  && verifyUsername){
            $('#register_verify').prop('disabled', false);  
           
           
        }else{
            $('#register_verify').prop('disabled', false);
            e.preventDefault();
            if(!verifyUsername){
                alert('please enter correct username');
            }    
            if(!verifyUserPoints){
                alert('you do not have enough points please enter less points');
            }    
            if(!verifyConfirmation){
                alert('please enter correct username for confirmation');
            }    
        }
       
    });
});
</script>
   @endpush
@endsection
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bulk-style.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"> --}}
