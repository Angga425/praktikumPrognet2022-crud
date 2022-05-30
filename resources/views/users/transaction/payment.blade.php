@extends('users.layout')

@section('content')
<div class="w-full">
    <main id="content" role="main" class="cart-page">
        <div class="container">
            <div class="mt-4">
                <h1 class="text-center">Payment</h1>
            </div>
            <div class="row">
                <div class="col-12 my-5">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                @if ($transaction->status == 'Belum Terbayar')
                                    <h2 class="text-center" id="timeout">Time Out : <strong>00:00:00</strong></h2>
                                    <script>
                                        // make countdown javascript
                                        var countDownDate = new Date("{{ $transaction->timeout }}").getTime();


                                        // Update the count down every 1 second
                                        var x = setInterval(function() {

                                            // Get todays date and time
                                            var now = new Date().getTime();

                                            // Find the distance between now an the count down date
                                            var distance = countDownDate - now;

                                            // Time calculations for days, hours, minutes and seconds
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // Output the result in an element with id="demo"
                                            document.getElementById("timeout").innerHTML = "Time Out : <strong>" + days + "d " + hours + "h " +
                                                minutes + "m " + seconds + "s </strong>";

                                            // If the count down is over, write some text
                                            if (distance < 0) {
                                                clearInterval(x);
                                                document.getElementById("timeout").innerHTML = "Time Out : <strong>EXPIRED</strong>";
                                            }
                                        }, 1000);
                                    </script>
                                @endif
                                <h5>
                                    @if ($transaction->status == 'Expired')
                                        <span class="text-danger">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            Your Payment is Expired
                                        </span>
                                    @elseif ($transaction->status == 'Pending')
                                        <span class="text-warning">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            Your Order is Pending
                                        </span>
                                    @elseif ($transaction->status == 'Success')
                                        <span class="text-success">
                                            <i class="fa fa-check-circle"></i>
                                            Your Payment is Success
                                        </span>
                                    @elseif($transaction->status == 'Dalam Pengiriman')
                                        <span class="text-info">
                                            <i class="fa fa-info-circle"></i>
                                            Your Order is on the way
                                        </span>
                                    @elseif ($transaction->status == 'Dibatalkan')
                                        <span class="text-danger">
                                            <i class="fa fa-times-circle"></i>
                                            Your Order is Canceled
                                        </span>
                                    @elseif ($transaction->status == 'Telah Sampai')
                                        <span class="text-success">
                                            <i class="fa fa-check-circle"></i>
                                            Your Order is Arrived
                                        </span>
                                    @elseif ($transaction->status == 'Belum Terbayar')
                                        <span class="text-danger">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            Your Order is Not Paid
                                        </span>
                                    @endif
                                </h5>
                                <p>Please Transfer your payment into this bank account</p>
                                <p>
                                    <strong>Bank Name</strong> : BCA<br>
                                    <strong>Account Name</strong> : PT. Praktikum Prognet Kelompok 12<br>
                                    <strong>Account Number</strong> : 90384858392<br>
                                </p>
                            </div>
                            <div>
                                <p>
                                    <strong>Note</strong> : Please transfer the exact amount of <strong>Rp.
                                        {{ number_format($transaction->total, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                            @if ($transaction->proof_of_payment != null)
                                <div>
                                    <p>
                                        <strong>Payment Proof</strong> : <br>
                                        <img src="{{ asset('images/proof_payment/' . $transaction->proof_of_payment) }}"
                                            alt="Payment Proof" class="img-fluid">
                                    </p>
                                </div>
                            @elseif($transaction->status == 'Belum Terbayar')
                                <div>
                                    <form action="{{ route('user.proof_payment', $transaction->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="formFile" class="form-label"><strong>Payment Proof</strong> :
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('proof_payment') is-invalid @enderror"
                                                    name="proof_payment" id="proof_payment">
                                                <label class="custom-file-label" for="proof_payment">Choose file</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                    </form>
                                    <div class="mt-3">
                                        <form action="{{ route('user.delete-transaction', $transaction->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block">Cancel
                                                Order</button>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                        var fileName = document.getElementById("proof_payment").files[0].name;
                                        var nextSibling = e.target.nextElementSibling
                                        nextSibling.innerText = fileName
                                    })
                                </script>
                            @endif
                        </div>
                        @if ($transaction->status == 'Telah Sampai')
                            @livewire('product-review-livewire', ['transaction_id' => $transaction->id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
