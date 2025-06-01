@include('admin.common.header')
<!-- Content wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4 class="mb-0"><span class="text-muted fw-light">Dashboard / </span> <a href="{{url('admin/lead')}}">Lead</a> / Lead History</h4>
    </div>
    <div class="row">
        @include('admin.lead.partial.lead_details',['edit'=>$edit])

        <div class="col-md-8">
            @include('admin.lead.partial.nav',['id'=>$id,'active_tab'=>$active_tab])
            <div class="">
                <div class="tab-pane fade active show" id="navs-top-income" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Lead History</h5>



                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered w-100">
                                    <thead class="table-light text-nowrap">

                                        <tr>
                                            <th>Srno</th>
                                            <th>Lead Stage</th>
                                            <th>Comment</th>
                                            <th>Last Updated</th>
                                        </tr>

                                    <tbody>
                                        <?php
                                        $cnt = 0;
                                        ?>
                                        @if(!empty($lead_history) && $lead_history->count() > 0)
                                        @foreach($lead_history as $row)
                                        <tr>
                                            <td>{{++$cnt}}</td>
                                            <td>{{$row->lead_logs_stage->status}}</td>
                                            <td>{{ $row->comment ?? "-"}}</td>
                                            <td>
                                                {{ date('d-m-Y H:i:s',strtotime($row->updated_at)) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9" class="p-3">No data found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        @include('admin.common.footer')
        <script>

        </script>


        @include('admin.common.end')