@include('admin.common.header')

<!-- Content -->

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
                <li class="breadcrumb-item active">List</li>
            </ol>
            <a href="{{url('admin/users/form')}}" class="btn btn-primary">Add User</a>
        </nav>

        <div class="">
            <!-- Category List Table -->
            <div class="ajax-msg mt-1 mb-1"></div>
            <div class="card mb-3">
                <div class="card-header border-bottom">

                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= isset($name) ? $name : '' ?>" />
                            </div>

                            <div class="col-lg-3">
                                <label for="title" class="form-label">Role</label>
                                <select class="selectpicker w-100" name="role" data-style="btn-default">
                                    <option value="">Select Role</option>
                                    @if(isset($userRole) && !empty($userRole))
                                    @foreach($userRole as $u_val)
                                    <option value="{{ $u_val['id']}}" <?= !empty($role) && ($role == $u_val['id']) ? 'selected' : "" ?>>{{ $u_val['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary mt-4">Search</button>
                                <a class="btn btn-warning mt-4" href="{{url('admin/users')}}">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Sr.No</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Sales Target</th>
                                <th>Psssword</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($list as $index => $val)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $val['username']}}</td>
                                <td>{{ $val['first_name'].' '.$val['last_name'] }}</td>
                                <td>{{ !empty($val['role']) ? roleName($val['role']) : ""}}</td>
                                <td>{{ $val['sales_target'] ??  '-'}}</td>
                                <td>{{ $val['p']}}</td>
                                <td>{{ date('d-M-Y',strtotime($val['created_at'])) }}</td>
                                <td>{!! $val['status'] == 1 ? successBadge('Active') : dangerBadge('In-Active') !!}</td>
                                <td>
                                    <div class="d-flex align-items-sm-center justify-content-sm-center">
                                        <a class="btn btn-sm btn-icon" href="{{ url('admin/users/form/' . base64_encode($val['id'])) }}"><i class="ti ti-edit text-primary"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    @include('admin.common.footer')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>

    @include('admin.common.end')