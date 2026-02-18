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
  
    <form method="GET" action="{{ route('accounts.request_list') }}">
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
            <th>Active User</th>
            <th>Usdt Amount</th>
            <th>Amount in INR</th>
            <th>From Id</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            
          @foreach($db as $requests)
          
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $requests->c_active_user }}</td>
              <td>{{ $requests->n_usdt }}</td>
              <td>{{ $requests->n_amount_inr }}</td>
              <td>{{ $requests->C_FNAME }}</td>
              <td>{{ $requests->d_date }}</td>
                <td>

                  @php
                      $adminId = session('admin_id');
                      $status  = $requests->c_superadmin_status;
                      $admin_status = $requests->c_admin_status;
                  @endphp

                  {{-- ================= SUPER ADMIN (ID = 1) ================= --}}
                  @if($adminId == 1)

                      @if($status == 'pending')
                          <a href="javascript:void(0);"
                            data-url="{{ route('accounts.approve_request', ['id' => $requests->n_slno]) }}"
                            class="btn-approve approve-btn">
                            Approve
                          </a>

                          <a href="javascript:void(0);"
                      data-url="{{ route('accounts.reject_request', ['id' => $requests->n_slno]) }}"
                      class="btn-reject reject-btn">
                      Reject
                    </a>

                   @else
                        @if($status == 'approved')
                            <span class="status-approved">Approved</span>
                        @elseif($status == 'rejected')
                            <span class="status-rejected">Rejected</span>
                        @endif
                    @endif


                  {{-- ================= ADMIN (ID = 2) ================= --}}
                  {{-- ================= ADMIN (ID = 2) ================= --}}
@elseif($adminId == 2)

    {{-- If SuperAdmin has not approved --}}
    @if($status == 'pending')
        <span class="btn-reject">Waiting for SuperAdmin Approval</span>

    @elseif($status == 'rejected')
        <span class="btn-reject">Request Rejected by SuperAdmin</span>

    {{-- If SuperAdmin approved, now check Admin action --}}
    @elseif($status == 'approved')

        @if($admin_status == 'approved')
            <span class="btn-approve">Request Completed</span>

        @elseif($admin_status == 'rejected')
            <span class="btn-reject">Request Rejected</span>

        @else
            <a href="javascript:void(0);"
               data-url="{{ route('accounts.approve_request_admin', ['id' => $requests->n_slno]) }}"
               class="btn-approve approve-btn">
               Approve
            </a>

            <a href="javascript:void(0);"
               data-url="{{ route('accounts.reject_request_admin', ['id' => $requests->n_slno]) }}"
               class="btn-reject reject-btn">
               Reject
            </a>
        @endif

    @endif

                    
                      


                  {{-- ================= OTHER USERS ================= --}}
                  @else

                      @if($admin_status == 'approved')
                          <span class="btn-reject">Request Completed</span>

                      @elseif($admin_status == 'rejected')
                          <span class="btn-reject">Request Rejected</span>

                      @else
                          <span class="btn-reject">Pending Approval</span>
                      @endif

                  @endif

                  </td>
         
            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</main>




<style>

.status-approved {
    background-color: #d1fae5;   /* very soft green */
    color: #065f46;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.status-rejected {
    background-color: #fee2e2;   /* very soft red */
    color: #7f1d1d;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
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
$(document).on('click', '.approve-btn', function () {

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

</script>

