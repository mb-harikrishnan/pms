
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
    background: radial-gradient(circle at top left, #1a1a1d, #09090b);
  min-height: 100vh;
}





.page-header {
  margin-bottom: 30px;
  border-left: 4px solid #D4AF37; /* Primary Gold */
  padding-left: 20px;
}

.page-header h2 {
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: #D4AF37;
  margin-bottom: 8px;
  letter-spacing: 1px;
}

.page-header p {
  color: #A1A1AA; /* Muted text */
  font-size: 14px;
}

/* 2. Dark Glass-like Form Card */
.form-card {
  background: #121214;
  padding: 40px;
  border-radius: 20px;
  border: 1px solid #27272A; /* Dark Border */
  box-shadow: 0 10px 30px rgba(0,0,0,0.4); /* Deep Shadow */
}

/* 3. Section Titles */
.form-section-title {
  color: #FFFFFF;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #27272A;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* 4. Grid Layout for Fields */
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Two columns */
  gap: 30px;
  margin-bottom: 10px;
}

/* 5. Input Groups */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  color: #A1A1AA;
  font-size: 13px;
  margin-bottom: 8px;
  display: block;
  font-weight: 500;
}

/* 6. Creative Input Fields with Icons */
.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

/* Icon style inside input */
.input-wrapper i {
  position: absolute;
  left: 15px;
  color: #D4AF37; /* Gold Icon */
  font-size: 18px;
  pointer-events: none;
  transition: 0.3s;
}

/* The actual input field */
.form-group input, 
.form-group select {
  width: 100%;
  padding: 14px 14px 14px 45px; /* Left padding space for the icon */
  background: rgba(255, 255, 255, 0.03); /* Slight transparency */
  border: 1px solid #27272A;
  border-radius: 10px;
  color: #FFFFFF;
  font-size: 14px;
  transition: all 0.3s;
  outline: none;
}

/* Hover & Focus Effects */
.form-group input:hover,
.form-group select:hover {
  border-color: #555;
}

.form-group input:focus, 
.form-group select:focus {
  border-color: #D4AF37; /* Gold Border on Click */
  background: rgba(212, 175, 55, 0.05); /* Soft Gold Tint */
  box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1); /* Glow Effect */
}

/* Placeholder color */
.form-group input::placeholder {
  color: #555;
}

/* Dropdown Options (Fix for dark mode) */
.form-group select option {
  background: #1a1a1d;
  color: #fff;
  padding: 10px;
}

/* 7. Save Button (Golden Gradient) */
.save-btn {
  width: 100%;
  margin-top: 25px;
  padding: 16px;
  border-radius: 12px;
  border: none;
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #000; /* Black text on gold is best for contrast */
  cursor: pointer;
  background: linear-gradient(135deg, #D4AF37, #F3E5AB); /* Gold to Light Gold */
  transition: all 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  box-shadow: 0 5px 15px rgba(212, 175, 55, 0.15);
}

.save-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(212, 175, 55, 0.35); /* Stronger glow on hover */
  filter: brightness(1.1);
}

.save-btn:active {
  transform: translateY(-1px);
}

/* 8. Error Text */
.error-text {
  color: #ff5b5b; /* Bright Red */
  font-size: 12px;
  margin-top: 6px;
  display: flex;
  align-items: center;
  gap: 5px;
  font-weight: 500;
}

/* 9. Mobile Responsiveness */
@media(max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr; /* Stack inputs on mobile */
    gap: 15px;
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
