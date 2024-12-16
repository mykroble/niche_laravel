<div id="modal_basic_info" style="display:none">
    <div class="basic_info_form_bg">
        <form method="POST" action="{{ route('profileForm1.handle') }}" id="modal_basic_info_form">
            @csrf
            <div name="wrapper">
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
                <button class="btn" id="cancel_btn" onclick="cancelModal(1, event)">Cancel</button>
            </div>
        </form>
    </div>
</div>
