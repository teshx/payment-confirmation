<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Confirmations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pagination {
            font-size: 0.8rem;
        }
        .pagination .page-link {
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>
<body>
    
<div class="container mt-5">
    <h2 class="mb-4">Payment Confirmations</h2>
    <table class="table table-bordered">
         @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
        <thead class="thead-dark">
            <tr>
                <th>User ID</th>
                <th>Order ID</th>
                <th>Bank</th>
                <th>Transaction Reference</th>
                <th>Status</th>
                <th>Receipt</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user_id }}</td>
                <td>{{ $payment->order_id }}</td>
                <td>{{ $payment->bank }}</td>
                <td>{{ $payment->transaction_reference }}</td>
                <td>{{ $payment->status }}</td>
                <td>
                    @if($payment->receipt_path)
                        <a href="{{ asset('storage/' . $payment->receipt_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $payment->receipt_path) }}" alt="Receipt" style="max-width: 100px; max-height: 100px;">
                        </a>
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <form action="/payments/{{$payment->id}}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" class="form-control form-control-sm">
                            <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ $payment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Rejected" {{ $payment->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                    </form>
                    <div>
                        <form action="/payments/delete/{{$payment->id}}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>