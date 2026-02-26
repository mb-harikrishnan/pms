@include('staff::layouts.header')

<main class="admin-content">
  <div class="content-wrapper">

    <div class="page-header">
      <h2>Rejected List</h2>
    </div>

   @php
    $today = \Carbon\Carbon::today()->format('Y-m-d');
@endphp

<div class="filter-card">
  
    <form method="GET" action="{{ route('accounts.wallet_reject_list') }}">
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
            <th>Reason</th>
          
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

                @if($requests->c_admin_reject_reason=='')
                   {{$requests->c_superadmin_reject_reason}}
                   
                @else
                   {{$requests->c_admin_reject_reason}}
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
/* Main Wrapper */
.admin-content {
  margin-left: 260px;      /* sidebar width */
  padding: 100px 60px 40px; /* ⬅️ TOP padding for header */
    background: radial-gradient(circle at top left, #1a1a1d, #09090b);
  min-height: 100vh;
}


/* Main Content Wrapper */
.content-wrapper {
  max-width: 1200px;
  margin: 40px auto;
  padding: 0 20px;
  animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Page Header */
.page-header {
  margin-bottom: 25px;
  border-left: 4px solid #D4AF37;
  padding-left: 20px;
}

.page-header h2 {
    font-family: 'Cinzel', serif;
    font-size: 28px;
    color: #D4AF37;
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.page-header p {
  color: #A1A1AA;
  font-size: 14px;
}

/* Filter Card */
.filter-card {
    background: #121214;
    padding: 25px;
    border-radius: 16px;
    border: 1px solid #27272A;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    margin-bottom: 30px;
}

.card-title {
    color: #fff;
    font-size: 16px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.card-title i { color: #D4AF37; }

.filter-row {
    display: flex;
    gap: 20px;
    align-items: end;
    flex-wrap: wrap;
}

.filter-group label {
    font-size: 12px;
    color: #A1A1AA;
    margin-bottom: 8px;
    display: block;
    font-weight: 500;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 12px;
    color: #D4AF37;
    pointer-events: none;
}
.filter-group {
    flex: 1;
}
.btn-approve {
    background: rgba(46, 204, 113, 0.2);
    color: #2ecc71;
    border: 1px solid rgba(46, 204, 113, 0.3);
    height: 36px;
    padding: 10px;
    border-radius: 10px;
}
.dataTables_length label{
    display: flex;
    align-items: center;
    gap: 5px;
}
.filter-input {
    padding: 10px 10px 10px 35px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid #27272A;
    border-radius: 8px;
    color: #fff;
    width: 100%;
    outline: none;
    transition: 0.3s;
    font-family: 'Inter', sans-serif;
}

.filter-input:focus {
    border-color: #D4AF37;
    background: rgba(212, 175, 55, 0.05);
}

.search-btn {
    padding: 10px 20px;
    background: linear-gradient(135deg, #D4AF37, #AA8C2C);
    color: #000;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: 0.3s;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
}

/* Table Card */
.table-card {
  background: #121214;
  padding: 0;
  border-radius: 20px;
  border: 1px solid #27272A;
  box-shadow: 0 10px 30px rgba(0,0,0,0.4);
  overflow: hidden;
}

.employee-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.employee-table thead {
  background: rgba(255, 255, 255, 0.02);
}

.employee-table th {
  padding: 18px 20px;
  text-align: left;
  font-weight: 600;
  color: #D4AF37;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-bottom: 1px solid #27272A;
}

.employee-table td {
  padding: 16px 20px;
  color: #E2E8F0;
  border-bottom: 1px solid #1a1a1d;
  vertical-align: middle;
}

.employee-table tbody tr:hover {
  background: rgba(212, 175, 55, 0.03);
}

/* Cell Styles */
.id-badge { color: #888; font-family: monospace; }
.user-cell { display: flex; align-items: center; gap: 10px; }
.user-avatar-small {
    width: 28px;
    height: 28px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #D4AF37;
}
.amount-cell { font-weight: 600; color: #fff; }
.date-badge {
    padding: 4px 10px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    font-size: 12px;
    color: #A1A1AA;
}
.reject-reason {
    font-size: 12px;
    color: #e74c3c;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.status-approved, .status-completed {
    background: rgba(46, 204, 113, 0.15);
    color: #2ecc71;
    border: 1px solid rgba(46, 204, 113, 0.3);
}

.status-rejected {
    background: rgba(231, 76, 60, 0.15);
    color: #e74c3c;
    border: 1px solid rgba(231, 76, 60, 0.3);
}

.status-pending {
    background: rgba(241, 196, 15, 0.15);
    color: #f1c40f;
    border: 1px solid rgba(241, 196, 15, 0.3);
}

/* Action Buttons */
.action-buttons { display: flex; gap: 8px; }

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.2s;
    font-size: 16px;
}

.btn-approve {
    background: rgba(46, 204, 113, 0.2);
    color: #2ecc71;
    border: 1px solid rgba(46, 204, 113, 0.3);
}
.btn-approve:hover { background: #2ecc71; color: #fff; }

.btn-reject {
    background: rgba(231, 76, 60, 0.2);
    color: #e74c3c;
    border: 1px solid rgba(231, 76, 60, 0.3);
}
.btn-reject:hover { background: #e74c3c; color: #fff; }


/* Modal Styles (Dark Theme) */
.custom-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-box {
    background: #18181b;
    width: 400px;
    border-radius: 16px;
    border: 1px solid #27272A;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.modal-header {
    background: #121214;
    padding: 20px;
    border-bottom: 1px solid #27272A;
    text-align: center;
}

.modal-header h3 { color: #D4AF37; font-size: 18px; margin-bottom: 5px; }
.modal-header p { color: #A1A1AA; font-size: 13px; }

.modal-body { padding: 25px; }
.modal-body label { display: block; color: #fff; margin-bottom: 10px; font-size: 14px; }

.select-wrapper { position: relative; }
.select-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #D4AF37; pointer-events: none; }
.select-wrapper .arrow-icon { left: auto; right: 15px; color: #A1A1AA; font-size: 16px; }

select {
    width: 100%;
    padding: 12px 12px 12px 40px;
    background: #09090b;
    border: 1px solid #27272A;
    border-radius: 8px;
    color: #fff;
    appearance: none;
    outline: none;
    cursor: pointer;
}
select:focus { border-color: #D4AF37; }

.modal-actions {
    padding: 20px;
    background: #121214;
    border-top: 1px solid #27272A;
    display: flex;
    gap: 15px;
}

.btn-cancel {
    flex: 1;
    padding: 12px;
    background: transparent;
    border: 1px solid #27272A;
    color: #A1A1AA;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}
.btn-cancel:hover { background: #27272A; color: #fff; }

.btn-confirm {
    flex: 1;
    padding: 12px;
    background: linear-gradient(135deg, #D4AF37, #AA8C2C);
    color: #000;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}
.btn-confirm:hover { filter: brightness(1.1); }

/* Responsive */
@media (max-width: 768px) {
  .content-wrapper { padding: 0 15px; }
  .table-card { overflow-x: scroll; }
  .employee-table th, .employee-table td { white-space: nowrap; padding: 12px; }
  .filter-row { flex-direction: column; align-items: stretch; }
  .filter-input { width: 100%; }
}

/* DataTables Overrides */
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, 
.dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate {
    color: #A1A1AA !important;
    padding: 20px;
}
.dataTables_wrapper .dataTables_filter input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid #333;
    color: #fff;
    border-radius: 6px;
    outline: none;
    margin-left: 10px;
    padding: 6px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #D4AF37 !important;
    color: #000 !important;
    border: none;
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




