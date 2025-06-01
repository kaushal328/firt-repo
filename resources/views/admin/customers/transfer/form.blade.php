@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Transfer To</h4>
        <div>
            <a href="{{route('admin.customer.customer_transfer', ['id' => $id])}}" class="btn btn-primary">Back</a>
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
                    <form class="form ajax_form" id="" method="POST" action="{{route('admin.customer.customer_transfer_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0"></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="transfer_agent_id">Transfer to Agent Name </label>
                                                <select class="form-control select2" name="transfer_agent" data-style="btn-default" id="transfer_agent_id">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($user_agents))
                                                    @foreach($user_agents as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['transfer_agent_id']) && $edit['transfer_agent_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->first_name ." ".$row->last_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="transfer_date">Transfer Date </label>
                                                <input type="text" class="form-control datepicker" id="transfer_date" placeholder="Transfer Date" name="transfer_date" value="{{ isset($edit['transfer_date']) ? date('d-m-Y', strtotime($edit['transfer_date'])) : '' }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="loan_amt">Transfer from Agent Name </label>
                                                <select class="form-control select2" name="transfer_from_agent" data-style="btn-default" id="transfer_from_agent_id" placeholder="Transfer from Agent Name">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                    @if(isset($user_agents))
                                                    @foreach($user_agents as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['transfer_from_agent_id']) && $edit['transfer_from_agent_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->first_name ." ".$row->last_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>

                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="transfer_text">Reason of Transfer </label>
                                                <textarea class="form-control" name="transfer_text">{{$edit['transfer_text'] ?? ""}}</textarea>
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
</div>
@include('admin.common.footer')
<script>
    $(document).ready(function() {
        $(document).on('submit', '.ajax_form', function(e) {
            e.preventDefault();
            clearAjaxErrors();
            const _this = $(this);
            const url = _this.attr('action');
            const data = _this.serializeArray();
            $.post(url, data, function(res) {
                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#transfer_agent_id').select2({
            width: '100%'
        });
        $('#transfer_from_agent_id').select2({
            width: '100%'
        });
    });
</script>
@include('admin.common.end')