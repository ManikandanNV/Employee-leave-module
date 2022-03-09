@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <h5 class="text-center">Leave Balance</h5>
        <div class="row align-items-center">
            <div class="col-md-12">   
                <ul class="leave-balance list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Casual Leave
                    <span class="badge bg-success rounded-pill">{{ $leave_balance['cl'] }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Paid Leave
                    <span class="badge bg-primary rounded-pill">{{ $leave_balance['pl'] }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Sick Leave
                    <span class="badge bg-warning rounded-pill">{{ $leave_balance['sl'] }}</span>
                  </li>
                </ul>
            </div>
        </div>        
    </div>            
</div>

@endsection