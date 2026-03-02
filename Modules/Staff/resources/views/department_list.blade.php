@include('staff::layouts.header')


<main class="admin-content">
  <div class="content-wrapper">

    <div class="page-header">
      <h2>Department List</h2>
    </div>

    <div class="table-card">
      <table class="employee-table"  id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Department</th>
            <th>CODE</th>
            <th>DESCRIPTION</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
            
          @foreach($departments as $values)
          
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $values->C_NAME }}</td>
              <td>{{ $values->C_CODE }}</td>
              <td>{{ $values->C_DESCRIPTION }}</td>
              <td>
                    {{-- <a href="{{ route('staff.delete_employee', $values->n_dept_id) }}" class="btn-edit">
                        Delete
                    </a> --}}
                    <a href="{{ route('staff.delete_employee', $values->n_dept_id) }}"
                    class="btn-edit"
                        onclick="return confirmDelete(event)">
                            Delete
                    </a>
                </td>

            </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</main>



<style>


.btn-edit {
    display: inline-block;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #dc2626;
    border: 1px solid #dc2626;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: transparent;
}

.btn-edit:hover {
    background: #dc2626;
    color: #fff;
}

.admin-content {
  margin-left: 260px;
  padding: 100px 60px 40px;
  background: #ffffff; /* Changed to White */
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
  border-left: 4px solid #dc2626; /* Changed Gold to Red */
  padding-left: 20px;
}

.page-header h2 {
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: #dc2626; /* Red */
  margin-bottom: 5px;
  letter-spacing: 1px;
}

.page-header p {
  color: #555;
  font-size: 14px;
}

/* Table Card */
.table-card {
  background: #ffffff; /* White Card */
  padding: 30px;
  border-radius: 20px;
  border: 1px solid #e5e7eb;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  overflow: hidden;
}

/* Table Styles */
.employee-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0 8px;
  font-size: 14px;
  color: #000000; /* Fetched data black */
}

.employee-table thead {
    background: transparent;
}

.employee-table th {
  padding: 15px 20px;
  text-align: left;
  font-weight: 600;
  color: #dc2626; /* Header Red */
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-bottom: 1px solid #e5e7eb;
}

/* Table Rows */
.employee-table tbody tr {
    background: #f9fafb;
    transition: all 0.3s ease;
}

.employee-table tbody tr:hover {
  background: #fee2e2; /* Light red hover */
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.employee-table td {
  padding: 16px 20px;
  border-top: 1px solid #e5e7eb;
  border-bottom: 1px solid #e5e7eb;
  vertical-align: middle;
  color: #000000; /* Data Black */
}

/* Rounded Row Ends */
.employee-table td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-left: 1px solid #e5e7eb;
}
.employee-table td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-right: 1px solid #e5e7eb;
}

/* DataTables Customization Override */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    color: #333 !important;
    margin-bottom: 20px;
}

.dataTables_wrapper .dataTables_filter input {
    background: #ffffff;
    border: 1px solid #ccc;
    color: #000;
    border-radius: 6px;
    padding: 6px 10px;
    outline: none;
}

.dataTables_wrapper .dataTables_filter input:focus {
    border-color: #dc2626;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #000 !important;
    border-radius: 6px !important; 
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #dc2626 !important;
    border-color: #dc2626 !important;
    color: #ffffff !important;
}

/* Mobile */
@media (max-width: 768px) {
  .content-wrapper { padding: 0 15px; }
  .table-card { padding: 15px; overflow-x: scroll; }
  
  .employee-table th, .employee-table td { padding: 12px 10px; font-size: 13px; }
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
function confirmDelete(event) {
    event.preventDefault();
    let url = event.currentTarget.href;

    Swal.fire({
        title: 'Are you sure?',
        text: "This will mark as deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
