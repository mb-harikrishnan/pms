@extends('admin_layout_golden')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Add New Employee</h2>
      <p>Create a new staff account with specific roles and permissions.</p>
    </div>

    <!-- Form Card -->
    <div class="form-card">
      <form method="POST" action="{{route('staff.save_employee')}}" id="employeeForm">
          @csrf

          <div class="form-section-title">Personal Information</div>
          <div class="form-row">
            <div class="form-group">
              <label>Full Name</label>
              <div class="input-wrapper">
                  <i class="ri-user-line"></i>
                  <input type="text" name="fullname" placeholder="Enter full name">
              </div>
              @error('fullname')
                <small class="error-text">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Mobile Number</label>
              <div class="input-wrapper">
                  <i class="ri-phone-line"></i>
                  <input type="text" name="mobile" placeholder="Enter mobile number">
              </div>
              @error('mobile')
                <small class="error-text">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Email Address</label>
              <div class="input-wrapper">
                  <i class="ri-mail-line"></i>
                  <input type="email" name="email" placeholder="Enter email address">
              </div>
              @error('email')
                <small class="error-text">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label>Select Role</label>
              <div class="input-wrapper">
                  <i class="ri-shield-star-line"></i>
                  <select name="role">
                      <option value="">-- Select Role --</option>
                      <option value="admin">Admin</option>
                      {{-- <option value="sub_admin">Sub Admin</option> --}}
                  </select>
              </div>
              @error('role')
                <small class="error-text">{{ $message }}</small>
              @enderror
            </div>
          </div>

        <div class="form-section-title" style="margin-top: 10px;">Account Security</div>
        <div class="form-row">
          <div class="form-group">
              <label>Username</label>
              <div class="input-wrapper">
                  <i class="ri-id-card-line"></i>
                  <input type="text" name="username" placeholder="Enter username">
              </div>
              @error('username')
                <small class="error-text">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="ri-lock-password-line"></i>
                    <input type="password" name="password" placeholder="Enter password">
                </div>
                @error('password')
                  <small class="error-text">{{ $message }}</small>
                @enderror
          </div>
        </div>

        <button type="submit" class="save-btn">
            <i class="ri-save-3-line"></i> Save Employee Record
        </button>
      </form>
    </div>

</div>

<style>
/* Main Content Wrapper override for this page */
.content-wrapper {
  max-width: 1000px;
  margin: 40px auto;
  padding: 0 20px;
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Page Header */
.page-header {
  margin-bottom: 30px;
  border-left: 4px solid var(--primary-gold);
  padding-left: 20px;
}

.page-header h2 {
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: var(--primary-gold);
  margin-bottom: 8px;
  letter-spacing: 1px;
}

.page-header p {
  color: var(--text-muted);
  font-size: 14px;
}

/* Form Card */
.form-card {
  background: #121214;
  padding: 40px;
  border-radius: 20px;
  border: 1px solid var(--border-color);
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.form-section-title {
    color: var(--text-main);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
    letter-spacing: 0.5px;
}

/* Form Layout */
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-bottom: 10px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  color: var(--text-muted);
  font-size: 13px;
  margin-bottom: 8px;
  display: block;
  font-weight: 500;
}

/* Creative Input Wrapper */
.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 15px;
    color: var(--primary-gold);
    font-size: 18px;
    pointer-events: none;
    transition: 0.3s;
}

.form-group input, .form-group select {
  width: 100%;
  padding: 14px 14px 14px 45px; /* Space for icon */
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid var(--border-color);
  border-radius: 10px;
  color: var(--text-main);
  font-size: 14px;
  transition: all 0.3s;
  outline: none;
}

.form-group input:focus, .form-group select:focus {
  border-color: var(--primary-gold);
  background: rgba(212, 175, 55, 0.05); /* very light gold tint */
  box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.form-group input::placeholder {
    color: #555;
}

/* Select styling fix for dark mode */
.form-group select option {
    background: #1a1a1d;
    color: var(--text-main);
    padding: 10px;
}

/* Button */
.save-btn {
  width: 100%;
  margin-top: 25px;
  padding: 16px;
  border-radius: 12px;
  border: none;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #000;
  cursor: pointer;
  background: linear-gradient(135deg, #D4AF37, #F3E5AB); /* Golden Gradient */
  transition: all 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.save-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
  filter: brightness(1.1);
}

.error-text {
  color: #ff5b5b;
  font-size: 12px;
  margin-top: 5px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.error-text::before {
    content: '\ea0f'; /* RemixIcon alert */
    font-family: 'remixicon';
}

/* Mobile */
@media(max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .content-wrapper {
      padding: 0 15px;
  }
  
  .form-card {
      padding: 25px;
  }
}
</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $("#employeeForm").validate({
        rules: {
            fullname: { required: true, minlength: 3 },
            mobile: { required: true, digits: true, minlength: 10, maxlength: 10 },
            email: { required: true, email: true },
            username: { required: true, minlength: 4 },
            password: { required: true, minlength: 6 },
            role: { required: true }
        },
        messages: {
            fullname: { required: "Full name is required", minlength: "Minimum 3 characters" },
            mobile: { required: "Mobile number is required", digits: "Only numbers allowed", minlength: "10 digits required", maxlength: "10 digits required" },
            email: { required: "Email is required", email: "Enter valid email" },
            username: { required: "Username required", minlength: "Minimum 4 characters" },
            password: { required: "Password required", minlength: "Minimum 6 characters" },
            role: { required: "Please select a role" }
        },
        errorElement: "small",
        errorClass: "error-text"
    });
});
</script>

{{-- SweetAlert Session Messages --}}
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    background: '#1a1a1d',
    color: '#fff',
    confirmButtonColor: '#D4AF37'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}",
    background: '#1a1a1d',
    color: '#fff',
    confirmButtonColor: '#ff5b5b'
});
</script>
@endif

@endsection
