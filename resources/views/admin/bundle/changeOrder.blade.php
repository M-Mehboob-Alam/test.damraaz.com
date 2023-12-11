@extends('admin.layouts.app')
@section('content')
    <div id="page_content" style="background-color: white; border-radius:10px; padding:2rem">
        <h5> Order ID: <strong class="text-info">{{$orders->orderId}}</strong></h5>
        <h5> Order Status: <strong class="text-danger">{{$orders->status}}</strong></h5>
        <h5> Bundle Name: <strong class="text-warning">{{$orders->bundle->name}}</strong></h5>
        <h5> User Name: <strong class="text-success">{{$orders->user->username}}</strong></h5>
        
        <form action="{{route('admin.bundle.changeBundleOrdersStatus')}}" method="POST">
            @csrf
            <input type="hidden" name="orderId" value="{{$orders->id}}">
  
  <div class="form-group">
    <label for="exampleFormControlSelect1">Change Status</label>
    <select name="status" required class="form-control" id="exampleFormControlSelect1">
      <option value="">Select Status</option>
      
      <option value="paid">paid</option>
      <option value="pending">pending</option>
      <option value="cancelled">cancelled</option>
      <option value="onDeliver">onDeliver</option>
      <option value="refund">refund</option>
      <option value="delivered">delivered</option>
      
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" required name="message" id="exampleFormControlTextarea1" rows="3">Your Order Marked as </textarea>
  </div>
  
  <input type="submit" value="Submit" class="btn btn-success">
  
</form>
       
    </div>
@endsection




<style>
    .modal-backdrop {
  display: none !important;
}

</style>