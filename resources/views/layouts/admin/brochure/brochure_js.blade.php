<script>
    function showLoader() {
        $("#modalLoader").fadeIn(200);
    }

    function hideLoader() {
        $("#modalLoader").fadeOut(200);
    }

    $(() => {
        var table_brochure = $('#table_brochure').DataTable({
            processing: true,
            ajax: {
                url: '{{ route('fetch-brochures') }}',
                type: 'GET',
                dataType: 'json'
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'translations[0].title',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    data: 'date_input',
                    defaultContent: '<i>Not set</i>'
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-brochure_id="'+item.id+'" class="btn btn-outline-info btn-sm mt-2 detail_brochure" data-toggle="modal" data-target="#ModalBrochure"><i class="ti ti-pencil"></i></button>'
                    }
                },
            ],
        })
        
        $('#create_brochure').click((e) => {
            e.preventDefault()
            $('#ModalBrochureLabel').empty().html('Create Brochure')
            $('#brochure_form')[0].reset()
            $('#input_id').empty().val()
            $('#button_action_brochure').empty().html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_brochure">Submit</button>
            `)
        })

        $(document).on('click', '.detail_brochure', function (e) {
            e.preventDefault()
            let brochure_id = $(this).data('brochure_id')
            $('#ModalBrochure').modal('show')
            $('#ModalBrochureLabel').empty().html('Detail Brochure')
            $('#brochure_form')[0].reset()
            $('#button_action_brochure').empty().html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_brochure">Update</button>
            `)
            ajaxRequest({
                url: '{{ route("fetch-brochures-id") }}',
                method: 'GET',
                data: { id: brochure_id },
                onSuccess: function (res) {
                    let brochure = res.data;
                    $('#ModalBrochureLabel').text("Detail Brochure");
                    if (brochure.translations.length > 0) {
                        $.each(brochure.translations, function(i, brochure) {
                            // Set judul
                            $(`#brochure_title_${brochure.locale}`).val(brochure.title);

                            // Hapus link lama jika ada
                            $(`#current_file_${brochure.locale}`).empty();

                            // Jika ada file, buat link
                            if (brochure.file) {
                                const fileUrl = "{{ Storage::url('') }}" + brochure.file; // base Storage path
                                $(`#current_file_${brochure.locale}`).html(`
                                    <small class="d-block">
                                        File sekarang:
                                        <a href="${fileUrl}" target="_blank">Lihat PDF</a>
                                    </small>
                                `);
                            }
                        })
                    }

                    $('#brochure_is_active').val(brochure.is_active)
                    $('#brochure_is_active').prop('checked', brochure.is_active == 1 ? true : false)

                    $('#button_action_brochure').html(`
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="update_brochure">Update</button>
                    `);
                },
                onError: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat ambil detail brochure.');
                }
            })
        })

        $(document).on('click', '#submit_brochure', (e) => {
            e.preventDefault()
            ajaxRequest({
                formSelector: '#brochure_form',
                url: '{{ route("store-brochures") }}',
                method: 'POST',
                onSuccess: function (res) {
                    Swal.fire('Berhasil!', 'Data berhasil ditambahkan', 'success');
                }
            });
        })

        $(document).on('click', '#update_brochure', (e) => {
            e.preventDefault()
            ajaxSubmit('#brochure_form', '{{ route("store-brochures") }}', 'POST', function(res){
                Swal.fire('Berhasil!', 'Data berhasil ditambahkan', 'success');
                // aksi tambahan: reload table, close modal, dsb.
            });
        })
    })
</script>