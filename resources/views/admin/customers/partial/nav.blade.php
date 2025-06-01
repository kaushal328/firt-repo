<div class="nav flex-column nav-tabs nav-tabs-shadow mb-5 py-1 px-1" role="tablist" aria-orientation="vertical">
    <?php
    $tabs = [
        ['name' => 'Overview', 'route' => 'admin.customer.overview', 'active_tab' => 'overview'],
        ['name' => 'Personal Details', 'route' => 'admin.customer.personal_details', 'active_tab' => 'personal_details'],
        ['name' => 'Employee Qualification', 'route' => 'admin.customer.employee_qual', 'active_tab' => 'employee_qualification'],
        ['name' => 'Documents', 'route' => 'admin.customer.documents', 'active_tab' => 'documents'],
        ['name' => 'Income', 'route' => 'admin.customer.income', 'active_tab' => 'income'],
        ['name' => 'Expense', 'route' => 'admin.customer.expense', 'active_tab' => 'expense'],
        ['name' => 'Loans', 'route' => 'admin.customer.loan', 'active_tab' => 'loan'],
        ['name' => 'Plans', 'route' => 'admin.customer.plan', 'active_tab' => 'plan'],
        ['name' => 'Settlement', 'route' => 'admin.customer.settlement', 'active_tab' => 'settlement'],
        ['name' => 'Financial Difficulty', 'route' => 'admin.customer.customer_finance', 'active_tab' => 'finacial_difficulty'],
        ['name' => 'Refer A Friend', 'route' => 'admin.customer.customer_reference', 'active_tab' => 'refer_friend'],
        ['name' => 'Transfer To', 'route' => 'admin.customer.customer_transfer', 'active_tab' => 'transfer'],
        ['name' => 'Status', 'route' => 'admin.customer.customer_status', 'active_tab' => 'status'],
        ['name' => 'Call History', 'route' => 'admin.customer.customer_call_history', 'active_tab' => 'call_history'],
        ['name' => 'Account Manager', 'route' => 'admin.customer.account_manager', 'active_tab' => 'account_manager'],
        ['name' => 'Letter', 'route' => 'admin.customer.letter', 'active_tab' => 'letter'],
        ['name' => 'Payment History', 'route' => 'javascript:void(0);', 'active_tab' => '']
    ];
    ?>
    <ul class="nav nav-pills">
        @foreach ($tabs as $tab)
            <li class="nav-item">
                <a class="nav-link {{ $active_tab == $tab['active_tab'] ? 'active' : '' }}"
                    href="{{ $tab['route'] == 'javascript:void(0);' ? $tab['route'] : route($tab['route'], ['id' => $id]) }}">
                    {{ $tab['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
