<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <title>Toko Online</title>
    <style>
    h1 {
        font-size: 2em;
    }

    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }
    </style>
</head>

<body>
    <div class="container my-2" id="container">
        <a class="btn btn-primary" href="form/tambahBarang.php">Tambah</a>
        <div class="row mt-4">
            <div class="col-lg-8 col-xxl-9">
                <div class="row g-3" id="dataHolder">
                    <!-- Auto Fill -->
                </div>
                <div class="row g-3 mt-3">
                    <div class="col d-grid">
                        <button type="button" class="btn btn-primary" id="load"><i
                                class="fa-solid fa-circle-chevron-down me-2"></i>Show More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                </div>
                <div class="modal-body" id="modalContent">Anda yakin ingin menghapus barang?</div>
                <div class="modal-footer">
                    <button type="button" id="deleteBarangNo" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="button" id="deleteBarangYes" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    var page = 0;
    $(document).ready(function() {
        $("#load").click(function() {
            $(this).html('Loading...').attr('disabled', 'disabled');
            $.get("barang.php?action=readBarang&start=" + page, function(response) {
                $.each(response, function(key, value) {
                    $("#dataHolder").append(`
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">` + value.nama_barang + `</h4>
                                        <p class="card-text">Rp.` + value.harga_barang + `</p>
                                        <p class="card-text">Stok ` + value.stok_barang + `</p>
                                        <p class="card-text">Made In ` + value.country + `</p>
                                        <p class="card-text">Kondisi =  ` + value.kondisi + `</p>
                                        <div class="btn-group btn-group-sm" style="float:right">                                    
                                            <a href="form/editBarang.php?id=` + value.ID + `" class="btn btn-outline-secondary fa fa-edit"></a>
                                            <button type="button" id="deleteBarang" value="` + value.ID + `" class="btn btn-outline-danger fa fa-trash"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                });
                page += 15;
                $('#load').html("<i class='fa-solid fa-circle-chevron-down me-2'></i>Show More")
                    .removeAttr('disabled');
            });
        }).trigger('click');

        var existCondition = setInterval(function() {
        if ($('.card').length) {
            clearInterval(existCondition);       
            $("#deleteBarang").click(function () {
                alert($('.card').length);
                $("#modalContent").text(this.value);
                $("#modalDelete").modal('show');
                $("#deleteBarangYes").val(this.value);
            });
            
        }
        }, 100);

        $("#deleteBarangYes").click(function () {
            $("#modalDelete").modal('hide');
            $.get("barang.php?action=deleteBarang&id" + this.value, function (data) {
                alert(data);
            })
        });
        $("#deleteBarangNo").click(function () {
            $("#modalDelete").modal('hide');
        });

    });
    </script>
</body>

</html>