<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <title>Inventaris Online</title>
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
    <!-- coba tampilan -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Inventaris Online</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Filter</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                        <form class="d-flex ms-2">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </ul>
                    
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Manage Your Inventory</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this online Inventory</p>
                </div>
            </div>
        </header>
        <!-- akhir header -->

        <!-- konten-->
        <div class="container mt-5">
        <a class="btn btn-primary justify-content-end" href="form/tambahBarang.php">Tambah</a>
            <!--barang -->
            <div class="row row-col-lg-4 justify-content-center my-5">
                <div class="col mb-5">
                    <div class="row g-3" id="dataHolder">
                        <!-- Auto Fill -->
                    </div>
                </div>
            </div>
            <!-- akhir barang -->
            <div class="row g-3 mt-3">
                <div class="col d-grid mb-5">
                    <button type="button" class="btn btn-primary" id="load"><i
                            class="fa-solid fa-circle-chevron-down"></i>Show More</button>
                </div>
            </div>
        </div>
        <!-- akhir konten -->
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>

        <!-- akhir coba tampilan -->

        <!-- main program -->
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
                                        <img class="card-img-top" src="`+ value.thumbnail +`"/>
                                        <h4 class="card-title">` + value.nama_barang + `</h4>
                                        <p class="card-text">Harga = Rp.` + value.harga_barang + `</p>
                                        <p class="card-text">Stok = ` + value.stok_barang + `</p>
                                        <p class="card-text">Made In ` + value.country + `</p>
                                        <p class="card-text">Kondisi =  ` + value.kondisi + `</p>
                                        <div class="btn-group btn-group-sm" style="float:right">                                    
                                            <a href="form/editBarang.php?id=` + value.ID + `" class="btn btn-outline-secondary fa fa-edit"></a>
                                            <button type="button" id="deleteBarang" value="` + value.nama_barang + `&` +value.ID + `" class="btn btn-outline-danger fa fa-trash"></button>
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
            $('#dataHolder').on("click", '#deleteBarang', function () {
                var data = this.value.split('&');
                $("#modalContent").text("Anda yakin ingin menghapus barang " + data[0] + "?");
                $("#modalDelete").modal('show');
                $("#deleteBarangYes").val(data[1]);
            });
            
        }
        }, 100);

        $("#deleteBarangYes").click(function () {
            $("#modalDelete").modal('hide');
            $.get("barang.php?action=deleteBarang&id=" + this.value, function (data) {
                alert("Barang berhasil dihapus");
                location.reload();
            })
        });
        $("#deleteBarangNo").click(function () {
            $("#modalDelete").modal('hide');
        });

    });
    </script>
</body>

</html>