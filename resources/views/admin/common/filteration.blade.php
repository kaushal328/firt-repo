<?php



?>
<form>
    <div class="row">
        <div class="col-lg-4">
            <label for="title" class="form-label">Client Name</label>
            <input type="text" class="form-control" name="client_name" placeholder="client name" value="<?= isset($client_name) ? $client_name : '' ?>" />
        </div>
        @if(!$restrict ==4)
        <div class="col-lg-4">
            <label for="title" class="form-label">Client Phone no</label>
            <input type="text" class="form-control" name="client_phone_no" placeholder="client phone no" value="<?= isset($client_phone_no) ? $client_phone_no : '' ?>" />
        </div>
        @endif
        <div class="col-lg-4 col-md-4 mb-2">
            <label class="form-label" for="date_range">Date Range</label>
            <select class="form-control" name="date_range" id="date_range">
                <option value="">Select</option>
                <option value="today" {{isset($date_range) && $date_range == 'today' ? 'selected' : ''}}>Today</option>
                <option value="yesterday" {{isset($date_range) && $date_range == 'yesterday' ? 'selected' : ''}}>Yesterday</option>
                <option value="last_7_days" {{isset($date_range) && $date_range == 'last_7_days' ? 'selected' : ''}}>Last 7 days</option>
                <option value="this_month" {{isset($date_range) && $date_range == 'this_month' ? 'selected' : ''}}>This month</option>
                <option value="last_month" {{isset($date_range) && $date_range == 'last_month' ? 'selected' : ''}}>Last month</option>
                <option value="this_year" {{isset($date_range) && $date_range == 'this_year' ? 'selected' : ''}}>This year</option>
                <option value="last_year" {{isset($date_range) && $date_range == 'last_year' ? 'selected' : ''}}>Last year</option>
                <option value="custom" {{isset($date_range) && $date_range == 'custom' ? 'selected' : ''}}>Custom</option>
            </select>
        </div>

        <div class="col-lg-4 col-md-4 mb-2 custom_date_section d-none">
            <label class="form-label" for="from_date">From date</label>
            <input type="text" placeholder="YYYY-MM-DD" class="form-control mydatepicker" name="from_date" value="{{isset($from_date) ? $from_date : ''}}" id="from_date" />
        </div>

        <div class="col-lg-4 col-md-4 mb-2 custom_date_section d-none">
            <label class="form-label" for="to_date">To date</label>
            <input type="text" placeholder="YYYY-MM-DD" class="form-control mydatepicker" name="to_date" value="{{isset($to_date) ? $to_date : ''}}" id="to_date" />
        </div>

        @if(!$restrict ==4 || !$restrict ==3 || $restrict ==2 || $restrict ==1 )
        <div class="col-lg-4">
            <label for="title" class="form-label">Status</label>
            <select name="status" data-id="status" class="selectpicker w-100" data-style="btn-default">
                <option value="">select</option>
                <option value="1" <?php echo $status == '1' ? 'selected' : ''  ?>>Follow-up Done</option>
                <option value="2" <?php echo $status == '2' ? 'selected' : ''  ?>>Rescheduled Follow-up</option>
            </select>
        </div>
        @endif
        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary mt-4">Search</button>
            <a class="btn btn-warning mt-4" href="{{url($url)}}">Reset</a>
        </div>
    </div>
</form>
@section('customScript')
<script>
    $(document).ready(function() {

        $(document).on('change', '[name="date_range"]', function(e) {
            e.preventDefault();
            if ($(this).val() == 'custom') {
                $('.custom_date_section').removeClass('d-none');
            } else {
                $('.custom_date_section').addClass('d-none');
            }
        })

        $('[name="date_range"]').trigger('change')
    })
</script>
<script>
    const mydatepicker = $('.mydatepicker')
    if (mydatepicker.length) {
        mydatepicker.flatpickr({
            dateFormat: 'Y-m-d'
        });
    }
</script>
@endsection