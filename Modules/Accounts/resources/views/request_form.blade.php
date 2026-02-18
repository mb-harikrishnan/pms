
@include('staff::layouts.header')


<main class="admin-content">

  <div class="content-wrapper">

    <!-- Page Header -->
    <div class="page-header">
      <h2>ID Activation Request</h2>
    </div>

    <!-- Form Card -->
    <div class="form-card">
      <form method="POST" action="{{route('accounts.save_request')}}" id="requestForm">
  @csrf

  <div class="form-row">
    <div class="form-group">
      <label>UserId</label>
      <input type="text" name="userid" placeholder="Enter user id">
      @error('userid')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

    <div class="form-group">
      <label>Number Of USDT</label>
      <input type="text" name="usdt" placeholder="Enter number of USDT">
      @error('usdt')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Amount In INR</label>
      <input type="text" name="amount_inr" placeholder="Enter amount in INR" readonly >
      @error('amount_inr')
        <small class="error-text">{{ $message }}</small>
      @enderror
    </div>

      <div class="form-group">
        <label>To Id</label>
        <select name="to_id">
            <option value="">-- Select To ID --</option>
            @foreach ($accounts as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

        @error('to_id')
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
.form-group select {
  width: 100%;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  font-size: 14px;
  transition: .3s;
  background: #fff;
}


.form-group input:focus,
.form-group select:focus {
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
            userid: {
                required: true,
            },
            usdt: {
                required: true,
                number: true
            },
            amount_inr: {
                required: true,
                number: true
            },
            to_id: {  
                required: true,
                digits: true,
            
            },
           
            
        },

        messages: {
              userid: {
                required: "User ID is required",
            },
            usdt: {
                required: "USDT amount is required",
                number: "Enter a valid number"
            },
            amount_inr: {
                required: "INR amount is required",
                number: "Enter a valid number"
            },
            to_id: {  
                required: "To ID is required",
            },
            
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

    let usdtRate = 83; // 🔥 Change this to current USDT rate

    $("input[name='usdt']").on("keyup change", function () {

        let usdt = parseFloat($(this).val());

        if (!isNaN(usdt)) {
            let inr = usdt * usdtRate;
            $("input[name='amount_inr']").val(inr.toFixed(2));
        } else {
            $("input[name='amount_inr']").val('');
        }
    });

});
</script>
