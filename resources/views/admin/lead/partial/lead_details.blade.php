<?php

use App\Models\MasterStatus;

if (!empty($edit)) {

    $leadStage = MasterStatus::where(['id' => $edit['status']])->first() ?? [];
} else {
    $leadStage = [];
}


?>
<div class="col-md-4">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col-lg-7">
                        <h4><strong>Lead Details</strong></h4>
                    </div>
                    <div class="col-lg-5 text-lg-end text-start mt-2 mt-lg-0">
                        <a href="{{ route('admin.lead.form', ['id' =>$id]) }}" class="btn btn-primary btn-sm">
                            Edit Lead
                        </a>

                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <strong>Lead No:</strong> # {{$edit['unique_id'] ?? "-"}}
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
                        <strong>State:</strong> {{$edit['customer']['state']['state_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Country:</strong> {{$edit['customer']['country']['country_name'] ?? ""}}
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
                        <strong>State:</strong> {{$edit['customer']['permanent_state']['state_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Country:</strong> {{$edit['customer']['permanent_country']['country_name'] ?? ""}}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Pincode:</strong> {{$edit['permanent_pincode'] ?? ""}}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 mt-2 mb-2">
                        <strong>Status:</strong> <span class="badge {{ $edit['is_active'] == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $edit['is_active'] == 1 ? 'Active' : 'De-active' }}
                        </span>
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <strong>Lead Stage: </strong><span class="badge bg-success"> {{$leadStage['status'] ?? ""}}
                    </div>
                    <div class="">
                        <strong>Comment:</strong> {{$edit['comment'] ?? ""}}
                    </div>

                    {{-- <div class="col-md-6 mt-2">
                        <strong>Lead History:</strong>
                        <a href="{{route('admin.customer.lead_history',['lead_id'=>$edit['lead_id'] ?? 0])}}"> Lead History</a>
                </div> --}}
            </div>


        </div>
    </div>
</div>
</div>