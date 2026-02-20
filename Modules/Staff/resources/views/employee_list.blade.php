@include('staff::layouts.header')

<main class="admin-content">
  <div class="content-wrapper">

    <div class="page-header">
      <h2>Employee List</h2>
    </div>

    <div class="table-card">
      <table class="employee-table"  id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
            
          @foreach($employees as $employee)
          
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $employee->C_FNAME }}</td>
              <td>{{ $employee->C_EMAIL }}</td>
              <td>{{ $employee->N_MOBILE }}</td>
              <td>{{ $employee->C_ROLE }}</td>
            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</main>



<style>

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
  margin-bottom: 30px;
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

/* Table Card */
.table-card {
  background: #121214; /* Dark Card Background */
  padding: 30px;
  border-radius: 20px;
  border: 1px solid #27272A;
  box-shadow: 0 10px 30px rgba(0,0,0,0.4);
  overflow: hidden; /* Contains the table radius */
}

/* Table Styles */
.employee-table {
  width: 100%;
  border-collapse: separate; /* Allows border-radius on rows */
  border-spacing: 0 8px; /* Spacing between rows */
  font-size: 14px;
  color: #E2E8F0;
}

.employee-table thead {
    background: transparent;
}

.employee-table th {
  padding: 15px 20px;
  text-align: left;
  font-weight: 600;
  color: #D4AF37; /* Gold Headers */
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-bottom: 1px solid #27272A;
}

/* Table Rows */
.employee-table tbody tr {
    background: rgba(255, 255, 255, 0.02);
    transition: all 0.3s ease;
}

.employee-table tbody tr:hover {
  background: rgba(212, 175, 55, 0.05); /* Soft Gold Hover */
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.employee-table td {
  padding: 16px 20px;
  border-top: 1px solid #1a1a1d;
  border-bottom: 1px solid #1a1a1d;
  vertical-align: middle;
}

/* Rounded Row Ends */
.employee-table td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-left: 1px solid #1a1a1d;
}
.employee-table td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-right: 1px solid #1a1a1d;
}

/* Cell Specific Styles */
.id-badge {
    color: #888;
    font-size: 12px;
    font-family: monospace;
}

.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #D4AF37, #AA8C2C);
    color: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
}

.email-cell {
    color: #A1A1AA;
}

.role-badge {
    padding: 6px 12px;
    background: rgba(212, 175, 55, 0.15);
    color: #D4AF37;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    border: 1px solid rgba(212, 175, 55, 0.3);
}

/* DataTables Customization Override */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    color: #A1A1AA !important;
    margin-bottom: 20px;
}

.dataTables_wrapper .dataTables_filter input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid #333;
    color: #fff;
    border-radius: 6px;
    padding: 6px 10px;
    outline: none;
}
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #D4AF37;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #fff !important;
    border-radius: 6px !important; 
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #D4AF37 !important;
    border-color: #D4AF37 !important;
    color: #000 !important;
}

/* Mobile */
@media (max-width: 768px) {
  .content-wrapper { padding: 0 15px; }
  .table-card { padding: 15px; overflow-x: scroll; }
  
  .employee-table th, .employee-table td { padding: 12px 10px; font-size: 13px; }
  .user-avatar { width: 28px; height: 28px; font-size: 11px; }
}
</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('#myTable').DataTable();
});
</script>
