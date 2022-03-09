@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <h5 class="text-center">Leaves</h5>
        <div class="row align-items-center">
            @foreach($leaves as $leave)
                <div class="col-md-6">
                    <div class="card">
                        <div class="row mb-2">
                            <div class="col">
                                <strong>{{ $leave->from_date }} - {{ $leave->to_date }}</strong><br/>
                                @if($leave->status == 1) 
                                     <span class="badge bg-success">Approved</span>
                                @elseif($leave->status == 2) 
                                    <span class="badge bg-danger">Declined</span>
                                @else
                                    <span class="badge bg-warning">Waiting Approval</span>
                                @endif
                            </div>
                            <div class="col-auto">
                                <strong>{{ $leave->leaves }} Day(s)</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-lg-4 mb-2">
                                <label>DOC NO</label>
                                <div>{{ $leave->id }}</div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <label>Applied Date</label>
                                <div>{{ $leave->created_at }}</div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <label>Leave Type</label>
                                @if($leave->type == 1)
                                    <div>Casual Leave</div>
                                @elseif($leave->type == 2)
                                    <div>Sick Leave</div>
                                @elseif($leave->type == 3)
                                    <div>Paid Leave</div>
                                @else 
                                    <div>Leave Without Pay</div>
                                @endif
                            </div> 
                            <div class="col-12 col-lg-6 mb-2">
                                <label>Remarks</label>
                                <div>{{ $leave->remarks ?? '-' }}</div>
                            </div>    
                            @if($leave->status == 2) 
                            <div class="col-12 col-lg-6 mb-2">
                                <label>Decline Reason</label>
                                <div>{{ $leave->reason ?? '-' }}</div>
                            </div>
                            @endif   
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
    </div>            
</div>

@endsection