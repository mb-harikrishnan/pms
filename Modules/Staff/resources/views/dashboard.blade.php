@include('staff::layouts.header')
<!-- MAIN CONTENT -->
<div class="main-content">

    <div class="dashboard-cards">

        <div class="dash-card">
            <h4>Total Employees</h4>
            <h2>{{ $employeeCount }}</h2>
            <p>Active staff</p>
        </div>

       

    </div>

</div>




<style>
    /* MAIN CONTENT */
.main-content {
    margin-left: 240px;
    margin-top: 60px;
    padding: 30px;
    width: calc(100% - 240px);
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}


.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
}

.dash-card {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    transition: 0.3s;
    border-left: 6px solid #000;
}

.dash-card:hover {
    transform: translateY(-5px);
}

.dash-card h4 {
    font-size: 14px;
    letter-spacing: 1px;
    color: #555;
    margin-bottom: 10px;
}

.dash-card h2 {
    font-size: 32px;
    color: #000;
    margin-bottom: 5px;
}

.dash-card p {
    font-size: 13px;
    color: #777;
}

</style>