<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 

    public function index()
    {
        return view('payment');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'bank' => 'required',
            'deposited_by' => 'required',
            'transaction_reference' => 'required|unique:payments',
            'payment_date' => 'required|date',
            'receipt_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('receipt_path')) {
            $formFields['receipt'] = $request->file('receipt_path')->store('receipts', 'public');


            // Save the image path to the database
            $formFields['receipt_path'] = $formFields['receipt'];
        }

        Payment::create($formFields);

        return back()->with('message', 'Payment has been submitted successfully!');
    }


    public function allpayments()
    {
        $payments = Payment::all();
        return view('adminPayment', compact('payments'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $payment = Payment::find($id);
        $payment->status = $request->status;
        $payment->save();
        return back()->with('message', 'Payment status has been updated successfully!');
    }

    public function delete($id)
    {
        // dd($id);
        $payment = Payment::find($id);
        $payment->delete();
        return back()->with('message', 'Payment has been deleted successfully!');
    }
}
