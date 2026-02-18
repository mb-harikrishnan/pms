@include('staff::layouts.header')

<main class="admin-content">
  <div class="content-wrapper">

    <div class="page-header">
      <h2> Requests</h2>
    </div>

   @php
    $today = \Carbon\Carbon::today()->format('Y-m-d');
@endphp

<div class="filter-card">
  
    <form method="GET" action="{{ route('accounts.wallet_request_list') }}">
        <div class="filter-row">

            <div class="filter-group">
                <label>From Date</label>
                <input type="date" 
                       name="from_date"
                       value="{{ request('from_date', $today) }}"
                       class="filter-input">
            </div>

            <div class="filter-group">
                <label>To Date</label>
                <input type="date" 
                       name="to_date"
                       value="{{ request('to_date', $today) }}"
                       class="filter-input">
            </div>

            <div>
                <button type="submit" class="btn-approve">
                    Search
                </button>
            </div>

        </div>
    </form>
</div>



    <div class="table-card">
      <table class="employee-table"  id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th> User</th>
            <th>Description</th>
            <th>Amount </th>
            <th>Date</th>
            <th>Action</th>
            <th>Reject Reason</th>
          
          </tr>
        </thead>
        <tbody>
            
          @foreach($db as $requests)
          
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $requests->C_FNAME }}</td>
              <td>{{ $requests->c_description }}</td>
              <td>{{ $requests->n_amount }}</td>
              <td>{{ $requests->d_date }}</td>
              
                <td>

                  @php
                      $adminId = session('admin_id');
                      $status  = $requests->c_superadmin_status;
                      $admin_status = $requests->c_admin_status;
                      $n_assigned_id = $requests->n_assigned_id;
                  @endphp

                  {{-- ================= SUPER ADMIN (ID = 1) ================= --}}
                  @if($adminId == 1)

                      @if($status == 'PENDING')
                          <a href="javascript:void(0);"
                            data-url="{{ route('accounts.approve_wallet_request', ['id' => $requests->n_slno]) }}"
                            class="btn-approve approve-btn">
                            Approve
                          </a>

                          <a href="javascript:void(0);"
                      data-url="{{ route('accounts.reject_wallet_request', ['id' => $requests->n_slno]) }}"
                      class="btn-reject reject-btn">
                      Reject
                    </a>

                   @else
                        @if($status == 'APPROVED')
                            <span class="status-approved">Approved</span>
                        @elseif($status == 'REJECTED')
                            <span class="status-rejected">Rejected</span>
                        @endif
                    @endif


                  {{-- ================= ADMIN (ID = assigned id) ================= --}}
@elseif($adminId == $n_assigned_id)

    {{-- If SuperAdmin has not approved --}}
    @if($status == 'PENDING')
        <span class="btn-reject">Waiting for SuperAdmin Approval</span>

    @elseif($status == 'REJECTED')
        <span class="btn-reject">Request Rejected by SuperAdmin</span>

    {{-- If SuperAdmin approved, now check Admin action --}}
    @elseif($status == 'APPROVED')

        @if($admin_status == 'APPROVED')
            <span class="btn-approve">Request Completed</span>

        @elseif($admin_status == 'REJECTED')
            <span class="btn-reject">Request Rejected</span>

        @else
            <a href="javascript:void(0);"
               data-url="{{ route('accounts.approve_wallet_request_admin', ['id' => $requests->n_slno]) }}"
               class="btn-approve admin-approve-btn">
               Approve
            </a>

            <a href="javascript:void(0);"
               data-url="{{ route('accounts.reject_wallet_request_admin', ['id' => $requests->n_slno]) }}"
               class="btn-reject admin-reject-btn">
               Reject
            </a>
        @endif

    @endif

                    
                      


                  {{-- ================= OTHER USERS ================= --}}
                  @else

                      @if($admin_status == 'APPROVED')
                          <span class="btn-reject">Request Completed</span>

                      @elseif($admin_status == 'REJECTED')
                          <span class="btn-reject">Request Rejected</span>

                      @else
                          <span class="btn-reject">Pending Approval</span>
                      @endif

                  @endif

                  </td>
                  <td>{{ $requests->c_admin_reject_reason ?? '' }}</td>
         
            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</main>



<!-- Assign Admin Modal -->
<div id="assignAdminModal" class="custom-modal">
    <div class="modal-content">
        <h3>Assign Admin</h3>

        <select id="assign_admin_id" class="form-control">
            <option value="">-- Select Admin --</option>
                <option value="2">
                    Admin 1
                </option>
        {{-- <select id="assign_admin_id" class="form-control">
            <option value="">-- Select Admin --</option>
            @foreach($admins as $admin)
                <option value="{{ $admin->n_slno }}">
                    {{ $admin->c_name }}
                </option>
            @endforeach --}}
        </select>

        <div class="modal-actions">
            <button id="confirmApprove" class="btn-approve">Confirm</button>
            <button id="closeModal" class="btn-reject">Cancel</button>
        </div>
    </div>
</div>



<style>

/* ===== Modal Overlay ===== */
.custom-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(4px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* ===== Modal Box ===== */
.modal-content {
    background: #ffffff;
    padding: 35px;
    width: 450px;              /* Increased size */
    border-radius: 16px;       /* Smooth rounded corners */
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
    animation: modalFade 0.3s ease-in-out;
}

/* Animation */
@keyframes modalFade {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Modal Heading */
.modal-content h3 {
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: 600;
    text-align: center;
    color: #333;
}

/* ===== Stylish Select Dropdown ===== */
#assign_admin_id {
    width: 100%;
    padding: 12px 15px;
    font-size: 15px;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
    transition: all 0.3s ease;
    background: #f9fafb;
}

/* Hover + Focus Effect */
#assign_admin_id:focus {
    border-color: #4f46e5;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
}

/* ===== Buttons Section ===== */
.modal-actions {
    margin-top: 25px;
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

/* Confirm Button */
.modal-actions .btn-approve {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

/* Cancel Button */
.modal-actions .btn-reject {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}


.filter-card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,.05);
    margin-bottom: 20px;
    width: 1000px;
}

.filter-row {
    display: flex;
    gap: 20px;
    align-items: end;
    flex-wrap: wrap;
}

.filter-group label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.filter-input {
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    width: 200px;
}

/* Main content */
.admin-content {
  margin-left: 260px;
  padding: 100px 60px 40px;
  background: #f4f7fb;
  min-height: 100vh;
}

.content-wrapper {
  width: 100%;
  /* padding: 0 50px; */
}

/* Header */
.page-header {
  margin-bottom: 25px;
}

.page-header h2 {
  font-size: 24px;
  font-weight: 700;
}

/* Card */
.table-card {
width: 1000px;
  background: #fff;
  padding: 30px;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(0,0,0,.08);
}

/* Table */
.employee-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.employee-table thead {
  background: #f1f5f9;
}

.employee-table th,
.employee-table td {
  padding: 14px 16px;
  text-align: left;
  border-bottom: 1px solid #e5e7eb;
}

.employee-table th {
  font-weight: 600;
  color: #374151;
}

.employee-table tbody tr:hover {
  background: #f9fafb;
}

/* Mobile */
@media (max-width: 768px) {
  .admin-content {
    margin-left: 0;
    padding: 20px;
  }

  .employee-table th,
  .employee-table td {
    padding: 12px;
    font-size: 13px;
  }
}



.btn-approve {
    background-color: #16a34a;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-approve:hover {
    background-color: #15803d;
}

.btn-reject {
    background-color: #dc2626;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    margin-left: 8px;
    transition: 0.3s;
}

.btn-reject:hover {
    background-color: #b91c1c;
}




</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {
    $('#myTable').DataTable();
});
</script>





  <script>
let approveUrl = '';
let currentRow = '';

$(document).on('click', '.approve-btn', function () {

    approveUrl = $(this).data('url');
    currentRow = $(this).closest('tr');

    $('#assignAdminModal').css('display', 'flex');
});

$('#closeModal').click(function () {
    $('#assignAdminModal').hide();
});
$('#confirmApprove').click(function () {

    let assignedAdmin = $('#assign_admin_id').val();

    if (!assignedAdmin) {
        Swal.fire('Warning', 'Please select an admin', 'warning');
        return;
    }

    $.ajax({
        url: approveUrl,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            assigned_admin_id: assignedAdmin
        },
        success: function (response) {

            $('#assignAdminModal').hide();

            Swal.fire(
                'Approved!',
                'Request has been approved successfully.',
                'success'
            );

            currentRow.find('td:last').html(
                '<span class="status-approved">Approved</span>'
            );
        },
        error: function () {
            Swal.fire('Error', 'Something went wrong!', 'error');
        }
    });
});

    // REJECT BUTTON
    $(document).on('click', '.reject-btn', function () {

        let url = $(this).data('url');

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to reject this request!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire(
                    'Rejected!',
                    'Request has been rejected.',
                    'error'
                ).then(() => {
                    window.location.href = url;
                });

            }
        });
    });

$(document).on('click', '.admin-approve-btn', function () {

    let url = $(this).data('url');
    let row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this request!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approve it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function () {

                    Swal.fire(
                        'Approved!',
                        'Request has been approved successfully.',
                        'success'
                    );

                    // Update status without reload
                    row.find('td:last').html(
                        '<span class="status-approved">Approved</span>'
                    );

                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                }
            });

        }
    });
});



    // REJECT BUTTON
    $(document).on('click', '.admin-reject-btn', function () {

    let url = $(this).data('url');

    Swal.fire({
        title: 'Reject Request',
        input: 'textarea',
        inputLabel: 'Enter Reject Reason',
        inputPlaceholder: 'Type your reason here...',
        inputAttributes: {
            'aria-label': 'Type your reason here'
        },
        inputValidator: (value) => {
            if (!value) {
                return 'Reject reason is required!';
            }
        },
        showCancelButton: true,
        confirmButtonText: 'Reject',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280'
    }).then((result) => {

        if (result.isConfirmed) {

            let reason = result.value;

            // Redirect with reason (GET method)
            window.location.href = url + '?reason=' + encodeURIComponent(reason);

        }
    });
});




    

</script>

