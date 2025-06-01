@include('admin.common.header')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="mb-2 d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboad</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/lead')}}">Lead</a>
                </li>
                <li class="breadcrumb-item active">Lead History</li>
            </ol>
        </nav>
        <div class="">
            <div class="ajax-msg mt-1 mb-1"></div>
            <div class="card mb-3">
                <div class="card-header">Lead History</div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Sr.No</th>
                                <th>Lead Id</th>
                                <th>Customer Detail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($list as $index => $val)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><b>{{$val['unique_id']}}</b></td>
                                <td>{{ $val['customer_name']  }}</td>
                                <td>{{ !empty($val['status']) ? statusName($val['status']) : "Not Select Lead Status"}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.common.footer')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    @include('admin.common.end')