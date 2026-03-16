@include('staff::layouts.header')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">


<main class="admin-content">
<div class="content-wrapper">

<div class="page-header">
<h2>Project List</h2>

<a href="{{ route('staff.add_projects') }}" class="btn btn-primary">
Add Project
</a>
</div>


<table id="myTable" class="employee-table">

<thead>
<tr>
<th></th>
<th>ID</th>
<th>Name</th>
<th>Details</th>
</tr>
</thead>

<tbody>

@foreach($projects as $project)

<tr class="parent-row" data-children='@json($project->children)'>

<td class="details-control">+</td>

<td>{{ $project->n_pjt_id }}</td>

<td>{{ $project->c_project_name }}</td>

<td>
<button class="btn btn-info openProjectModal"
data-id="{{ $project->n_pjt_id }}"
data-name="{{ $project->c_project_name }}">
Add Employee
</button>
</td>

</tr>

@endforeach

</tbody>
</table>

</div>
</main>



{{-- ================= MODAL ================= --}}
<div class="modal fade" id="projectModal">
<div class="modal-dialog modal-lg">
<div class="modal-content project-modal">

<div class="modal-header">
<h5 class="modal-title">📘 Project Details</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">

<div class="row">

<!-- LEFT SIDE (Project Info) -->
<div class="col-md-5 modal-left">

<input type="hidden" id="project_id">

<div class="form-group">
<label>Project Name</label>
<input type="text" id="project_name" class="form-control" readonly>
</div>

<div class="form-group">
<label>Description</label>
<textarea id="description" class="form-control" rows="6"></textarea>
</div>

</div>


<!-- RIGHT SIDE (Assign Members) -->
<div class="col-md-7 modal-right">

<h6 class="assign-title">Assign Members</h6>

<div id="assignSection">

<div class="row assignRow">
<div class="col-md-5">
<select class="form-control role" style="width:100%">
<option value="">Select Role</option>
</select>
</div>

<div class="col-md-5">
<select class="form-control employee" style="width:100%">
<option value="">Select Employee</option>
</select>
</div>

<div class="col-md-2">
<button type="button" class="btn btn-add addRow">+</button>
</div>

</div>

</div>

</div>

</div>
</div>

<div class="modal-footer">
<button class="btn btn-save" id="saveProject">Save</button>
</div>

</div>
</div>
</div>



{{-- ================= STYLES ================= --}}

<style>

.admin-content{
margin-left:260px;
padding:100px 60px 40px;
background:#ffffff;
min-height:100vh;
}

.content-wrapper{
max-width:1200px;
margin:40px auto;
padding:0 20px;
}

.page-header{
margin-bottom:30px;
border-left:4px solid #dc2626;
padding-left:20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.page-header h2{
font-size:28px;
color:#dc2626;
}

.employee-table{
width:100%;
border-collapse:separate;
border-spacing:0 8px;
}

.employee-table th{
padding:15px 20px;
color:#dc2626;
border-bottom:1px solid #e5e7eb;
}

.employee-table td{
padding:16px 20px;
border-top:1px solid #e5e7eb;
border-bottom:1px solid #e5e7eb;
}

.employee-table tbody tr{
background:#f9fafb;
transition:0.3s;
}

.employee-table tbody tr:hover{
background:#fee2e2;
}

.child-row{
background:#fff7f7;
font-size:13px;
}

.btn-primary{
background:#dc2626;
border:none;
padding:10px 18px;
border-radius:8px;
color:#fff;
font-weight:600;
}

.btn-primary:hover{
background:#b91c1c;
}


.btn-info{
background:#b91c1c !important;
border:none !important;
color:#fff !important;
}

.btn-info:hover{
background:#b91c1c !important;
}
.btn-save{
background:#b91c1c !important;
border:none !important;
color:#fff !important;
}

.btn-save:hover{
background:#b91c1c !important;
}



.project-modal{
border-radius:12px;
overflow:hidden;
}

.modal-header{
background:#dc2626;
color:#fff;
}

.modal-title{
font-weight:600;
}

.modal-left{
border-right:2px solid #f1f1f1;
padding:20px;
}

.modal-right{
padding:20px;
background:#fafafa;
}

.assign-title{
font-weight:600;
margin-bottom:15px;
color:#dc2626;
}

/* buttons */

.btn-add{
background:#16a34a;
color:#fff;
border:none;
width:35px;
height:35px;
border-radius:6px;
}

.btn-add:hover{
background:#15803d;
}

.btn-save{
background:#dc2626;
color:#fff;
border:none;
padding:8px 20px;
border-radius:6px;
}

.btn-save:hover{
background:#b91c1c;
}

/* inputs */

.form-control{
border-radius:6px;
}

textarea{
resize:none;
}
</style>



{{-- ================= JS LIBRARIES ================= --}}

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



{{-- ================= DATATABLE ================= --}}

<script>

$(document).ready(function(){

$('#myTable').DataTable();

});

</script>



{{-- ================= CHILD PROJECT EXPAND ================= --}}

<script>

$(document).ready(function(){

$('#myTable tbody').on('click','td.details-control',function(){

var tr = $(this).closest('tr');
var children = tr.data('children');

if(tr.hasClass('shown')){

tr.nextUntil('.parent-row').remove();
tr.removeClass('shown');
$(this).text('+');

}else{

var html='';

if(children.length>0){

children.forEach(function(child){

html+='<tr class="child-row">';
html+='<td></td>';
html+='<td>'+child.n_pjt_id+'</td>';
html+='<td style="padding-left:40px;">↳ '+child.c_project_name+'</td>';

html+='<td style="padding-left:40px;">';
html+='<button class="btn btn-info openProjectModal" ';
html+='data-id="'+child.n_pjt_id+'" ';
html+='data-name="'+child.c_project_name+'">';
html+='Add Employee';
html+='</button>';
html+='</td>';

html+='</tr>';

});

}else{

html+='<tr class="child-row">';
html+='<td></td>';
html+='<td></td>';
html+='<td colspan="2">No Sub Projects</td>';
html+='</tr>';

}

tr.after(html);
tr.addClass('shown');
$(this).text('-');

}

});

});

</script>



{{-- ================= OPEN MODAL ================= --}}

<script>

$(document).on('click','.openProjectModal',function(){

var id=$(this).data('id');
var name=$(this).data('name');

$('#project_id').val(id);
$('#project_name').val(name);

$('#projectModal').modal('show');

});

</script>



{{-- ================= ADD ASSIGN ROW ================= --}}

<script>
$(document).on('click','.addRow',function(){

// destroy select2 before cloning
$('.role').select2('destroy');
$('.employee').select2('destroy');

var newRow = $('.assignRow:first').clone();

// reset values
newRow.find('select').val('');

// append row
$('#assignSection').append(newRow);

// reinitialize select2 for all rows
$('.role').select2({
    placeholder:"Search Role",
    width:'100%'
});

$('.employee').select2({
    placeholder:"Search Employee",
    width:'100%'
});

});


</script>



{{-- ================= DELETE CONFIRM ================= --}}

<script>

function confirmDelete(event){

event.preventDefault();

let url = event.currentTarget.href;

Swal.fire({

title:'Are you sure?',
text:'This will mark as deleted!',
icon:'warning',
showCancelButton:true,
confirmButtonColor:'#d33',
confirmButtonText:'Yes, delete it!'

}).then((result)=>{

if(result.isConfirmed){

window.location.href=url;

}

});

}

</script>



<script>
  $(document).ready(function(){

    // Activate Select2
    $('.role').select2({
        placeholder: "Search Role"
    });

    $('.employee').select2({
        placeholder: "Search Employee"
    });

    // Load roles
    $.ajax({
        url: "{{ route('staff.get_roles') }}",
        type: "GET",
        success: function(res){

            var html = '<option value="">Select Role</option>';

            $.each(res,function(key,value){
                html += '<option value="'+value.n_dept_id+'">'+value.C_NAME+'</option>';
            });

            $('.role').html(html);
            
        }
    });

    // Role change → load employees
    $(document).on('change','.role',function(){

        var role_id = $(this).val();

        $.ajax({
            url: "{{ route('staff.get_employees') }}",
            type: "GET",
            data: { role_id: role_id },
            success: function(res){

                var html = '<option value="">Select Employee</option>';

                $.each(res,function(key,value){
                    html += '<option value="'+value.n_slno+'">'+value.C_FNAME+'</option>';
                });

                $('.employee').html(html);
            }
        });

    });

});
</script>

<script>

$('#saveProject').click(function(){

var project_id = $('#project_id').val();
var description = $('#description').val();

var assignData = [];

$('.assignRow').each(function(){

var role = $(this).find('.role').val();
var employee = $(this).find('.employee').val();

if(role != '' && employee != ''){

assignData.push({
role: role,
employee: employee
});

}

});

$.ajax({
url:"{{ route('staff.save_project_employee') }}",
type:"POST",
data:{
project_id:project_id,
description:description,
assignData:assignData,
_token:"{{ csrf_token() }}"
},

success:function(res){

Swal.fire({
icon:'success',
title:'Saved Successfully'
});

$('#projectModal').modal('hide');

}

});

});

</script>

