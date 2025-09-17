<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4>Add New User</h4>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('user.store') }}" id="addUserForm">
                @csrf
                <!-- First Name and Last Name horizontally -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="given-name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="family-name" required>
                        </div>
                    </div>
                </div>

                <!-- Email and Phone horizontally -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" autocomplete="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" autocomplete="tel">
                        </div>
                    </div>
                </div>

                <!-- DOB and Address horizontally -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" autocomplete="bday">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" autocomplete="street-address"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Password and Confirm Password horizontally -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password" required>
                        </div>
                    </div>
                </div>

                <!-- Interest and Goal horizontally -->
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="interest">Interest</label>
                            <input type="text" name="interest" id="interest" class="form-control" value="{{ old('interest') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="goal">Goal</label>
                            <input type="text" name="goal" id="goal" class="form-control" value="{{ old('goal') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary me-2">Add User</button>
                        <button type="button" class="btn btn-secondary" id="cancelAddUser">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>