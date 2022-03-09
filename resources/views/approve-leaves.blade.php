@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <h5 class="text-center">List</h5>
        <div class="row align-items-center">
            @foreach($leaves as $leave)
                <div class="col-md-6">
                    <div class="card">
                        <h6>{{ $leave->name }}</h6>
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
                        @if(! $leave->status) 
                            <div class="row">
                                <div class="col text-center">
                                    <a href="{{ url('/approve') }}/{{ $leave->id }}">
                                        <button type="button" class="btn btn-sm btn-primary">Approve</button>
                                    </a>
                                    <button type="button" onclick="setDeclineId({{ $leave->id }})" data-bs-toggle="modal" data-bs-target="#declineReason" class="btn btn-sm btn-danger">Decline</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>        
    </div>            
</div>
<!-- Modal -->
<div class="modal fade" id="declineReason" tabindex="-1" aria-labelledby="declineReasonLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="declineReasonLabel">Decline Reason</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('decline') }}">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="input-group">
                <label for="email">Reason for decline</label>
                <textarea id="reason" class="form-control" required name="reason"></textarea>
            </div>  
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
    function setDeclineId(id) {
        document.getElementById("id").value = id;
    }
</script>