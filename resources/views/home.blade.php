@extends('layouts.app')

@section('content')
<div class="section text-center">
    <div class="container">
        <h5>Hey, Good to see you again!</h5>
        <div class="row justify-content-center">
            <div class="col-auto">
                <a href="{{ url('apply-leave') }}" type="button" class="btn-card">
                    <i class="icon-event"></i>
                    <span class="h6 d-block mb-0">Apply Leave</span>
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ url('leaves') }}" type="button" class="btn-card">
                    <i class="icon-list"></i>
                    <span class="h6 d-block mb-0">Leaves</span>
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ url('leave-balance') }}" type="button" class="btn-card">
                    <i class="icon-pie-chart"></i>
                    <span class="h6 d-block mb-0">Leave Balance</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
