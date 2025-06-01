<div class="nav flex-column nav-tabs nav-tabs-shadow mb-5 p-2" role="tablist" aria-orientation="vertical">





    <ul class="nav nav-pills">

       
        <li class="nav-item ">
            <a class="nav-link  {{($active_tab == 'lead_history' ? 'active' : '')}}" href="{{route('admin.lead.lead_history',['id'=>$id])}}">
                Lead History
            </a>
        </li>
        
    </ul>
</div>