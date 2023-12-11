@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <form method="POST" action="{{ route('phone.verify') }}">
    @csrf
    <input type="text" name="verification_code" placeholder="Verification code">
    <button type="submit">Verify</button>
</form>


</div>
@endsection