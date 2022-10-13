<div class="modal" id="CreateRolesModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Categories</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="row mg-t-10">
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Admin" id="el" type="radio">
                                <p class="btn btn-light A">Admin</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Employee" type="radio">
                                <p class="btn btn-light B">Employee</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Worker" type="radio">
                                <p class="btn btn-light C">Worker</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Customer" type="radio">
                                <p class="btn btn-light D">Customer</p>
                            </label>
                        </div>
                    </div>
                </div>
                <hr />
                <ul id="list_error_message"></ul>
                <div class="form-group">
                    <label for="user_name">user_name</label>
                    <input type="text" id="user_name" name="user_name"
                        class="form-control @error('user_name')  is-invalid @enderror" />
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email"
                        class="form-control @error('email')  is-invalid @enderror" />
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" id="password" name="password"
                        class="form-control @error('password')  is-invalid @enderror" />
                    @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>Tasks</th>
                                <th>View</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(config('permission') as $permissions => $label)
                            <tr>
                                <th scope="row">{{ $permissions }}</th>
                                @foreach($label as $q)
                                <td>
                                    <div class="main-toggle-group-demo">
                                        <div class="main-toggle main-toggle-success" id="m" data-v="{{ $q }}">
                                            <span></span>
                                        </div>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                        <button type="submit" class="btn btn-success CreateRolesBut" id="AddAdmin">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>

<!-- //////////////// -->
<div class="modal fade" id="EditeRolesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog col-xl-12">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permission Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="row mg-t-10">
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Admin" type="radio">
                                <p class="btn btn-light A">Admin</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Employee" type="radio">
                                <p class="btn btn-light B">Employee</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Worker" type="radio">
                                <p class="btn btn-light C">Worker</p>
                            </label>
                        </div>
                        <div class="col-lg-3">
                            <label class="rdiobox"><input name="rdio" value="Customer" type="radio">
                                <p class="btn btn-light D">Customer</p>
                            </label>
                        </div>
                    </div>
                </div>
                <hr />
                <ul id="list_error_message"></ul>
                <div class="form-group">
                    <label for="user_name">user_name</label>
                    <input type="text" id="edit_user_name" name="user_name"
                        class="form-control @error('user_name')  is-invalid @enderror" />
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" id="edit_email" name="email"
                        class="form-control @error('email')  is-invalid @enderror" />
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" id="edit_password" name="password"
                        class="form-control @error('password')  is-invalid @enderror" />
                    @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>Tasks</th>
                                <th>View</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(config('permission') as $permissions => $label)
                            <tr>
                                <th scope="row">{{ $permissions }}</th>
                                @foreach($label as $q)
                                <td>
                                    <div class="main-toggle-group-demo">
                                        <div class="main-toggle main-toggle-success {{ $q }}" data-v="{{ $q }}">
                                            <span></span>
                                        </div>

                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success CreateRolesBut">Create</button>
            </div>
        </div>
    </div>
</div>