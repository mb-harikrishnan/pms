
@include('staff::layouts.header')


<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>Wallet Request</h2>
    </div>

    <!-- Form Card -->
    <div class="form-card">
      <form method="POST" action="{{route('accounts.save_wallet_request')}}" id="requestForm">
  @csrf

  <div class="form-row">
    <div class="form-group">
      <label>Requested Amount</label>
      <input type="text" name="requested_amount" placeholder="Enter requested amount">
      @error('requested_amount')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Request Reason</label>
      <textarea name="request_reason" placeholder="Enter request reason"></textarea>
      @error('request_reason')
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
/* Main admin area */
.admin-content {
  margin-left: 260px;
  padding: 100px 60px 40px;
  background: #f4f7fb;
  min-height: 100vh;
}

/* Content wrapper */
.content-wrapper {
  max-width: 800px;
  margin: 0 auto;
}

/* Page header */
.page-header {
  margin-bottom: 30px;
}

.page-header h2 {
  font-size: 26px;
  font-weight: 700;
}

.form-card {
  max-width: 750px;
  margin: 0 auto;
  background: #fff;
  padding: 60px;
  border-radius: 22px;
  box-shadow: 0 25px 60px rgba(0,0,0,.1);
}


/* Form fields */
.form-group {
  margin-bottom: 25px;
}

.form-group label {
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 8px;
  display: block;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  font-size: 14px;
  transition: .3s;
  background: #fff;
}

.form-group textarea {
  min-height: 100px;
  resize: none;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}

/* Error text */
.error-text {
  color: #e11d48;
  font-size: 12px;
  margin-top: 5px;
  display: block;
}

/* Button */
.save-btn {
  width: 100%;
  margin-top: 10px;
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

  /* .form-card {
    max-width: 100%;
    padding: 25px;
  } */
}

</style>



<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script> 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    $("#requestForm").validate({
        rules: {
            requested_amount: {
                required: true,
                number: true
            },
            request_reason: {
                required: true,
                minlength: 5
            }
        },

        messages: {
            requested_amount: {
                required: "Requested amount is required",
                number: "Enter a valid amount"
            },
            request_reason: {
                required: "Request reason is required",
                minlength: "Reason must be at least 5 characters"
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





