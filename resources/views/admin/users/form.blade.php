@include('admin.common.header')

@php
if(isset($edit) && !empty($edit)) {
$id = $edit['id'];
$first_name = $edit['first_name'];
$last_name = $edit['last_name'];
$email = $edit['email'];
$username = $edit['username'];
$password = $edit['p'];
$role = $edit['role'];
$is_active = $edit['status'];
$menu_id = explode(',',$edit['menu_id']);
$sales_target = $edit['sales_target'];
}else{
$id = '';
$first_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';
$role = '';
$is_active = '';
$sales_target = '';
$menu_id = array();
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
                    <a href="{{url('admin/users')}}">Users</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div>
                <a href="{{url('admin/users')}}" class="btn btn-primary">Back</a>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">

                <form class="form" id="ajax_form" method="POST" route="save-users" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <div class="row">
                        <div class="col-12 ajax-msg"></div>
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">Users Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row customers">
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ $first_name }}">
                                            <span id="first_name_err" class="error first_name_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ $last_name }}">
                                            <span id="last_name_err" class="error last_name_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ $email }}">
                                            <span id="email_err" class="error email_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{{ $username }}">
                                            <span id="username_err" class="error username_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ $password }}">
                                            <span id="password_err" class="error password_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" value="{{ $password}}">
                                            <span id="password_confirmation_err" class="error password_confirmation_err small" style="color:red;"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="Role">Role</label>
                                            <select class="selectpicker w-100" name="role" data-style="btn-default" id="role_select">
                                                <option value="">Select Role</option>
                                                @if(isset($userRole) && !empty($userRole))
                                                @foreach($userRole as $u_val)
                                                <option value="{{ $u_val['id']}}" <?= $role == $u_val['id'] ? 'selected' : "" ?>>{{ $u_val['name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="ajax-error"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field" id="sales_target_field">
                                            <label class="form-label" for="Sales Target">Sales Target</label>
                                            <input type="text" class="form-control" id="" placeholder="Sales Target" name="sales_target" value="{{$sales_target}}">
                                            <span id="sales_target_err" class="error sales_target_err small" style="color:red;"></span>
                                        </div>
                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="selectpicker w-100" name="is_active" data-style="btn-default">
                                                <option value="1" <?= $is_active == '1' ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?= $is_active == '0' ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                            <span class="ajax-error"></span>
                                        </div>

                                        <div class="col-lg-6 mb-3 ajax-field">
                                            <label class="form-label" for="menus">Menus</label>
                                            <div class="d-flex">
                                                @if(isset($menu) && !empty($menu))
                                                @foreach($menu as $m_val)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="menu{{ $m_val['id']}}" name="menu_id[]" value="{{$m_val['id']}}" <?= (in_array($m_val['id'], $menu_id)) ? 'checked' : ''; ?> />
                                                    <label class="form-check-label" for="menu{{ $m_val['id']}}" style="margin-right:10px">{{ $m_val['name']}}</label>
                                                </div>
                                                @endforeach
                                                @endif
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
    <!-- / Content -->
</div>
<!-- Content wrapper -->
@include('admin.common.footer')
@include('admin.common.end')
<script>
    $(document).ready(function() {

        toggleSalesTargetField($('#role_select').val());


        $('#role_select').on('change', function() {
            var selectedRole = $(this).val();
            toggleSalesTargetField(selectedRole);
        });
        $('#role_select').trigger('change');

        function toggleSalesTargetField(role) {
            if (role == 4) {
                $('#sales_target_field').show();
            } else {
                $('#sales_target_field').hide();
            }
        }
    });
</script>