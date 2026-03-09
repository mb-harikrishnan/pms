
@include('staff::layouts.header')
<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Add New Department</h2>
    </div>

    <!-- Form Card -->
    <div class="form-card">
    <form method="POST" action="{{ route('staff.save_department') }}" id="departmentForm">
  @csrf

  <div class="form-row">
    <div class="form-group">
      <label>Department Name <span style="color:red">*</span></label>
      <input type="text" name="department_name" placeholder="Enter department name">
      @error('department_name')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-group">
      <label>Department Code <span style="color:red">*</span></label>
      <input type="text" name="department_code" placeholder="Enter department code">
      @error('department_code')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

       <div class="form-group">
          <label>Select Date</label>
          <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}">

          
          @error('date')
              <small class="error-text">{{ $message }}</small>
          @enderror
      </div>

  </div>

  <div class="form-row">
    <div class="form-group" style="width:100%;">
      <label>Description <span style="color:red">*</span></label>
      <textarea name="description" placeholder="Enter department description" rows="4"></textarea>
      @error('description')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <button type="submit" class="save-btn">Save Department</button>
</form>
    </div>

  </div>

</main>


<style>

.error-text {
  color: #ff5b5b;
  font-size: 12px;
  margin-top: 6px;
  display: block;   
  font-weight: 500;
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
  border-left: 4px solid #dc2626; /* Red */
  padding-left: 20px;
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


</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {

    $("#departmentForm").validate({
        rules: {
            department_name: {
                required: true,
                minlength: 3
            },
            department_code: {
                required: true,
                minlength: 10
            },
            description: {
                required: true,
                minlength: 10
            }
        },

        messages: {
            department_name: {
                required: "Department name is required",
                minlength: "Minimum 3 characters"
            },
            department_code: {
                required: "Department code is required",
                digits: "Only numbers allowed",
                minlength: "Must be 10 digits"
            },
            description: {
                required: "Description is required",
                minlength: "Minimum 10 characters"
            }
        },

        errorElement: "small",
        errorClass: "error-text",
        submitHandler: function(form) {
            form.submit();  // only submit if valid
        }
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
