@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$user_id = $edit['user_id'];
$client_name = $edit['client_name'];
$client_phone = $edit['client_phone'];
$di_emi_amount = $edit['di_emi_amount'];
$sales_date = $edit['sales_date'];
$customer_id = $edit['customer_id'];



}else{
$id = '';
$user_id = '';
$client_name = '';
$client_phone = '';
$di_emi_amount = '';
$sales_date = '';


$customer_id = '';

}


@endphp

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="mb-2 d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('admin/dashboard')}}">Dashboad</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/sales-done')}}">Sales Done</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/sales-done')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <form class="form" id="ajax_form" method="POST" route="save-sales-done">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Sales Done Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="user_id">Select Agent</label>
                                            <select class="selectpicker w-100" name="user_name" data-style="btn-default">
                                                <option value="">select</option>
                                                @if(!empty($agent_list) && is_iterable($agent_list))
                                                @foreach($agent_list as $row)
                                                <option value="{{$row->id}}" <?= $user_id == $row->id ? 'selected' : '' ?>>
                                                    {{$row->first_name . " " . $row->last_name}}
                                                </option>
                                                @endforeach

                                                @endif

                                            </select>
                                            <span id="user_name_err" class="error user_name_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="client_name">Client Name</label>
                                            <select class="form-control customer_id" name="customer_id" data-placeholder="Client Name">
                                                <?php
                                                if (isset($edit['customer']) && isset($edit['customer']['customer_name'])) {
                                                    echo "<option value='" . $customer_id . "'>" . $edit['customer']['customer_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <span id="customer_id_err" class="error customer_id_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="client_phone">Client Phone</label>
                                            <input type="text" class="form-control client_phone" id="client_phone" placeholder="Client Phone" name="client_phone" value="{{  isset($edit['customer']) && isset($edit['customer']['mobile']) ? $edit['customer']['mobile'] : '';}}">
                                            <span id="client_phone_err" class="error client_phone_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="di_emi_amount">DI EMI Amount</label>
                                            <input type="text" class="form-control" id="di_emi_amount" placeholder="DI EMI Amount" name="di_emi_amount" value="{{ $di_emi_amount }}">
                                            <span id="di_emi_amount_err" class="error di_emi_amount_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="sales_date">Sales Date</label>
                                            <input type="text" class="form-control datepicker" id="" placeholder="Sales Date" name="sales_date" value="{{ $sales_date }}">
                                            <span id="sales_date_err" class="error sales_date_err small" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success submit-button">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
@include('admin.common.footer')
@include('admin.common.end')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.customer_id').select2({
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('admin.follow_up_tracker.search_client') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            }
        });
        $('.customer_id').on('select2:select', function(e) {
            var data = e.params.data;
            console.log(data)
            $('.client_phone').val(data.mobile);
        });
    });
</script>