<?php include_once "./header2.php" ?>
<?php

if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location:" . SITE_URL . "login.php");
} else {
    if (isset($_SESSION['user'])) {
        $sql = "SELECT * FROM user where username = '{$_SESSION['user']}'";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();
    } elseif (isset($_SESSION['admin'])) {
        $sql = "SELECT * FROM user where username = '{$_SESSION['admin']}'";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();
    }
    // echo "<pre>" ; 
    // print_r($user) ; 
    // echo "</pre>" ;   
    $errors = [];
    if (isset($_POST['go'])) {

        $id = $user['id'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $day = date("Y/m/d");
        if ($fullname == "") {
            $errors['fullname'] = "Yêu cầu nhập họ tên";
        }
        if ($address == "") {
            $errors['address'] = "Chưa có địa chỉ nhận hàng";
        }
        if ($phone == "") {
            $errors['phone'] = "Chưa có số điện thoại liên lạc";
        }
        if ($email == "") {
            $errors['email'] = "Chưa điền email ";
        }
        // echo 'okw';
        // if (empty($errors)) {
        // $select = "SELECT id FROM  orders ORDER BY id desc limit 1";
        // $stmt = $connect->prepare($select);
        // $stmt->execute();
        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // $id_orders = $stmt->fetch();
        // $id_orders['id']++;

        try {
            $insert1 = "INSERT INTO orders(id_user ,customer_name , customer_email , customer_phone , customer_address , order_note ,create_at) 
                VALUES (:id_user ,:customer_name , :customer_email, :customer_phone , :customer_address , :order_note , :create_at)";
            $stm = $connect->prepare($insert1);
            $stm->bindParam(":id_user", $id);
            $stm->bindParam(":customer_name", $fullname);
            $stm->bindParam(":customer_email", $email);
            $stm->bindParam(":customer_phone", $phone);
            $stm->bindParam(":customer_address", $address);
            $stm->bindParam(":order_note", $note);
            $stm->bindParam(":create_at", $day);
            $stm->execute();
            if (strpos(strtoupper($insert1), 'INSERT ') !== false) {
                $last_id = $connect->lastInsertId();
            }
        } catch (PDOException $e) {

            echo ("Lỗi" . $e->getMessage());
        } finally {
            echo '<pre>';
            $stmt->debugDumpParams();
            echo '</pre>';
        }

        echo "Last id: $last_id  ";

        $list_id_pro  = [];
        $list_sl_pro = [];
        foreach ($_SESSION['cart'] as $key => $values) {
            $list_id_pro[] = $key;
            $list_sl_pro[] = $values['quantity'];
        }
        for ($i = 0; $i < count($list_id_pro); $i++) {
            $insert = "INSERT INTO  orderdetail (id_product , order_id , quantity_product)
                 VALUES (:id_product , :order_id , :quantity_product)";
            $stmt = $connect->prepare($insert);
            $stmt->bindParam(":id_product", $list_id_pro[$i]);
            $stmt->bindParam(":order_id", $last_id);
            $stmt->bindParam(":quantity_product", $list_sl_pro[$i]);
            $stmt->execute();
        }
        unset($_SESSION['cart']);
        header("Location:" . SITE_URL . "bill.php?id=" . $last_id);
    }
}


// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";
// exit;

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";


?>
<div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-8">
        <h4>Thông tin đơn hàng</h4>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Họ và tên :</label>
                <input value="<?= $user['fullname'] ?>" name="fullname" type="text" class="form-control" placeholder="Họ và tên" disabled>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ:</label>
                <input name="address" type="text" class="form-control" placeholder="Địa chỉ">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input name="phone" type="number" class="form-control" placeholder="Số điện thoại">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ghi chú:</label>
                <input name="note" type="text" class="form-control" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <button class="btn btn-warning" type="submit" name="go">
                Gủi đi
            </button>



        </form>
    </div>
    <div class="col-sm-2">

    </div>

</div>
<?php include_once "./footer.php" ?>