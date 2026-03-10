
@include('staff::layouts.header')
<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Add New Employee</h2>

      <a href="{{ route('staff.employee_list') }}" class="btn btn-primary">
         Employee List
      </a>
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
  <select name="role" id="role" style="width:100%">
      <option value="">-- Select Role --</option>
  </select>

  @error('role')
    <small class="error-text">{{ $message }}</small>
  @enderror
</div>

    
  </div>

<div class="form-row">
  <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" placeholder="Enter username"  autocomplete="new-username">
      @error('username')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>


    <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter password" autocomplete="new-password">
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
  margin-left: 260px;
  padding: 100px 60px 40px;
  background: #ffffff;
  min-height: 100vh;
}




.page-header {
  margin-bottom: 30px;
  border-left: 4px solid #dc2626;
  padding-left: 20px;

  display: flex;
  justify-content: space-between;
  align-items: center;
}


.page-header h2 {
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: #dc2626; /* Red */
  margin-bottom: 8px;
  letter-spacing: 1px;
}

.page-header p {
  color: #A1A1AA; /* Muted text */
  font-size: 14px;
}

/* 2. Dark Glass-like Form Card */
.form-card {
  background: #ffffff;
  padding: 40px;
  border-radius: 20px;
  border: 1px solid #e5e7eb; /* Dark Border */
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
  color: #374151;
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
  color: #dc2626; /* Gold Icon */
  font-size: 18px;
  pointer-events: none;
  transition: 0.3s;
}

/* The actual input field */
.form-group input, 
.form-group select,.form-group textarea {
  width: 100%;
  padding: 14px 14px 14px 14px; /* Left padding space for the icon */
  border-color: #dc2626;
  background: #ffffff;
  box-shadow: none;
  border-radius: 10px;
  color: #111827;
  font-size: 14px;
  transition: all 0.3s;
  outline: none;
   border: 1px solid #d1d5db;
}

/* Hover & Focus Effects */
.form-group input:hover,
.form-group select:hover ,.form-group textarea:hover {
  border-color: #555;
}

.form-group input:focus, 
.form-group select:focus, .form-group textarea:focus {
  border-color: #dc2626; /* Gold Border on Click */
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
  border: 2px solid #dc2626;
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #dc2626; /* Red Text */
  cursor: pointer;
  background: #ffffff; /* White background */
  transition: all 0.3s ease;
}

.save-btn:hover {
  background: #dc2626; /* Red background */
  color: #ffffff; /* White text */
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(220, 38, 38, 0.35);
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

/* ===== PERFECT SELECT2 MATCH ===== */

.select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--single {
    height: 52px !important;
    border-radius: 10px !important;
    border: 1px solid #d1d5db !important;
    background-color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    padding: 0 14px !important;
    transition: all 0.3s ease !important;
}

/* Text inside field */
.select2-container--default 
.select2-selection--single 
.select2-selection__rendered {
    color: #111827 !important;
    font-size: 14px !important;
    line-height: normal !important;
    padding-left: 0 !important;
}

/* Arrow alignment */
.select2-container--default 
.select2-selection--single 
.select2-selection__arrow {
    height: 100% !important;
    right: 10px !important;
}

/* Focus effect like your inputs */
.select2-container--default.select2-container--focus 
.select2-selection--single {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1) !important;
}

/* Dropdown */
.select2-dropdown {
    border-radius: 10px !important;
    border: 1px solid #e5e7eb !important;
}

/* Dropdown hover */
.select2-results__option--highlighted {
    background-color: #dc2626 !important;
    color: #ffffff !important;
}


/* Button Styles */
.btn-primary{
    background:#dc2626;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    font-size:14px;
    color:#ffffff;
    text-decoration:none; /* remove underline */
    font-weight:600;
}

.btn-primary:hover{
    background:#b91c1c;
    color:#ffffff;
    text-decoration:none; /* keep underline removed on hover */
}

</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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




<script>
$(document).ready(function () {

    // Initialize Select2
    $('#role').select2({
        width: '100%',
        placeholder: "-- Select Role --",
        allowClear: true,
        ajax: {
            url: "{{ route('staff.get_roles') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });

    // Trigger validation when Select2 changes
    $('#role').on('change', function () {
        $(this).valid();
    });

});
</script>

</body>
</html>
