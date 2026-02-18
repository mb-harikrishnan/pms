
@include('staff::layouts.header')


<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Expence Request</h2>
    </div>

    <!-- Form Card -->
    <div class="form-card">
    <form method="POST"  id="requestForm" action="{{ route('accounts.save_expence_request') }}">
  @csrf

  <div class="form-row">
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" placeholder="Enter title">
      @error('title')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-group">
      <label>Amount</label>
      <input type="text" name="amount" placeholder="Enter amount">
      @error('amount')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
  </div>


  <div class="form-row">
    <div class="form-group" style="width:100%;">
      <label>Description</label>
      <textarea name="description" placeholder="Enter description" rows="4"></textarea>
      @error('description')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
    <div class="form-group">
    <label>Select Date</label>
    <input type="date" name="date" class="form-control">
    
    @error('date')
        <small class="error-text">{{ $message }}</small>
    @enderror
</div>

  </div>

  <button type="submit" class="save-btn">Save Request</button>
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

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  font-size: 14px;
  transition: .3s;
  background: #fff;
}


.form-group input:focus,
.form-group select:focus ,
.form-group textarea:focus {
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

    $("#requestForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            },
            description: {
                required: true,
                minlength: 5
            },
            amount: {
                required: true,
                number: true,
                min: 1
            }
        },

        messages: {
            title: {
                required: "Title is required",
                minlength: "Title must be at least 3 characters"
            },
            description: {
                required: "Description is required",
                minlength: "Description must be at least 5 characters"
            },
            amount: {
                required: "Amount is required",
                number: "Enter a valid number",
                min: "Amount must be greater than 0"
            }
        },

        errorElement: "small",
        errorClass: "error-text"
    });

});
</script>



//session using alert suess swal

@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: '{{ session('success') }}',
  timer: 3000,
  showConfirmButton: false
});
</script>
@endif

@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: '{{ session('success') }}',
  timer: 3000,
  showConfirmButton: false
});
</script>
@endif
@if(session('error`'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Error',
  text: '{{ session('error') }}',
  timer: 3000,
  showConfirmButton: false
});
</script>
@endif









