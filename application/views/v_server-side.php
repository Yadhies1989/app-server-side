<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <title><?= $title; ?></title>
</head>

<body>
    <div class="container-fluid mt-5 mb-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" onclick="add()">
            Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="formData">
                            <input type="hidden" id="id" name="id" value="">
                            <div class="form-group">
                                <label for="namaDepan">Nama Depan:</label>
                                <input type="text" class="form-control" id="namaDepan" name="nama_depan" placeholder="Nama Depan ...">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaBelakang">Nama Belakang:</label>
                                <input type="text" class="form-control" id="namaBelakang" name="nama_belakang" placeholder="Nama Belakang ...">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat ...">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomorHandphone">Nomor Handphone:</label>
                                <input type="text" class="form-control" id="nomorHandphone" name="no_hp" placeholder="No Handphone ...">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <table id="myTabel" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        var saveData;
        const modal = $('#modalData');
        const tableData = $('#myTabel');
        const formData = $('#formData');
        const modalTitle = $('#modalTitle');
        const btnSave = $('#btnSave');

        $(document).ready(function() {
            tableData.DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('serverside/getData'); ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "target": [-1],
                    "orderable": false
                }]
            });
        });

        function reloadTable() {
            tableData.DataTable().ajax.reload();
        }

        function add() {
            saveData = 'tambah';
            formData[0].reset();
            modal.modal('show');
            modalTitle.text('Tambah Data');
            btnSave.text('Simpan');

            console.log(saveData);
        }

        function save() {
            btnSave.text('Mohon Tunggu ...');
            btnSave.attr('disabled', true);
            if (saveData == 'tambah') {
                url = "<?= base_url('serverside/add') ?>";
            } else {
                url = "<?= base_url('serverside/update') ?>";
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData.serialize(),
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'success') {
                        modal.modal('hide');
                        reloadTable();
                    } else {
                        for (var i = 0; i < response.inputerror.length; i++) {
                            $('[name="' + response.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + response.inputerror[i] + '"]').next().text(response.error_string[i]);
                        }
                    }
                    if (saveData == 'tambah') {
                        btnSave.text('Simpan Data');
                        btnSave.attr('disabled', false);
                    } else {
                        btnSave.text('Ubah Data');
                        btnSave.attr('disabled', false);
                    }

                },
                error: function() {
                    console.log('error database');
                }
            });
        }

        function byid(id, type) {
            if (type == 'edit') {
                saveData = 'edit';
                formData[0].reset();
            }
            $.ajax({
                type: "GET",
                url: "<?= base_url('serverside/byid/') ?>" + id,
                dataType: "JSON",
                success: function(response) {
                    if (type == 'edit') {
                        formData.find('input').removeClass('is-invalid');
                        modalTitle.text('Edit Data');
                        btnSave.text('Edit Data');
                        btnSave.attr('disabled', false);
                        formData[0].reset();
                        $('[name="id"]').val(response.id);
                        $('[name="nama_depan"]').val(response.nama_depan);
                        $('[name="nama_belakang"]').val(response.nama_belakang);
                        $('[name="alamat"]').val(response.alamat);
                        $('[name="no_hp"]').val(response.no_hp);
                        modal.modal('show');
                    } else {
                        var result = confirm('Apakah Akan Menghapus Data?' + response.nama_depan);
                        if (result) {
                            deleteData(response.id);
                        }
                    }
                }
            });
        }

        function deleteData(id) {
            $.ajax({
                type: "POST",
                url: '<?= base_url('serverside/delete/') ?>' + id,
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    reloadTable();
                }
            });
        }
    </script>
</body>

</html>