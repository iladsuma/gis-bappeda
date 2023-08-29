<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-user">
                Data User
            </div>
            <div class="card-body">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data User</button>
                <table id="table-user" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Nama OPD</th>
                            <th>Role</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAdminUser" tabindex="-1" aria-labelledby="modalAdminUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdminUserLabel">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="admin-user-form">
                        @csrf
                        <div class="alert alert-danger d-none" id="admin-user-validation">

                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" id="username">
                        </div>
                        <div class="form-group">
                            <label for="opd_id">Pilih OPD</label>
                            <select id="opd_id" class="form-control form-control-sm">
                                <option value="">Pilih OPD</option>
                                @foreach ($data_opd as $opd)
                                    <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Pilih Role</label>
                            <select id="role_id" class="form-control form-control-sm">
                                <option value="">Pilih Role</option>
                                @foreach ($data_role as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>
