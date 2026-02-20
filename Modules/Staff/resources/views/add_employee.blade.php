
@include('staff::layouts.header')
<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Add New Employee</h2>
    </div>

    <!-- Form Card -->
    <div class="form-card">
      <form method="POST" action="{{route('staff.save_employee')}}" id="employeeForm">
  @csrf

  <div class="form-row">
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="fullname" placeholder="Enter full name">
      @error('fullname')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-group">
      <label>Mobile Number</label>
      <input type="text" name="mobile" placeholder="Enter mobile number">
      @error('mobile')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" placeholder="Enter email address">
      @error('email')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>


      <div class="form-group">
  <label>Select Role</label>
  <select name="role">
      <option value="">-- Select Role --</option>
      <option value="admin">Admin</option>
      {{-- <option value="sub_admin">Sub Admin</option> --}}
  </select>

  @error('role')
    <small class="error-text">{{ $message }}</small>
  @enderror
</div>

    
  </div>

<div class="form-row">
  <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" placeholder="Enter username">
      @error('username')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>


    <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password">
    @error('password')
      <small class="error-text">{{ $message }}</small>
    @enderror
  </div>



</div>

  <button type="submit" class="save-btn">Save Employee</button>
</form>


    </div>

  </div>

</main>


<style>

.error-text
{
  box-sizing: border-box;
  color: #e11d48;
  font-size: 12px;
}

  /* Main admin area */
.admin-content {
  margin-left: 260px;      /* sidebar width */
  padding: 100px 60px 40px; /* ⬅️ TOP padding for header */
  background: #f4f7fb;
  min-height: 100vh;
}

/* Content wrapper */
.content-wrapper {
  max-width: 1200px;
  margin: 0 auto;   /* centers content */
}

/* Page header */
.page-header {
  margin-bottom: 30px;
}

.page-header h2 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 4px;
}

.page-header p {
  color: #6b7280;
  font-size: 14px;
}

/* Form card */
.form-card {
  width: 1000px;
  background: #fff;
  padding: 35px;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(0,0,0,.08);
}

/* Form fields */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 6px;
  display: block;
}

.form-group input ,.form-group select {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  font-size: 14px;
  transition: .3s;
}
.form-group input ,.form-group select {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  font-size: 14px;
  transition: .3s;
}

.form-group input:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}

/* Button */
.save-btn {
  width: 100%;
  margin-top: 15px;
  padding: 15px;
  border-radius: 30px;
  border: none;
  font-size: 15px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  background: linear-gradient(135deg,#6366f1,#4f46e5);
  transition: .3s;
}

.save-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(99,102,241,.4);
}

/* Mobile */
@media(max-width: 768px) {
  .admin-content {
    margin-left: 0;
    padding: 20px;
  }

  .form-card {
    width: 100%;
  }
}


.form-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

/* Mobile friendly */
@media(max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
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
            fullname: {
                required: true,
                minlength: 3
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 4
            },
            password: {
                required: true,
                minlength: 6
            },
             role: {
                required: true
            }
        },

        messages: {
            fullname: {
                required: "Full name is required",
                minlength: "Minimum 3 characters"
            },
            mobile: {
                required: "Mobile number is required",
                digits: "Only numbers allowed",
                minlength: "Must be 10 digits",
                maxlength: "Must be 10 digits"
            },
            email: {
                required: "Email is required",
                email: "Enter valid email"
            },
            username: {
                required: "Username required",
                minlength: "Minimum 4 characters"
            },
            password: {
                required: "Password required",
                minlength: "Minimum 6 characters"
            },
             role: {
                required: "Please select a role"
            }
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
    confirmButtonColor: '#6366f1'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}",
    confirmButtonColor: '#e11d48'
});
</script>
@endif

</body>
</html>
