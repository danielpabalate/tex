@extends('layout')
@section('title', 'View Order')
@section('content')

<ol class="breadcrumb float">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">View Order Details</li>
</ol>

{{-- Back Button at the Top --}}
<div class="mb-3">
    <a href="{{ route('delivery.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

{{-- Order Details Display --}}
<div class="card card-outline details-container">
    <div class="card-header">
        <h3>Order Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h6 class="font-weight-bold d-inline">Order No:</h6>
                <span class="text-dark" style="font-size: 15px;">{{ $order->order_no }}</span>
            </div>
            <div class="col-md-12 mt-2">
                <h6 class="font-weight-bold d-inline">Customer Name:</h6>
                <span class="text-dark" style="font-size: 15px;">{{ $order->customer_name }}</span>
            </div>
            <div class="col-md-12 mt-2">
                <h6 class="font-weight-bold d-inline">Customer Address:</h6>
                <span class="text-dark" style="font-size: 15px;">{{ $order->customer_address }}</span>
            </div>
            <div class="col-md-12 mt-2">
                <h6 class="font-weight-bold d-inline">Branch:</h6>
                <span class="text-dark" style="font-size: 15px;">{{ $order->branch->branch_name }}</span>
            </div>
            <div class="col-md-12 mt-2">
                <h6 class="font-weight-bold d-inline">Assigned Rider:</h6>
                <span class="text-dark" style="font-size: 15px;">{{ $order->assignedUser->name ?? 'Not Assigned' }}</span>
            </div>
            <div class="col-md-12 mt-2">
                <h6 class="font-weight-bold d-inline">Order Status:</h6>
                <span class="badge 
                    @if($order->order_status === 'Processing') bg-warning 
                    @elseif($order->order_status === 'For Delivery') bg-primary 
                    @elseif($order->order_status === 'Delivered') bg-success 
                    @elseif($order->order_status === 'Cancelled') bg-danger 
                    @endif">
                    {{ $order->order_status }}
                </span>
            </div>
            
            {{-- Reason --}}
            @if(!empty($order->reason))
                <div class="col-md-12 mt-2">
                    <h6 class="font-weight-bold d-inline">Reason for cancel:</h6>
                    <span class="text-dark" style="font-size: 15px;">{{ $order->reason }}</span>
                </div>
            @endif

            {{-- File Attachments --}}
            @if(!empty($order->file_paths))
                <div class="col-md-12 mt-2">
                    <h6 class="font-weight-bold d-inline">Proof of Delivery:</h6>
                    <div class="row overflow-auto">
                        <div class="d-flex">
                            @foreach(json_decode($order->file_paths) as $filePath)
                                <div class="col-md-4 mb-3" style="flex: 0 0 auto; width: 33.333%;">
                                    {{-- Fancybox gallery for each ticket --}}
                                    <a href="{{ asset('storage/' . $filePath) }}" data-fancybox="gallery-{{ $order->id }}">
                                        <img src="{{ asset('storage/' . $filePath) }}" class="img-fluid" alt="Order Image" style="cursor: pointer; max-width: 100%; height: auto; border: 2px solid #ddd; border-radius: 4px;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    
    @if($order->order_status === 'For Delivery')
    {{-- Action Buttons Section --}}
    <div class="card-footer">
        <div class="d-flex gap-1 justify-content-end">

            @include('navigation.delivery.delivered')
            @include('navigation.delivery.cancelled')
            
            
        </div>
    </div>
    @endif
</div>




@endsection
