<?php
require 'function.php';
require 'check.php';
?>
<html>

<head>
    <title>Export Stock Barang Masuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <h2>PT.Macan Tunggal Pratama's Inventory</h2>
        <h4>Export Stock Barang Masuk</h4>
        <div class="data-tables datatable-dark">
            <table class="table table-bordered" id="exportThis" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $takeAllStockData = mysqli_query($link, "SELECT * FROM incoming_goods JOIN stocks ON incoming_goods.itemId = stocks.itemId ");
                    $i = 1;
                    while ($data = mysqli_fetch_array($takeAllStockData)) {
                        $nameItem = $data['nameItem'];
                        $description = $data['description'];
                        $date = $data['date'];
                        $qty = $data['quantity'];
                        $itemId = $data['itemId'];
                        $inItemId = $data['inItemId'];
                    ?>
                        <tr>

                            <td><?= $i++ ?></td>
                            <td><?= $nameItem ?></td>
                            <td><?= $description ?></td>
                            <td><?= $date ?></td>
                            <td><?= $qty ?></td>
                        </tr>

                    <?php
                    };
                    ?>
                </tbody>
            </table>

        </div>

        <script>
            $(document).ready(function() {
                $('#exportThis').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>