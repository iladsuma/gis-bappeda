<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-role">
                Role / Hak Akses User
            </div>
            <div class="card-body">
                <button class="btn btn-primary ml-2 mb-2 tambah-data" id="tambah-data">+ Role/Hak Akses</button>
                <table class="table table-striped" id="role-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Role/Hak Akses</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="role-form" method="POST" class="form-horizontal" action="">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="role-name" class="col-lg-3 col-form-label">Hak Akses</label>
                            <div class="col-lg-9">
                                <input type="text" name="role-name" class="form-control form-control-sm"
                                    id="role-name" placeholder="Nama Hak Akses" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="permissions" class="col-sm-3 col-form-label">Permissions</label>
                            <div class="col-sm-9">
                                <div class="row mt-2" id="row-role">
                                    {{-- @foreach ($permissionsFormatted as $key => $permissionNames)
                                    <div class="col-sm-4" style="margin-bottom: 20px;">
                                        <span>{{ strtoupper($key) }}</span><br />
                                        @foreach ($permissionNames as $i => $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input name="permission[]" class="custom-control-input" type="checkbox"
                                                    id="{{ $key . '-' . $permission['name'] . '-' . $i }}"
                                                    value="{{ $permission['value'] }}"
                                                    {{ $editable && in_array($permission['value'], $rolePermissions) ? 'checked="checked"' : '' }}>
                                                <label for="{{ $key . '-' . $permission['name'] . '-' . $i }}"
                                                    class="custom-control-label">{{ $permission['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary float-right" id="role-simpan">Simpan</button>
                        {{-- <a href="{{ route('roles.index') }}" class="btn btn-default float-right">Batal</a> --}}
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

</section>
