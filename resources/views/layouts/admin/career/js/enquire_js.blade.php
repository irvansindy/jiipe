<script>
    $(document).ready(function() {
        // CSRF token for AJAX
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        var tableEnquireList = $('#table_enquire_list').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('fetch-career-enquire') }}",
                data: function(d) {
                    d.position_id = $('#filter_position').val();
                    d.email = $('#filter_email').val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'position_id',
                    name: 'position_id',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'name',
                    name: 'name',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'email',
                    name: 'email',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'date',
                    name: 'date',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: null,
                    title: 'Action',
                    wrap: true,
                    orderable: false,
                    render: function(item) {
                        return `
                        <button class="btn btn-sm btn-outline-info view_enquire" data-id="${item.id}">View</button>
                        <button class="btn btn-sm btn-outline-danger delete_enquire" data-id="${item.id}">Delete</button>
                    `;
                    }
                }
            ]
        });

        // Filters
        $('#filterEnquireForm').on('submit', function(e) {
            e.preventDefault();
            tableEnquireList.ajax.reload();
        });

        $('#resetEnquireFilters').on('click', function() {
            $('#filter_email').val('');
            $('#filter_position').val('');
            tableEnquireList.ajax.reload();
        });

        $('#refresh_table_enquire_list').on('click', function() {
            tableEnquireList.ajax.reload();
        });

        // View details
        $(document).on('click', '.view_enquire', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('get-career-enquire-details') }}",
                method: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    var d = res.data || res;
                    var html = `
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt><dd class="col-sm-9">${d.id}</dd>
                        <dt class="col-sm-3">Position ID</dt><dd class="col-sm-9">${d.position_id}</dd>
                        <dt class="col-sm-3">Name</dt><dd class="col-sm-9">${d.name}</dd>
                        <dt class="col-sm-3">Email</dt><dd class="col-sm-9">${d.email}</dd>
                        <dt class="col-sm-3">Phone</dt><dd class="col-sm-9">${d.phone}</dd>
                        <dt class="col-sm-3">Education</dt><dd class="col-sm-9">${d.education}</dd>
                        <dt class="col-sm-3">Experience</dt><dd class="col-sm-9">${d.experience}</dd>
                        <dt class="col-sm-3">Job Level</dt><dd class="col-sm-9">${d.job_level}</dd>
                        <dt class="col-sm-3">Date</dt><dd class="col-sm-9">${d.date}</dd>
                        <dt class="col-sm-3">Message</dt><dd class="col-sm-9">${d.body || ''}</dd>
                        <dt class="col-sm-3">CV</dt><dd class="col-sm-9">${d.file_cv ? `<a href="/uploads/${d.file_cv}" target="_blank">Download</a>` : '—'}</dd>
                        <dt class="col-sm-3">Other Docs</dt><dd class="col-sm-9">${d.file_complementary_documents ? `<a href="/uploads/${d.file_complementary_documents}" target="_blank">Download</a>` : '—'}</dd>
                    </dl>
                `;
                    $('#enquireDetailBody').html(html);
                    $('#delete_enquire_btn').data('id', d.id);
                    $('#modalEnquire').modal('show');
                },
                error: function(xhr) {
                    alert('Failed to fetch enquire details');
                }
            })
        });

        // Delete from table
        $(document).on('click', '.delete_enquire', function() {
            if (!confirm('Are you sure you want to delete this enquire?')) return;
            var id = $(this).data('id');
            $.ajax({
                url: `/{{ request()->segment(1) }}/admin/delete-career-enquire/${id}`.replace(
                    '//', '/'),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(res) {
                    showToast('Success', res.message || 'Deleted', 'success');
                    tableEnquireList.ajax.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete enquire');
                }
            })
        });

        // Delete from modal
        $('#delete_enquire_btn').on('click', function() {
            var id = $(this).data('id');
            if (!id) return;
            if (!confirm('Are you sure you want to delete this enquire?')) return;
            $.ajax({
                url: `/{{ request()->segment(1) }}/admin/delete-career-enquire/${id}`.replace(
                    '//', '/'),
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(res) {
                    $('#modalEnquire').modal('hide');
                    showToast('Success', res.message || 'Deleted', 'success');
                    tableEnquireList.ajax.reload();
                },
                error: function(xhr) {
                    alert('Failed to delete enquire');
                }
            })
        });

        // Simple toast helper (expects showToast defined globally otherwise fallback to alert)
        function showToast(title, message, type) {
            if (typeof toastr !== 'undefined') {
                if (type === 'success') toastr.success(message, title);
                else if (type === 'danger') toastr.error(message, title);
                else toastr.info(message, title);
            } else {
                // fallback
                console.log(title, message);
            }
        }
    });
</script>
