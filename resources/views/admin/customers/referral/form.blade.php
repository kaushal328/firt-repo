@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<?php
if ($customer_refernce) {
    $reference = json_decode($customer_refernce->reference_name, true);
} else {
    $reference = [];
}
?>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Refer A Friend</h4>
        <div>
            <a href="{{route('admin.customer.customer_reference', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('admin.customers.partial.customer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="ajax-msg"></div>
                    <form class="form ajax-form" id="" method="POST"
                        action="{{route('admin.customer.customer_reference_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-8 col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0">Refer A Friend</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-12 mb-3">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3 reference-list">
                                                        @if (isset($reference) && count($reference))
                                                        @foreach ($reference as $key => $reference_value)

                                                        <div class="row">
                                                            <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                                                                <label class="form-label">Reference Name</label>
                                                                <input type="text" class="form-control reference_name"
                                                                    name="reference[{{ $key }}][name]"
                                                                    oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')"
                                                                    placeholder="Reference Name"
                                                                    value="{{ $reference_value['name'] }}" />
                                                                <span class="ajax-error" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                                                                <label class="form-label">Phone No</label>
                                                                <input type="text" class="form-control reference_value"
                                                                    name="reference[{{ $key }}][phone_no]"
                                                                    placeholder="Phone No" pattern="\d+" maxlength="10"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                    value="{{ $reference_value['phone_no'] }}" />
                                                                <span class="ajax-error" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                                <label class="form-label">Action</label>
                                                                <button type="button"
                                                                    class="btn btn-warning add-info-dec">-</button>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="row">
                                                            <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                                                                <label class="form-label">Reference Name</label>
                                                                <input type="text" class="form-control reference_name"
                                                                    placeholder="Reference Name"
                                                                    oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')"
                                                                    name="reference[0][name]" />
                                                                <span class="ajax-error" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                                                                <label class="form-label">Phone No</label>
                                                                <input type="text" class="form-control reference_value"
                                                                    pattern="\d+" placeholder="Phone No"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                                    maxlength="10" name="reference[0][phone_no]" />
                                                                <span class="ajax-error" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                                <label class="form-label"></label><br />
                                                                <button type="button"
                                                                    class="btn btn-warning add-info-dec">-</button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="button" class="btn btn-primary add-info-inc">+ Add
                                                            more</button>
                                                    </div>
                                                </div>
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
    </div>
</div>
@include('admin.common.footer')
<script>
    $(document).ready(function () {
        $(document).on('submit', '.ajax-form', function (e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            const data = _this.serializeArray();
            $.post(url, data, function (res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
<script>
    $(document).on('change', '[name="file"]', function (e) {
        var el = $(this)[0];
        var current_this = $(this);
        var uploadType = $(this).data('upload');
        const url = "{{ url('admin/common/upload_files') }}";
        uploadFile(el, uploadType, current_this, url);
    });
</script>
<script>
    $(document).on('click', '.add-info-inc', function () {
        var el = $(this).closest('.row').find('.reference-list .row').eq(0).clone();

        if (!el.length) {
            $('.reference-list').append(`
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                            <label class="form-label">Reference Name</label>
                            <input type="text" class="form-control reference_name" name="reference[0][name]"    placeholder="Reference Name" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" />
                         <span class="ajax-error" style="color:red;"></span>    
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 ajax-field">
                            <label class="form-label">Phone No</label>
                            <input type="text" class="form-control reference_value" pattern="\d+"  placeholder="Phone No" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="reference[0][phone_no]"  maxlength="10"/>
                          <span class="ajax-error" style="color:red;"></span>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1">
                            <label class="form-label"></label><br />
                            <button type="button" class="btn btn-warning add-info-dec">-</button>
                        </div>
                    </div>
                `)
        }

        var clone = el.clone();
        clone.find('input').val('');

        $('.reference-list').append(clone);

        $('.reference-list .row').each(function (i, e) {
            $(this).find('.reference_name').attr('name', 'reference[' + i +
                '][name]');
            $(this).find('.reference_value').attr('name', 'reference[' + i +
                '][phone_no]');
        })
    });
    $(document).on('click', '.add-info-dec', function () {
        // if (rows.length > 1) {
        $(this).closest('.row').remove();
        $('.reference-list .row').each(function (i, e) {
            $(this).find('.reference_name').attr('name', 'reference[' + i +
                '][name]');
            $(this).find('.reference_value').attr('name', 'reference[' + i +
                '][phone_no]');
        })
        // }
        // else {
        //     console.log("You cannot delete last row")
        // }
    });
</script>
@include('admin.common.end')