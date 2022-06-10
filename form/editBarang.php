<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
        <h1 class="mb-3"><i class="fa-solid fa-edit me-2"></i>Edit informasi barang</h1>
        <form>
            <div class="row mb-3">
                <label for="anime" class="col-sm-2 col-form-label">Nama Barang *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required="required">
                </div>
            </div>
            <div class="row mb-3">
                <label for="income" class="col-sm-2 col-form-label">Harga Barang *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" step="50" class="form-control" id="harga_barang" name="harga_barang"
                            value="0" required="required">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="duration" class="col-sm-2 col-form-label">Stok Barang *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="stok_barang" name="stok_barang" value="0"
                            required="required">
                        <span class="input-group-text">item</span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
              <label for="orig_lang" class="col-sm-2 col-form-label">Made In </label>
              <div class="col-sm-10">
                <select class="form-select" id="asal_id" name="asal_id">
                  <option selected="selected">-</option>
                  <!-- Auto Fill -->
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="orig_lang" class="col-sm-2 col-form-label">Kondisi </label>
              <div class="col-sm-10">
                <select class="form-select" id="id_kondisi" name="id_kondisi">
                  <option selected="selected">-</option>
                  <!-- Auto Fill -->
                </select>
              </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-info text-white"><i
                            class="fa-solid fa-paper-plane me-2"></i>Submit</button>
                    <a href="../index.php" class="btn btn-outline-secondary"><i
                            class="fa-solid fa-arrow-left me-2"></i>Back</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            $(document).ready(function () {
                $.get("../asal.php", function (response) {
                    $.each(response, function (key, value) {
                        $("#asal_id").append("<option value='"+ value.asal_id +"'>"+ value.country +"</option>")
                    })
                })
                $.get("../kondisi.php", function (response) {
                    $.each(response, function (key, value) {
                        $("#id_kondisi").append("<option value='"+ value.id_kondisi +"'>"+ value.kondisi +"</option>")
                    })
                })
                var id = <?php $id = isset($_GET['id']) ? $_GET['id'] : 0; echo $id ?>;
                $.get("../barang.php?action=readidBarang&id=" + id, function (data) {
                    $("#nama_barang").val(data[0]['nama_barang']);
                    $("#harga_barang").val(data[0]['harga_barang']);
                    $("#stok_barang").val(data[0]['stok_barang']);
                    $("#asal_id").val(data[0]['asal_id']);
                    $("#id_kondisi").val(data[0]['id_kondisi']);
                })
                $("form").submit(function (event) {
                    event.preventDefault();
                    var data = $(this).serialize();
                    $.post("../barang.php?action=editBarang&id=" + id, data, function (response) {
                        alert("Data barang baru berhasil ditambahkan");
                    })
                })
            });
        </script>
</body>
</html>