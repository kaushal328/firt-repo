@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$bank_type_id = $edit['bank_type_id'];
$creditors_name = $edit['creditors_name'];
$phone_no = $edit['phone_no'];
$remark = $edit['remark'];


}else{
$id = '';

$creditors_name = '';
$bank_type_id = '';
$phone_no = '';
$remark = '';
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
                    <a href="javascript:void(0);">Master</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('admin/master/bank-creditor')}}">Bank Creditor</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/master/bank-creditor')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">

                <form class="form" id="ajax_form" method="POST" route="bank-creditor-save">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Bank Creditors Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="creditors_name">Creditors name</label>
                                            <input type="text" class="form-control" id="creditors_name"
                                                placeholder="Creditors name" name="creditors_name"
                                                value="{{ $creditors_name }}">


                                            <span id="creditors_name_err" class="error creditors_name_err small"
                                                style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="phone_no">Creditors phone</label>
                                            <input type="text" class="form-control" id="phone_no"
                                                placeholder="Creditors phone no" name="phone_no"
                                                value="{{ $phone_no }}">
                                            <span id="phone_no_err" class="error phone_no_err small"
                                                style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="bank_type_id">Select bank type</label>
                                            <select class="selectpicker w-100" name="bank_type"
                                                data-style="btn-default">
                                                <option value="">select</option>
                                                @foreach($bank_type as $row)
                                                <option value="{{$row->id}}" <?= $bank_type_id==$row->id ? 'selected' :
                                                    '' ?>>{{$row->bank_type_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error bank_type_err ajax-error"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="remark">Remark</label>
                                            <textarea class="form-control" name="remark" id="remark"
                                                placeholder="remark">{{$remark}}</textarea>
                                            <span class="error remark_err ajax-error"></span>
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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('keyup', '#creditors_name', function () {
            let customer_name = $(this).val();
            if (customer_name.length == 0) {
                $('form').closest('div').find('#client_phone').val('');
            }
            if (customer_name.length > 1) {
                $.ajax({
                    url: "{{ route('admin.follow_up_tracker.search_client') }}",
                    method: 'post',
                    data: {
                        customer_name: customer_name
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        if (response.status > 0) {
                            let clientList = '';
                            let phone = '';
                            let clients = response.data;
                            let clientPhone = [];
                            $('form').closest('div').find('#client_phone').val('');
                            clients.forEach(function (client) {
                                clientList += '<div class="client-item mt-3" data-id="' + client.id + '" data-mobile="' + client.mobile + '"><b>' + client.customer_name + '</b></div>';
                                clientPhone.push(client.mobile);

                            });
                            //    phone = response.mobile_no.mobile;

                            $('#client_list').html(clientList).show();
                            // $('form').closest('div').find('#client_phone').val(phone)
                        } else {
                            $('#client_list').html('<div class="mt-3" style="color: red;"><b>No clients found</b></div>').show();
                            $('form').closest('div').find('#client_phone').val('');
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#client_list').empty().hide();
            }
        });




        $(document).on('click', '.client-item', function () {
            let clientId = $(this).data('id');
            let clientMobile = $(this).data('mobile');
            let clientName = $(this).text();
            $('#creditors_name').val(clientName);
            $('#customer_id').val(clientId);
            $('form').closest('div').find('#client_phone').val(clientMobile);
            $('#client_list').empty().hide();
        });




    });
</script>