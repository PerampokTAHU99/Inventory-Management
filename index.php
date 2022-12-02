<?php
require 'function.php';
require 'check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory MTP - Stock</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
        <!-- Navbar Brand-->
        <div class="w-10 d-flex justify-content-between">
            <a href="index.php">
                <img src="assets/img/logo.png" class="img-fluid m-1" width="150px" href="index.php" alt="...">
            </a>
            <!-- Navbar-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Sidebar Toggle-->
            <a class="navbar-brand ps-3 nameBrand" href="index.php">PT.Macan Tunggal Pratama's Inventory</a>
        </div>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Advance</div>
                        <a class="nav-link collapsed" href="in.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Stock Masuk
                        </a>
                        <a class="nav-link collapsed" href="out.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Stock Keluar
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $_SESSION['name'] ?>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Stock Barang MTP</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Stock Barang

                            <div class="float-right">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                </button>
                                <!-- button export -->
                                <a href="exportStockItem.php" class="btn btn-info text-white" target="
                                -blank">Export Data</a>
                            </div>


                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Tambah Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="function.php">
                                            <div class="modal-body">
                                                <input type="text" name="namaBarang" placeholder="Nama Barang" class="form-control" required>
                                                <br>
                                                <select name="tipe" id="" class="form-control">
                                                    <option value="">Tipe</option>
                                                    <option value="Diesel Engine Oils (Exceed Performance)">Diesel Engine Oils (Exceed Performance)</option>
                                                    <option value="Diesel Engine Oils">Diesel Engine Oils</option>
                                                    <option value="Gasoline Engine Oil">Gasoline Engine Oil</option>
                                                    <option value="Motorcyle Engine Oil">Motorcyle Engine Oil</option>
                                                    <option value="Gear & Transmission Oils (Exceed Performance)">Gear & Transmission Oils (Exceed Performance)</option>
                                                    <option value="Hydraulic Oils (Exceed Perfromance)">Hydraulic Oils (Exceed Perfromance)</option>
                                                    <option value="Gear & Transmission Oils">Gear & Transmission Oils</option>
                                                    <option value="Hydraulic Oils (Exceed Perfromance)">Hydraulic Oils (Exceed Perfromance)</option>
                                                    <option value="Hydraulic Oils">Hydraulic Oils</option>
                                                    <option value="Gear Oils (Flender Specs)">Gear Oils (Flender Specs)</option>
                                                    <option value="Gear Oils (Industrial)">Gear Oils (Industrial)</option>
                                                    <option value="Compressor Oils">Compressor Oils</option>
                                                    <option value="Marine Oils">Marine Oils</option>
                                                </select>
                                                <br>
                                                <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required>
                                                <br>
                                                <input type="number" name="priceLiter" placeholder="Price/Liter" class="form-control" required>
                                                <br>
                                                <input type="number" name="priceDealer" placeholder="Price Dealer" class="form-control" required>
                                                <br>
                                                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" name="addNewBarang" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $takeStockData = mysqli_query($link, "SELECT * FROM stocks WHERE stock < 1");
                            while ($fetch = mysqli_fetch_array($takeStockData)) {
                                $items = $fetch['nameItem'];
                            ?>
                                <div class="alert alert-danger alert-dismissible">

                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Danger!</strong> Barang <?= $items; ?> telah habis!!!
                                </div>
                            <?php
                            }
                            ?>
                            <table id="datatablesSimple">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Barang</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                        <th>Price/Liter(Dealer)</th>
                                        <th>Dealer Price</th>
                                        <th>Stock</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $takeAllStockData = mysqli_query($link, "SELECT * FROM stocks");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($takeAllStockData)) {
                                        $nameItem = $data['nameItem'];
                                        $type = $data['type'];
                                        $description = $data['description'];
                                        $priceLitre = $data['priceLitre'];
                                        $priceDealer = $data['priceDealer'];
                                        $stocks = $data['stock'];
                                        $itemId = $data['itemId'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td><?= $nameItem ?></td>
                                            <td><?= $type ?></td>
                                            <td><?= $description ?></td>
                                            <td>Rp.<?= $priceLitre ?></td>
                                            <td>Rp.<?= $priceDealer ?></td>
                                            <td><?= $stocks ?></td>
                                            <td class="text-center">
                                                <div style="width: 150px; text-align: center">
                                                    <button type="button" class="btn btn-warning bi bi-trash" data-toggle="modal" data-target="#edit<?= $itemId; ?>">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="itemToDeleted" value="<?= $itemId; ?>">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $itemId; ?>">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- The Edit Modal -->
                                        <div class="modal fade" id="edit<?= $itemId; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="POST" action="function.php">
                                                        <div class="modal-body">
                                                            <input type="text" name="namaBarang" value="<?= $nameItem; ?>" placeholder="Nama Barang" class="form-control" required>
                                                            <br>
                                                            <input type="text" name="type" value="<?= $type; ?>" placeholder="type" class="form-control" required>
                                                            <br>
                                                            <input type="text" name="deskripsi" value="<?= $description; ?>" placeholder="Deskripsi" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="priceLitre" value="<?= $priceLitre; ?>" placeholder="priceLitre" class="form-control" required>
                                                            <br>
                                                            <input type="number" name="priceDealer" value="<?= $priceDealer; ?>" placeholder="PriceDealer" class="form-control" required>
                                                            <br>
                                                            <input type="hidden" name="itemId" value="<?= $itemId; ?>">
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="updateItem" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Delete Modal -->
                                        <div class="modal fade" id="delete<?= $itemId; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="POST" action="function.php">
                                                        <div class="modal-body">
                                                            Apakah anda yakin menghapus <?= $nameItem; ?> ?
                                                            <br>
                                                            <input type="hidden" name="itemId" value="<?= $itemId; ?>">
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="deleteItem" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PT.Macan Tunggal Pratama 2022</div>
                        <div>
                            <a href="404.php">Privacy Policy</a>
                            &middot;
                            <a href="404.php">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>