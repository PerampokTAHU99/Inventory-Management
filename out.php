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
    <title>Inventory MTP - Barang Keluar</title>
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
                    <h1 class="mt-4">Barang Keluar</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Stock Barang Keluar
                            <div class="float-right">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                </button>
    
                                <!-- button export -->
                                <a href="exportOutItem.php" class="btn btn-info text-white" target="
                                -blank">Export Data</a>
                            </div>

                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Tambah Barang Keluar</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="function.php">
                                            <div class="modal-body">
                                                <select name="item" id="" class="form-control">
                                                    <option value="">Nama Barang</option>
                                                    <?php
                                                    $takeAllData = mysqli_query($link, "SELECT * FROM stocks");
                                                    while ($fetcharray = mysqli_fetch_array($takeAllData)) {
                                                        $thisNameItem = $fetcharray['nameItem'];
                                                        $thisIdItem = $fetcharray['itemId'];
                                                    ?>
                                                        <option value="<?= $thisIdItem; ?>"><?= $thisNameItem; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                                <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                                                <br>
                                                <select name="employee" id="" class="form-control">
                                                    <option value="">Nama Sales</option>
                                                    <?php
                                                    $takeAllDataEmp = mysqli_query($link, "SELECT * FROM employees");
                                                    while ($fetcharray = mysqli_fetch_array($takeAllDataEmp)) {
                                                        $thisNameEmployee = $fetcharray['name'];
                                                        $thisIdEmployee = $fetcharray['employeeId'];
                                                    ?>
                                                        <option value="<?= $thisIdEmployee; ?>"><?= $thisNameEmployee; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" name="outputItem" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Sales</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $takeAllStockData = mysqli_query($link, "SELECT * FROM `outgoing_goods` JOIN stocks ON stocks.itemId = outgoing_goods.itemId JOIN employees ON outgoing_goods.employeeId = employees.employeeId");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($takeAllStockData)) {
                                        $nameItem = $data['nameItem'];
                                        $description = $data['description'];
                                        $date = $data['date'];
                                        $qty = $data['quantity'];
                                        $sales = $data['name'];
                                        $itemId = $data['itemId'];
                                        $outItemId = $data['outItemId'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td><?= $nameItem ?></td>
                                            <td><?= $description ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $qty ?></td>
                                            <td><?= $sales ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $outItemId; ?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="itemToDeleted" value="<?= $itemId; ?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $outItemId; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- The Edit Modal -->
                                        <div class="modal fade" id="edit<?= $outItemId; ?>">
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
                                                            <input type="number" name="qty" value="<?= $qty; ?>" placeholder="Deskripsi" class="form-control" required><br>
                                                            <select name="employeeId" id="" class="form-control">
                                                                <?php
                                                                $takeAllData = mysqli_query($link, "SELECT * FROM employees");
                                                                while ($fetcharray = mysqli_fetch_array($takeAllData)) {
                                                                    $thisNameEmployee = $fetcharray['name'];
                                                                    $thisIdEmployee = $fetcharray['employeeId'];
                                                                ?>
                                                                    <option value="<?= $thisIdEmployee; ?>"><?= $thisNameEmployee; ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="itemId" value="<?= $itemId; ?>">
                                                            <input type="hidden" name="outItemId" value="<?= $outItemId; ?>">
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="updateOutgoingItem" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Delete Modal -->
                                        <div class="modal fade" id="delete<?= $outItemId; ?>">
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
                                                            <input type="hidden" name="quty" value="<?= $qty; ?>">
                                                            <input type="hidden" name="outItemId" value="<?= $outItemId; ?>">
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" name="deleteOutgoingItem" class="btn btn-danger">Delete</button>
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