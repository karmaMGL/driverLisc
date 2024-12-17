@section('contentDashboard')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <div>
        <h1 class="h2">Эргээд тавтай морил, {{Auth::guard('Admin')->user()->email}}!</h1>
        <p class="text-muted">Here's what's happening with your projects today.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary me-2">
            <i class="bi bi-envelope me-1"></i> Email
        </button>
        <button type="button" class="btn btn-sm btn-outline-secondary me-2">
            <i class="bi bi-printer me-1"></i> Print
        </button>
        <button type="button" class="btn btn-sm btn-primary">
            <i class="bi bi-person-plus me-1"></i> Add User
        </button>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Нийт хэрэглэгчид</h6>
                    <i class="bi bi-people fs-4 text-primary"></i>
                </div>
                <h2 class="card-title mb-0">{{$data['members']}}</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-down"></i> 0%</span>
                    <small class="text-muted">from last month</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Авсан нийт шалгалт</h6>
                    <i class="bi bi-file-earmark-check fs-4 text-success"></i>
                </div>
                <h2 class="card-title mb-0">{{$data['performance']}}</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-up"></i> 12</span>
                    <small class="text-muted">tests this week</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="card-subtitle text-muted">Completion Rate</h6>
                    <i class="bi bi-bar-chart fs-4 text-warning"></i>
                </div>
                <h2 class="card-title mb-0">87.4%</h2>
                <p class="card-text mt-2">
                    <span class="text-success me-1"><i class="bi bi-arrow-up"></i> 4.3%</span>
                    <small class="text-muted">from last week</small>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
