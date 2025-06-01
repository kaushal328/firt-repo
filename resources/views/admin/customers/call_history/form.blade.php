@include('admin.common.header')
<style>
    .flatpickr-calendar.hasTime.noCalendar.animate.arrowTop.arrowLeft.open {
        width: 22.5% !important;
    }
</style>
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> Customer / Call History</h4>
        <div>
            <a href="{{route('admin.customer.customer_call_history', ['id' => $id])}}" class="btn btn-primary">Back</a>
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
                        action="{{route('admin.customer.customer_call_history_save')}}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{$edit['customer_id'] ?? base64_decode($id) }}">
                        <input type="hidden" name="id" value="{{$edit['id'] ?? ''}}">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-tile mb-0">Call History</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row customers">
                                        <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="call_date">Call Connect Date (DD-MM-YYY)</label>
                                                <input type="text" class="form-control datepicker" id="call_date" placeholder="Call Connect Date (DD-MM-YYY)" name="call_date" value="{{ isset($edit['call_date']) ? date('d-m-Y', strtotime($edit['call_date'])) : '' }}">
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="stage_id">Stage</label>
                                                <select class="form-control select2" name="stage" data-style="btn-default" id="stage_id">
                                                   
                                                    @if(isset($stage))
                                                    @foreach($stage as $row)
                                                    <option value="{{ $row->id }}" {{ isset($edit['stage_id']) && $edit['stage_id'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->stage_name }}
                                                    </option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-4 mb-3 ajax-field">
                                                <label class="form-label" for="disposition_id">Disposition </label>
                                                <select class="form-control select2 disposition_id" name="disposition" data-style="btn-default" id="disposition_id" data-selected="{{ $edit['disposition_id'] ?? "" }}">
                                                    <option value="">
                                                        Select
                                                    </option>
                                                </select>
                                                <span class="ajax-error" style="color:red;"></span>
                                            </div>
                                            <div class="col-lg-6 mb-3 ajax-field">
                                                <label class="form-label" for="remark">Remark</label>
                                                <textarea type="text" class="form-control " id="remark" placeholder="Remark" name="remark"  maxlength="1000" rows="5" >{{ isset($edit['remark']) ? $edit['remark'] : '' }}</textarea>
                                                <span class="ajax-error" style="color:red;"></span>
                                                      <span class="banner_text_length" style="color: green;">{{strlen($edit['remark'] ?? "")}}</span> / 1000 Max Characters
                                                <br>
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
        $(document).on('submit', '.ajax-form', function(e) {
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
        $('#stage_id').select2({
            width: '100%'
        });
        $('#disposition_id').select2({
            width: '100%'
        });
    });
</script>
<script>

$(document).on('change','#stage_id',function() {
    var stageId = $(this).val();  
    if (stageId) {
        $.ajax({
            url: "{{ route('admin.customer.get_dispositon') }}", 
            type: "GET",
            data: { stage_id: stageId },  
            dataType: "json",
            success: function(response) {
                $('.disposition_id').empty();
                if (response.status == 1) {
                    $.each(response.data, function(index,row ) {
                        $('.disposition_id').append('<option value="' + row.id + '">' + row.name + '</option>');
                    });
                } else {
                    $('.disposition_id').append('<option value="">No Dispositon Found</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching subcategories:', error);
            }
        });
    } else {
     
        $('.disposition_id').empty();
        $('.disposition_id').append('<option value="">Select</option>');
    }
});

   var selected = $('.disposition_id').data('selected');
   if (selected) {
                            setTimeout(function() {
                                $('#stage_id').trigger('change'); 
                            }, 100);  
                        }
</script>
<script>
   
    $(document).ready(function() {
        $('#remark').bind('keyup', function(e) {
            if ($(this).val().length <= '1000') {
                $('.banner_text_length').html(($(this).val().length)).css('color', 'green');
            } else {
                $('.banner_text_length').html(($(this).val().length)).css('color', 'red');
            }
        });
    })
</script>






@include('admin.common.end')