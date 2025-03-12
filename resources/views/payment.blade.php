<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bank-option {
            cursor: pointer;
            border: 2px solid transparent;
            padding: 5px;
        }
        .bank-option.selected {
            border-color: #007bff;
        }
        .bank-option img {
            width: 80px;
            height: 70px;
        }
        .custom-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
<div class="container mt-5 custom-container">
    <h2>Confirm Payment</h2>

   @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

    <form method="POST" action="/payments" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Select Bank</label>
            <div class="d-flex">
                <div class="bank-option" data-bank="ABAY Bank">
                    <img src="{{ asset('images/abay.jpeg') }}" alt="aby">
                </div>
                <div class="bank-option" data-bank="AWASH bank">
                    <img src="{{ asset('images/awash.png') }}" alt="awash">
                </div>
                <div class="bank-option" data-bank="CBE">
                    <img src="{{ asset('images/cbe.jpeg') }}" alt="cbe">
                </div>
                <div class="bank-option" data-bank="DASHN Bank">
                    <img src="{{ asset('images/dashn.png') }}" alt="dashen">
                </div>
                <div class="bank-option" data-bank="ZEMEN Bank">
                    <img src="{{ asset('images/zemen.png') }}" alt="zemene">
                </div>
            </div>
            <input type="hidden" name="bank" id="bank" >
            @error('bank')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <input type="hidden" name="user_id" value="1">

        <div class="mb-3">
            <label for="order_id">Order ID</label>
            <input type="text" name="order_id" class="form-control" >
            @error('order_id')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deposited_by">Deposited By</label>
            <input type="text" name="deposited_by" class="form-control" >
            @error('deposited_by')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="transaction_reference">Transaction Reference</label>
            <input type="text" name="transaction_reference" class="form-control" >
            @error('transaction_reference')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="payment_date">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" >
            @error('payment_date')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="receipt_path">Upload Receipt (Optional)</label>
            <input type="file" name="receipt_path" class="form-control">
            @error('receipt_path')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </form>
</div>

<script>
    document.querySelectorAll('.bank-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.bank-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('bank').value = this.getAttribute('data-bank');
        });
    });
</script>
</body>
</html>
