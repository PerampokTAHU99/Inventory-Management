<?php
session_start();

//connection db
$link = mysqli_connect("localhost", "root", "", "inventory");
if (!$link) {
    die("Koneksi dengan database gagal : " . mysqli_connect_error() . " - " . mysqli_connect_error());
}

//add new item
if (isset($_POST['addNewBarang'])) {
    $namaBarang = $_POST['namaBarang'];
    $tipe = $_POST['tipe'];
    $deskripsi = $_POST['deskripsi'];
    $priceLiter = $_POST['priceLiter'];
    $priceDealer = $_POST['priceDealer'];
    $stock = $_POST['stock'];
    if ($tipe == '') {
        echo "
        <script>
            alert('Inputan tipe tidak boleh kosong');
            window.location = 'index.php';
        </script>
        ";
    } else {

        $addToTable = mysqli_query($link, "INSERT INTO stocks (nameItem, type, description, priceLitre, priceDealer, stock) VALUES ('$namaBarang','$tipe','$deskripsi','$priceLiter','$priceDealer','$stock')");
        if ($addToTable) {
            echo "
            <script>
                window.location = 'index.php';
            </script>
            ";
        } else {
            echo 'gagal';
            echo "
            <script>
                window.location = 'index.php';
            </script>
            ";
        }
    }
}


//add incoming goods
if (isset($_POST['inputItem'])) {
    $item = $_POST['item'];
    if ($item == '') {
        echo "
        <script>
            alert('Inputan Nama Barang tidak boleh kosong');
            window.location = 'in.php';
        </script>
        ";
    } else {
        $qty = $_POST['qty'];

        $checkStockNow = mysqli_query($link, "SELECT * FROM stocks WHERE itemId='$item'");
        $takingData = mysqli_fetch_array($checkStockNow);

        $stockNow = $takingData['stock'];
        $addStockNowAndQuantity = $stockNow + $qty;

        $addToInput = mysqli_query($link, "INSERT INTO incoming_goods (itemId, quantity) VALUES ('$item','$qty')");
        $updateStockIn = mysqli_query($link, "UPDATE stocks SET stock = '$addStockNowAndQuantity' WHERE itemId='$item'");
        if ($addToInput && $updateStockIn) {
            echo "
                <script>
                    window.location = 'in.php';
                </script>
                ";
        } else {
            echo 'gagal';
            echo "
            <script>
                window.location = 'in.php';
            </script>
            ";
        }
    }
}


//add outgoing goods
if (isset($_POST['outputItem'])) {
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $employee = $_POST['employee'];

    if ($item == '' || $employee == '') {
        echo "
        <script>
            alert('Inputan Nama Barang dan Nama Sales tidak boleh kosong');
            window.location = 'out.php';
        </script>
        ";
    } else {
        $checkStockNow = mysqli_query($link, "SELECT * FROM stocks WHERE itemId='$item'");
        $takingData = mysqli_fetch_array($checkStockNow);

        $stockNow = $takingData['stock'];


        if ($stockNow >= $qty) {
            $addStockNowAndQuantity = $stockNow - $qty;

            $addToOutput = mysqli_query($link, "INSERT INTO outgoing_goods (itemId, quantity, employeeId) VALUES ('$item','$qty','$employee')");
            $updateStockOut = mysqli_query($link, "UPDATE stocks SET stock = '$addStockNowAndQuantity' WHERE itemID='$item'");
            if ($addToOutput && $updateStockOut) {
                echo "
                    <script>
                        window.location = 'out.php';
                    </script>
                    ";
            } else {
                echo 'gagal';
                echo "
                <script>
                    window.location = 'out.php';
                </script>
                ";
            }
        } else {
            //jika barang tidak cukup
            echo '
            <script>
                alert("Stock saat ini tidak mencukupi");
                window.location.href="out.php";
            </script>
            ';
        }
    }
}

//Update info items
if (isset($_POST['updateItem'])) {
    $itemId = $_POST['itemId'];
    $namaBarang = $_POST['namaBarang'];
    $type = $_POST['type'];
    $deskripsi = $_POST['deskripsi'];
    $priceLitre = $_POST['priceLitre'];
    $priceDealer = $_POST['priceDealer'];

    $update = mysqli_query($link, "UPDATE stocks SET nameItem = '$namaBarang', type = '$type', description= '$deskripsi' , priceLitre = '$priceLitre', priceDealer = '$priceDealer' WHERE itemId = '$itemId'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

//delete items in stock
if (isset($_POST['deleteItem'])) {
    $itemId = $_POST['itemId'];
    $delete = mysqli_query($link, "DELETE FROM stocks WHERE itemId = '$itemId'");
    if ($delete) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

//Update Data incoming goods
if (isset($_POST['updateIncomingItem'])) {
    $itemId = $_POST['itemId'];
    $inItemId = $_POST['inItemId'];
    $qty = $_POST['qty'];

    $seeStock = mysqli_query($link, "SELECT * FROM stocks WHERE itemId = '$itemId' ");
    $theStocks = mysqli_fetch_array($seeStock);
    $stockNow = $theStocks['stock'];

    $qtyNow = mysqli_query($link, "SELECT * FROM incoming_goods WHERE inItemId = '$inItemId'");
    $theQty = mysqli_fetch_array($qtyNow);
    $qtyNow = $theQty['quantity'];

    if ($qty > $qtyNow) {
        $difference = $qty - $qtyNow;
        $reduce = $stockNow + $difference;
        $reducedOfStock = mysqli_query($link, "UPDATE stocks SET stock ='$reduce' WHERE itemId = '$itemId' ");
        $updated = mysqli_query($link, "UPDATE incoming_goods SET quantity='$qty' WHERE inItemId = '$inItemId' ");
        if ($reducedOfStock && $updated) {
            header('location:in.php');
        } else {
            echo 'gagal';
            header('location:in.php');
        }
    } else {
        $difference = $qtyNow - $qty;
        $reduce = $stockNow - $difference;
        $reducedOfStock = mysqli_query($link, "UPDATE stocks SET stock ='$reduce' WHERE itemId = '$itemId' ");
        $updated = mysqli_query($link, "UPDATE incoming_goods SET quantity='$qty' WHERE inItemId = '$inItemId' ");
        if ($reducedOfStock && $updated) {
            header('location:in.php');
        } else {
            echo 'gagal';
            header('location:in.php');
        }
    }
}

//Delete data incoming goods
if (isset($_POST['deleteIncomingItem'])) {
    $itemId = $_POST['itemId'];
    $qty = $_POST['quty'];
    $inItemId = $_POST['inItemId'];

    $getDataStock = mysqli_query($link, "SELECT * FROM stocks WHERE itemId = '$itemId' ");
    $data = mysqli_fetch_array($getDataStock);
    $stock = $data['stock'];
    $difference = $stock - $qty;

    $update = mysqli_query($link, "UPDATE stocks SET stock ='$difference' WHERE itemId = '$itemId' ");
    $deleteData = mysqli_query($link, "DELETE FROM incoming_goods WHERE inItemId = '$inItemId' ");

    if ($update && $deleteData) {
        header('location:in.php');
    } else {
        echo 'gagal';
        header('location:in.php');
    }
}

//Update Data Barang Keluar
if (isset($_POST['updateOutgoingItem'])) {
    $itemId = $_POST['itemId'];
    $outItemId = $_POST['outItemId'];
    $sales = $_POST['employeeId'];
    $qty = $_POST['qty']; //qty baru inputan user

    //mengambil stock barang saat ini
    $seeStock = mysqli_query($link, "SELECT * FROM stocks WHERE itemId = '$itemId' ");
    $theStocks = mysqli_fetch_array($seeStock);
    $stockNow = $theStocks['stock'];

    //qty barang keluar saat ini
    $qtyNow = mysqli_query($link, "SELECT * FROM outgoing_goods WHERE outItemId = '$outItemId'");
    $theQty = mysqli_fetch_array($qtyNow);
    $qtyNow = $theQty['quantity'];
    if ($qty > $qtyNow) {
        $difference = $qty - $qtyNow;
        $reduce = $stockNow - $difference;

        if ($difference <= $stockNow) {
            $reducedOfStock = mysqli_query($link, "UPDATE stocks SET stock ='$reduce' WHERE itemId = '$itemId' ");
            $updated = mysqli_query($link, "UPDATE outgoing_goods SET quantity='$qty', employeeId  = '$sales' WHERE outItemId = '$outItemId' ");
            if ($reducedOfStock && $updated) {
                header('location:out.php');
            } else {
                echo 'gagal';
                header('location:out.php');
            }
        } else {
            echo '
            <script>
                alert("Stock Tidak Mencukupi");
                window.location.href="out.php"; 
            </script>
            ';
        }
    } else {
        $difference = $qtyNow - $qty;
        $reduce = $stockNow + $difference;
        $reducedOfStock = mysqli_query($link, "UPDATE stocks SET stock ='$reduce' WHERE itemId = '$itemId' ");
        $updated = mysqli_query($link, "UPDATE outgoing_goods SET quantity='$qty', employeeId = '$sales' WHERE outItemId = '$outItemId' ");
        if ($reducedOfStock && $updated) {
            header('location:out.php');
        } else {
            echo 'gagal';
            header('location:out.php');
        }
    }
}

//Delete data outgoing items
if (isset($_POST['deleteOutgoingItem'])) {
    $itemId = $_POST['itemId'];
    $qty = $_POST['quty'];
    $outItemId = $_POST['outItemId'];

    $getDataStock = mysqli_query($link, "SELECT * FROM stocks WHERE itemId = '$itemId' ");
    $data = mysqli_fetch_array($getDataStock);
    $stock = $data['stock'];
    $difference = $stock + $qty;

    $update = mysqli_query($link, "UPDATE stocks SET stock ='$difference' WHERE itemId = '$itemId' ");
    $deleteData = mysqli_query($link, "DELETE FROM outgoing_goods WHERE outItemId = '$outItemId' ");

    if ($update && $deleteData) {
        header('location:out.php');
    } else {
        echo 'gagal';
        header('location:out.php');
    }
}
