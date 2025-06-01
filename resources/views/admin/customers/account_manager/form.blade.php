@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Account Manager</h4>
        <div>
            <a href="{{route('admin.customer.account_manager', ['id' => $id])}}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
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
        <div class="col-md-6">
            <div class="row">
                <div class="ajax-msg"></div>
                <form class="form ajax_form" id="" method="POST"
                    action="{{route('admin.customer.account_manager_save')}}">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                    <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Account Manager</h5>
                            </div>
                            <div class="card-body">
                                <div class="row customers">
                                    <div class="col-lg-12 mb-3 ajax-field">
                                        <label class="form-label" for="account_manager_id">Account Manager</label>
                                        <select class="form-control select2" name="account_manager"
                                            data-style="btn-default" id="account_manager_id"
                                            placeholder="Account Manager">
                                            <option value="">
                                                Select
                                            </option>
                                            @foreach(account_manager() as $row)
                                            <option value="{{ $row->id }}" {{ isset($edit['account_manager_id']) &&
                                                $edit['account_manager_id']==$row->id ? 'selected' : '' }}>
                                                {{ $row->first_name ." ".$row->last_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="ajax-error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3 ajax-field">
                                        <label class="form-label" for="loan_amt">Legal Manager</label>
                                        <select class="form-control select2" name="legal_manager"
                                            data-style="btn-default" id="legal_manager_id" placeholder="Legal Manager">
                                            <option value="">
                                                Select
                                            </option>
                                            @foreach(legal_manager() as $row)
                                            <option value="{{ $row->id }}" {{ isset($edit['legal_manager_id']) &&
                                                $edit['legal_manager_id']==$row->id ? 'selected' : '' }}>
                                                {{ $row->first_name ." ".$row->last_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="ajax-error" style="color:red;"></span>
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
@include('admin.common.footer')
<script>
    $(document).ready(function () {
        $(document).on('submit', '.ajax_form', function (e) {
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
    $(document).ready(function () {
        $('#account_manager_id').select2({
            width: '100%'
        });
        $('#legal_manager_id').select2({
            width: '100%'
        });
    });
</script>
@include('admin.common.end')