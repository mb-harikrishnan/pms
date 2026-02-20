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
/* Main content */
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


.content-wrapper {
  width: 100%;
  /* padding: 0 50px; */
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



</style>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('#myTable').DataTable();
});
</script>
