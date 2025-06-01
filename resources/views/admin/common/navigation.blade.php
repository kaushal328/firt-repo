@php
$active = $active ?? 'dashboard';
$subactive = $subActive ?? '';
$admin_id = session('admin');

@endphp
<ul class="menu-inner py-1">
    <!-- Dashboards -->
    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{config('global.active_tab') == 'dashboard' ? 'active' : ''}}">
        <a href="{{url('admin/dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-dashboard"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>
    @endif

    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'users_list' ? 'active' : '')}}">
        <a href="{{url('admin/users')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Users">Users</div>
        </a>
    </li>
    @endif
    @if(in_array(2,explode(',', $admin_id['menu_id'])) || in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'lead_list' ? 'active' : '')}}">
        <a href="{{url('admin/lead')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-apps"></i>
            <div data-i18n="Leads">Leads</div>
        </a>
    </li>
    @endif
    <li class="menu-item {{(isset($active) && $active == 'customer-list' ? 'active' : '')}}">
        <a href="{{url('admin/customer')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Customers">Customers</div>
        </a>
    </li>
    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(2,explode(',', $admin_id['menu_id'])) ||
    in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'follow_up_tracker' ? 'active' : '')}}">
        <a href="{{url('admin/follow-up-tracker')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Follow UP Tracker">Follow UP Tracker</div>
        </a>
    </li>
    @endif

    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(2,explode(',', $admin_id['menu_id'])) ||
    in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'ptp_tracker' ? 'active' : '')}}">
        <a href="{{url('admin/ptp-tracker')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="PTP Tracker">PTP tracker</div>
        </a>
    </li>
    @endif

    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(2,explode(',', $admin_id['menu_id'])) ||
    in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'agent_task' ? 'active' : '')}}">
        <a href="{{url('admin/agent-task')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Agent Task">Agent Task</div>
        </a>
    </li>
    @endif

    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(2,explode(',', $admin_id['menu_id'])) ||
    in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{(isset($active) && $active == 'sales_done' ? 'active' : '')}}">
        <a href="{{url('admin/sales-done')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Sales Done">Sales Done</div>
        </a>
    </li>
    @endif
    @if(in_array(1,explode(',', $admin_id['menu_id'])) || in_array(2,explode(',', $admin_id['menu_id'])) ||
    !in_array(4,explode(',', $admin_id['role'])))
    <li class="menu-item {{in_array($active,['creditor_list','bank_type','loan_type','lead_source']) ? 'open': ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-box"></i>
            <div data-i18n="Masters">Masters</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{(isset($active) && $active == 'creditor_list' ? 'active' : '')}}">
                <a href="{{route('admin.master.bank_creditor_list')}}" class="menu-link">
                    <div data-i18n="Bank Creditor ">Bank Creditor</div>
                </a>
            </li>
            <li class="menu-item {{(isset($active) && $active == 'bank_type' ? 'active' : '')}}">
                <a href="{{route('admin.master.bank_type_list')}}" class="menu-link">
                    <div data-i18n="Bank Type">Bank Type</div>
                </a>
            </li>
            <li class="menu-item {{(isset($active) && $active == 'loan_type' ? 'active' : '')}}">
                <a href="{{route('admin.master.loan_type_list')}}" class="menu-link">
                    <div data-i18n="Loan Type">Loan Type</div>
                </a>
            </li>
            <li class="menu-item {{(isset($active) && $active == 'lead_source' ? 'active' : '')}}">
                <a href="{{route('admin.master.lead_source_list')}}" class="menu-link">
                    <div data-i18n="Lead Source">Lead Source</div>
                </a>
            </li>
        </ul>
    </li>
    @endif

    <!-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
    </li>
    <li class="menu-item {{config('global.active_tab') == 'profile' ? 'active' : ''}}">
        <a href="{{url('admin/profile')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user-check"></i>
            <div data-i18n="My Profile">My Profile</div>
        </a>
    </li>
    <li class="menu-item ">
        <a href="{{url('admin/logout')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-logout"></i>
            <div data-i18n="Logout">Logout</div>
        </a>
    </li> -->
</ul>