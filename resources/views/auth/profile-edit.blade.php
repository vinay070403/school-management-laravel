<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h3>Update Profile</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('profile.update.post') }}" id="profileForm">
                @csrf
                @method('PUT')
                <!-- First Name and Last Name horizontally -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Email and Phone horizontally -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>
                    </div>
                </div>

                <!-- DOB and Address horizontally -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Interest and Goal horizontally -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="interest">Interest</label>
                            <input type="text" name="interest" id="interest" class="form-control" value="{{ old('interest', $user->interest) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="goal">Goal</label>
                            <input type="text" name="goal" id="goal" class="form-control" value="{{ old('goal', $user->goal) }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
                <button type="button" class="btn btn-secondary" id="cancelProfile">Cancel</button>
            </form>
        </div>
    </div>
</div>