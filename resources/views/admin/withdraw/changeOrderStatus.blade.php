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

                                <h5 class="text-danger">Withdraw Status is : {{ $withdraws->status }}</h5>
                            </div>

                        </div>

                        <a href="{{ url()->previous() }}" class="text-light bg-info btn">Back To withdraws</a>
                        <br>
                        <h3>Change Withdraw Status:</h3>
                        <br>
                        <form class="row " action="{{ route('admin.view.withdraw.marked') }}" method="POST">
                            <input type="hidden" name="id" value="{{ $withdraws->id }}">
                            @csrf
                            <select class="form-select mb-3" name="status" required aria-label="Default select example">
                                <option value="">Mark Withdraw As</option>
                                <option value="pending">New Withdraw</option>
                                <option value="approved">Approved Withdraw</option>
                                <option value="cancelled">Cancelled Withdraw</option>
                                <option value="completed">Completed Withdraw</option>


                            </select>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Notification/Reason
                                    Message</label>
                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>


                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Amount</label>
                            @if ($withdraws->withdrawOf == 'Saving')
                            <input class="form-control" name="message" readonly value="{{ $withdraws->amount * 25/100 }}"
                                id="exampleFormControlTextarea1" rows="3" required>

                            @elseif($withdraws->withdrawOf == 'Shop')
                            <input class="form-control" name="message" readonly value="{{ $withdraws->amount * 90/100 }}"
                                id="exampleFormControlTextarea1" rows="3" required>

                            @elseif($withdraws->withdrawOf == 'Branding')
                            <input class="form-control" name="message" readonly value="{{ $withdraws->amount * 95/100 }}"
                                id="exampleFormControlTextarea1" rows="3" required>

                            @else
                            <input class="form-control" name="message" readonly value="{{ $withdraws->amount * 90/100 }}"
                                id="exampleFormControlTextarea1" rows="3" required>

                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Account Title</label>
                            <input class="form-control" name="message" readonly value="{{ $withdraws->account_title }}"
                                id="exampleFormControlTextarea1" rows="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Account No.</label>
                            <input class="form-control" name="message" readonly value="{{ $withdraws->account_no }}"
                                id="exampleFormControlTextarea1" rows="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Payment Type</label>
                            <input class="form-control" name="message" readonly value="{{ $withdraws->payment_type }}"
                                id="exampleFormControlTextarea1" rows="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Bank Name</label>
                            <input class="form-control" name="message" readonly value="{{ $withdraws->bank_name }}"
                                id="exampleFormControlTextarea1" rows="3" required>
                        </div>

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
                    $("#exampleFormControlTextarea1").val(`Your Withdraw Marked As ${valueSelected}`);
                }
            });
        });
    </script>
@endsection
