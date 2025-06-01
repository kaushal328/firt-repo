@include('admin.common.header')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Security</h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/profile')}}"><i class="ti-xs ti ti-users me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
                </li>
            </ul>
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form id="ajax-form" method="POST" action="{{url('admin/security/save_change_password')}}">
                        @csrf
                        <div class="col-12 ajax-msg"></div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle ajax-field">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="current_password" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <span class="ajax-error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle ajax-field">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" id="new_password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <span class="ajax-error"></span>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle ajax-field">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <span class="ajax-error"></span>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/ Change Password -->
        </div>
    </div>
</div>
@include('admin.common.footer')
<script>
    $(document).ready(function() {
        $(document).on('submit', '#ajax-form', function(e) {
            e.preventDefault();
            clearAjaxErrors();

            const _this = $(this);

            _this.find('.submit-button').attr('disabled', 'disabled');
            _this.find('.submit-button').text('Saving...');

            const url = _this.attr('action');
            const data = _this.serializeArray();

            $.post(url, data, function(res) {
                _this.find('.submit-button').removeAttr('disabled');
                _this.find('.submit-button').text('Save');

                processAjaxResponse(res, 1000);
            }, 'json');
        })
    })
</script>
@include('admin.common.end')