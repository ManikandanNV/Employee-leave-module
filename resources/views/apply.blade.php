@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        
        <div class="row align-items-center">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h5>Apply Leave</h5>
                    @if(Session::has('message'))
                        <div class="alert alert-danger">
                            {{session('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('save') }}">
                        @csrf
                        <div class="input-group">
                            <label for="email">Leave Type</label>
                            
                            <select class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required>
                                <option value="">Select Leave type</option>
                                <option value="1">Casual leave(CL)</option>
                                <option value="2">Sick Leave(SL)</option>
                                <option value="3">Paid Leave(PL)</option>
                                <option value="4">Leave Without Pay</option>
                            </select>

                        </div>  

                        <div class="row">

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="from_date">From Date</label>
                                    
                                    <input id="from_date" type="date" class="form-control @error('from_date') is-invalid @enderror" name="from_date" required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="from_leave_value">Leave Value</label>
                                    
                                    <select class="form-control @error('from_leave_value') is-invalid @enderror" name="from_leave_value" value="{{ old('from_leave_value') }}" required>
                                        <option value="1">Full Day</option>
                                        <option value="2">Half Day</option>
                                    </select>

                                </div>
                            </div>    
                             
                            <div class="col-md-6">
                                <div class="input-group">
                                <label for="to_date">To Date</label>
                                
                                <input id="to_date" type="date" class="form-control @error('to_date') is-invalid @enderror" name="to_date" required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="to_leave_value">Leave Value</label>
                                    
                                    <select class="form-control @error('to_leave_value') is-invalid @enderror" name="to_leave_value" value="{{ old('to_leave_value') }}" required>
                                        <option value="1">Full Day</option>
                                        <option value="2">Half Day</option>
                                    </select>

                                </div>
                            </div> 
                        </div>

                        <div class="input-group mb-2">
                            <label for="remarks">Remarks</label>

                            <textarea id="remarks" class="form-control @error('remarks') is-invalid @enderror" name="remarks"></textarea>

                        </div>    

                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/home') }}">
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>        
    </div>            
</div> 

@endsection