<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
            columns: [
                {title: "Code"},
                {title: "Name"},
                {title: "Action", orderable: false}
            ]
        });
        getData();
    });

    $('.btn-get-data').click(function () {
        getData();
    });

    function getData() {
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val();
        var filter_nama = $('#filter-nama').val();
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{route('kategori.search')}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + filter_kode + '&nama=' + filter_nama,
            success: function (results) {
                var data = results.data;
                $.each(data, function (index, item) {
                    var array_temp = [
                        item.kode,
                        item.nama,
                        '<a href="' + "{{ route('kategori.view', '') }}/" + item.kode + '" class="btn btn-primary">View</a>'
                    ];
                    dataTableObj.row.add(array_temp).draw(true);
                });
                $('#loading-filter').hide();
            },
            error: function (xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data');
                $('#loading-filter').hide();
            }
        });
    }
</script>