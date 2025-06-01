@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$user_id = $edit['user_id'];
$client_name = $edit['client_name'];
$client_phone = $edit['client_phone'];
$di_emi_amount = $edit['di_emi_amount'];
$ptp_date = $edit['ptp_date'];
$customer_id = $edit['customer_id'];
$status = $edit['status'];
$menu_id = explode(',',$edit['menu_id']);
$sales_target = $edit['sales_target'];
}else{
$id = '';
$user_id = '';
$client_name = '';
$client_phone = '';
$di_emi_amount = '';
$ptp_date = '';
$status = '';
$sales_target = '';
$customer_id = '';
$menu_id = array();
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
                    <a href="{{url('admin/ptp-tracker')}}">PTP Tracker</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/ptp-tracker')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">

                <form class="form" id="ajax_form" method="POST" route="save-ptp-tracker">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id}}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">PTP Tracker Details</h5>
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

                                            <input type="text" class="form-control client_phone" id="client_phone" placeholder="Client Phone" name="client_phone" value="{{  isset($edit['customer']) && isset($edit['customer']['mobile'])
                                                                                                                                                                                ? $edit['customer']['mobile']
                                                                                                                                                                                : '';}}">

                                            <span id="client_phone_err" class="error client_phone_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="di_emi_amount">DI EMI Amount</label>
                                            <input type="text" class="form-control" id="di_emi_amount" placeholder="DI EMI Amount" name="di_emi_amount" value="{{ $di_emi_amount }}">
                                            <span id="di_emi_amount_err" class="error di_emi_amount_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="ptp_date">PTP Date</label>
                                            <input type="text" class="form-control datepicker" id="" placeholder="PTP Date" name="ptp_date" value="{{ $ptp_date }}">
                                            <span id="ptp_date_err" class="error ptp_date_err small" style="color:red;"></span>
                                        </div>


                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="selectpicker w-100" name="status" data-style="btn-default">
                                                <option value="">select</option>
                                                <option value="1" <?= $status == '1' ? 'selected' : '' ?>>PTP Done</option>
                                                <option value="2" <?= $status == '2' ? 'selected' : '' ?>>Rescheduled PTP</option>
                                            </select>
                                            <span class="ajax-error"></span>
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

        // $(document).on('keyup', '#client_name', function() {
        //     let customer_name = $(this).val();
        //     if (customer_name.length == 0) {
        //         $('form').closest('div').find('#client_phone').val('');
        //     }
        //     if (customer_name.length > 1) {
        //         $.ajax({
        //             url: "{{ route('admin.follow_up_tracker.search_client') }}",
        //             method: 'post',
        //             data: {
        //                 customer_name: customer_name
        //             },
        //             dataType: "json",
        //             success: function(response) {
        //                 console.log(response)
        //                 if (response.status > 0) {
        //                     let clientList = '';
        //                     let phone = '';
        //                     let clients = response.data;
        //                     let clientPhone = [];
        //                     $('form').closest('div').find('#client_phone').val('');
        //                     clients.forEach(function(client) {
        //                         clientList += '<div class="client-item mt-3" data-id="' + client.id + '" data-mobile="' + client.mobile + '"><b>' + client.customer_name + '</b></div>';
        //                         clientPhone.push(client.mobile);

        //                     });
        //                     //    phone = response.mobile_no.mobile;

        //                     $('#client_list').html(clientList).show();
        //                     // $('form').closest('div').find('#client_phone').val(phone)
        //                 } else {
        //                     $('#client_list').html('<div class="mt-3" style="color: red;"><b>No clients found</b></div>').show();
        //                     $('form').closest('div').find('#client_phone').val('');
        //                 }
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     } else {
        //         $('#client_list').empty().hide();
        //     }
        // });

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
            var data = e.params.data; // Selected item data
            console.log(data)
            $('.client_phone').val(data.mobile); // Set the phone value to the input field
        });


        // $(document).on('click', '.client-item', function() {
        //     let clientId = $(this).data('id');
        //     let clientMobile = $(this).data('mobile');
        //     let clientName = $(this).text();
        //     $('#client_name').val(clientName);
        //     $('#customer_id').val(clientId);
        //     $('form').closest('div').find('#client_phone').val(clientMobile);
        //     $('#client_list').empty().hide();
        // });




    });
</script>