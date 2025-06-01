<div class="row">
    <div class="col-md-4">
        <strong>Customer Id: </strong> # {{$customer->lead->unique_id ?? ""}}
    </div>
    <div class="col-md-4 ">
        <strong>Customer Name:</strong> {{$customer->customer_name ?? ""}}
    </div>
    <div class="col-md-4">
        <strong>Mobile No:</strong> {{$customer->mobile ?? ""}}
    </div>


    <div class="col-md-4 mt-2 d-flex align-items-center">
        <strong class="me-2">Lead Stage:</strong>
        @if(!empty($customer->lead->lead_stage->status))
        <button class="btn btn-sm btn-primary px-3 py-1">
            {{ $customer->lead->lead_stage->status }}
        </button>
        @else
        {{""}}
        @endif

      
    </div>
    <div class="col-md-4 mt-2">
            <strong>Email Id:</strong> {{$customer->email ?? ""}}
        </div>


</div>