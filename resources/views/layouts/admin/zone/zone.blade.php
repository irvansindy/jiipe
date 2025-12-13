<div class="table-responsive">
    <table class="table table-hover table-borderless mb-0" id="table_zone" width="100%">
        <thead>
            <tr>
                <th>NAME</th>
                <th>SUBTITLE</th>
                <th class="text-end">ACTION</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>NAME</th>
                <th>SUBTITLE</th>
                <th class="text-end">ACTION</th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    // Tambahkan fungsi ini di zone_js.blade.php atau file JS zone yang sudah ada
    function renderZoneActionButtons(data, type, row) {
        let buttons = '';

        // Button Edit Zone
        buttons += `
        <button type="button" class="btn btn-sm btn-warning me-1"
                onclick="editZone(${data})"
                title="Edit Zone">
            <i class="ti ti-pencil"></i>
        </button>
    `;

        // Button Delete Zone
        buttons += `
        <button type="button" class="btn btn-sm btn-danger me-1"
                onclick="deleteZone(${data})"
                title="Delete Zone">
            <i class="ti ti-trash"></i>
        </button>
    `;

        // Dropdown untuk Zone Cluster (hanya untuk zone_class_id = 1)
        if (row.zone_class_id === 1) {
            buttons += `
            <div class="btn-group">
                <button type="button"
                        class="btn btn-sm btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        title="Zone Clusters">
                    <i class="ti ti-sitemap"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item"
                           href="javascript:void(0)"
                           onclick="openZoneClusterModal(${data}, '${row.name || ''}')">
                            <i class="ti ti-list me-2"></i> Manage Clusters
                        </a>
                    </li>
                </ul>
            </div>
        `;
        }

        return buttons;
    }

    // Update DataTable columns configuration untuk zone table
    // Pastikan di zone_js.blade.php, column ACTION menggunakan fungsi ini:
    /*
    {
        data: 'id',
        className: 'text-end',
        render: function(data, type, row) {
            return renderZoneActionButtons(data, type, row);
        }
    }
    */
</script>
