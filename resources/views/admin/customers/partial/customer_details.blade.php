<?php

use App\Models\MasterStatus;

$leadStage = [];
if (!empty($edit) && isset($edit['lead']['status'])) {
    $leadStage = MasterStatus::where('id', $edit['lead']['status'])->first();
    $leadStage = $leadStage ? $leadStage->toArray() : [];
} elseif (!empty($edit) && isset($edit['lead_logs']) && isset($edit['lead_logs']['status']))  {
    $leadStage = MasterStatus::where('id', $edit['lead_logs']['status'])->first();
    $leadStage = $leadStage ? $leadStage->toArray() : "";
}
$admin_id = session('admin');
?>
<div class="col-md-4">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col-lg-6">
                        <h4><strong>Customer Details</strong></h4>
                    </div>
                    @if(!in_array(4,explode(',',$admin_id['role'])))
                    <div class="col-lg-5 text-lg-end text-start mt-2 mt-lg-0">
                        <a href="{{ route('admin.customer.form', ['id' =>$id]) }}" class="btn btn-primary btn-sm">
                            Edit Customer
                        </a>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <strong>Customer Id:</strong> #{{$edit['lead']['unique_id'] ?? $edit['Lead_logs']['unique_id']}}
                    </div>
                    <div class="mt-2">
                        <strong>Mobile No:</strong> {{$edit['mobile'] ?? ""}}
                    </div>
                    <div class="mt-2">
                        <strong>Name:</strong> {{$edit['customer_name'] ?? ""}}
                    </div>
                    <div class="mt-2">
                        <strong>Email Id:</strong> {{$edit['email'] ?? ""}}
                    </div>
                </div>

                <!-- Current Address Section -->
                <div class="row mt-4">
                    <div class="col-12 ">
                        <h4><strong>Current Address</strong></h4>
                    </div>
                    <div class="mt-2 mb-2">
                        <strong>Address 1:</strong> {{$edit['address1'] ?? ""}}
                    </div>
                    <div class="mt-2 mb-2">
                        <strong>Address 2:</strong> {{$edit['address2'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>City:</strong> {{$edit['city'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>State:</strong> {{$edit['state']['state_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Country:</strong> {{$edit['country']['country_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Pincode:</strong> {{$edit['pincode'] ?? ""}}
                    </div>
                </div>

                <!-- Permanent Address Section -->
                <div class="row mt-4">
                    <div class="col-12 ">
                        <h4><strong>Permanent Address</strong></h4>
                    </div>
                    <div class="mt-2 mb-2">
                        <strong>Address 1:</strong> {{$edit['permanent_address1'] ?? ""}}
                    </div>
                    <div class="mt-2 mb-2">
                        <strong>Address 2:</strong> {{$edit['permanent_address2'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>City:</strong> {{$edit['city'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>State:</strong> {{$edit['permanent_state']['state_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Country:</strong> {{$edit['permanent_country']['country_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Pincode:</strong> {{$edit['permanent_pincode'] ?? ""}}
                    </div>
                </div>

                <!-- Other Details -->
                <div class="row mt-4">
                    <div class="col-md-6 mt-2 mb-2">
                        <strong>Status:</strong> <span class="badge {{ $edit['is_active'] == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $edit['is_active'] == 1 ? 'Active' : 'De-active' }}
                        </span>
                    </div>
                    <div class="col-md-6  mb-2">
                        <strong>Lead Stage:</strong> <span class="badge bg-success mt-2"> {{$leadStage['status'] ?? ""}}</span>
                    </div>
                    <div class="mt-2 mb-2">
                        <strong>Comment:</strong> {{$edit['comment'] ?? ""}}
                    </div>

                    @if(!empty($edit['lead']) )
                    @if( !in_array(4,explode(',',$admin_id['role'])))
                    <div class=" mt-2 mb-2">
                        <strong>Lead History:</strong>
                        <a href="{{route('admin.lead.lead_history',['id'=>base64_encode($edit['lead_id'] ?? 0) ])}}"> Lead History</a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>