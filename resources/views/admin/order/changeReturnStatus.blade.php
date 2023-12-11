@extends('admin.layouts.app')
@section('content')
    <!-- tracking table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>

                                <h5 class="text-danger">Order Status is: {{ $orders->status }}</h5>
                            </div>

                        </div>

                        <a href="{{ url()->previous() }}" class="text-light bg-info btn">Back To Orders</a>
                        <br>
                        <h3>Change Return Status:</h3>
                        <br>
                        <form class="row " action="{{ route('admin.view.order.markAsReturnOrder') }}" method="POST">
                            <input type="hidden" name="id" value="{{ $orders->id }}">
                            @csrf
                            <select class="form-select mb-3" name="status" required aria-label="Default select example">
                                <option value="">Mark Order As</option>
                                <option value="pending">Pending</option>
                                <option value="returned">Return</option>
                                <option value="cancelled">Cancel</option>

                            </select>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Notification/Reason
                                    Message</label>
                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                        <!-- section end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tracking table end -->

    <div class="container-fluid">
        <!-- footer start-->
        <footer class="footer">
            <div class="row">
                <div class="col-md-12 footer-copyright text-center">
                    <p class="mb-0">Copyright 2023 © Damraaz</p>
                </div>
            </div>
        </footer>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected) {
                    $("#exampleFormControlTextarea1").val(`Your Return Order Marked As ${valueSelected}`);
                }
            });
        });
    </script>
@endsection
