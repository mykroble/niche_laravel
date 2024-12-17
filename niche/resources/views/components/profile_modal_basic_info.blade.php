
<!-- <button class="btn btn-outline-primary btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#modal_basic_info">Edit Profile</button> -->


<div class="modal fade" id="modal_basic_info" tabindex="-1" aria-labelledby="modalBasicInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBasicInfoLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profileForm1.handle') }}" id="modal_basic_info_form">
                    @csrf
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form-control" id="display_name" name="display_name" required>
                    </div>

                    <!-- Birthday -->
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Email Verified At -->
                    <div class="form-group">
                        <label for="email_verified_at">Email Verified At</label>
                        <input type="datetime-local" class="form-control" id="email_verified_at" name="email_verified_at">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" id="save_btn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

