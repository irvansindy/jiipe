<div class="d-flex align-items-center justify-content-end mb-3">
    <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="btn btn-outline-dark me-1" id="refresh_table_review" type="button" title="Refresh Table">
                <i class="ti ti-refresh"></i>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="btn btn-outline-primary" id="btnAdd" type="button" data-bs-toggle="modal"
                data-bs-target="#reviewModal" title="Create Review">
                <i class="ti ti-pencil"></i>
            </button>
        </li>
    </ul>
</div>
<div class="table-responsive">
    <table class="table table-hover table-borderless mb-0 table-hover" id="table_user_review">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
