@extends('layouts.app')

@section('content')
<div class="container" style="padding: 50px; text-align: center;">
    <div style="font-size: 60px; color: #4CAF50; margin-bottom: 20px;">✓</div>
    <h1>Thank You!</h1>
    <p>Your order has been placed successfully.</p>
    <p>You will receive a confirmation email shortly.</p>
    
    <div style="margin-top: 30px;">
        <a href="{{ route('home') }}" style="background: #e91e63; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Continue Shopping</a>
    </div>
</div>
@endsection
