@include('admin.common.header')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-4">
            <a href="{{ url('admin/customers')}}">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">Total Agents</h5>
                            <span><b>{{$total_agent}}</b></span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <a href="">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">Total Follow-ups</h5>
                            <span><b>{{$total_follow_up}}</b></span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <a href="">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">Total Sales</h5>
                            <span><b>{{$total_sales}}</b></span>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
<!-- / Content -->

@include('admin.common.footer')
@include('admin.common.end')