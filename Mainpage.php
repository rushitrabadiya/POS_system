<?php require_once "controllerUserData.php";

// session_start();
if (!isset($_SESSION['email'])) {
    header('Location: Loginpage_login.php');
}

// include "db.php";
$sql = "SELECT * FROM `cart`";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainPage</title>
    <link rel="stylesheet" href="Mainpage.css">
    <link rel="stylesheet" href="CardExample.css">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <script src="http://js.stripe.com/v3/"></script>
    <script src="https://kit.fontawesome.com/2e520399f1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            height: 10px;
            width: 5px;
            border-radius: 10px;
            background: #6f4436;

        }

        ::-webkit-scrollbar-track {
            background: burlywood;
            border-radius: 10px;
        }
    </style>
    <script src="store.js" async></script>
</head>

<body>
    <div class="ver-navbar">
        <img class="logo-bar" src="Images/logo_2.jpg">
        <a href="#">
            <button class="btn-bar">
                <i class="fas fa-duotone fa-house" style="font-size: 23px; color: brown;">
                    <br>
                    <div class="f-s" style="margin-top: 5px; margin-bottom: 0px;">
                        Home
                    </div>
                </i>
            </button>
        </a>
        <a href="logout.php">
            <button class="btn-bar" onclick="clearCart()">
                <i class="fas fa-solid fa-right-from-bracket" style="font-size: 23px; color: brown;">
                    <br>
                    <div class="f-s" style="margin-top: 5px; margin-bottom: 0px;">
                        Logout
                    </div>
                </i>
            </button>
        </a>
    </div>

    <div class="item-col">
        <div class="item-box">
            <p class="d-flex justify-content-between algin-items-center">
                <span><img src="Images/logo_2.jpg" class="logo-img1">
                    <span>MR. and MRS.
                        <span class="f-s">Let what we can do together</span>
                    </span>
                </span>
                <small class="text-muted" style="" text-align: right;><?php echo "Date - " . date("d/m/y"); ?>
                    <br><?php echo "Day - " . date("l"); ?><br>
                    <?php date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                    echo "Time - " . date('H:i a'); ?>

                    <!-- // echo "Customer Id - ". $_SESSION['id']; -->

                    <h4 style="font-size:large;">Welcome <b style="font-size: larger; color:black "><?php echo $_SESSION['name']; ?></b>..</h4>
                </small>

            </p>

            <div class="card rounded-3 mb-3">
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item" role="presentation">
                                <input type="submit" class="Option-item" value="All" name="all">
                            </li>
                            <li class="nav-item" role="presentation">
                                <input type="submit" class="Option-item" value="Coffee" name="Coffee">
                            </li>
                            <li class="nav-item" role="presentation">
                                <input type="submit" class="Option-item" value="Drink" name="Drink">
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

            <div class="tab-content item-set" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0" style="display: flex; overflow:visible">
                    <?php

                    if (isset($_POST['Coffee'])) {

                        $item_search_c = "select * from cart where item = 'c'";

                        $query = mysqli_query($con, $item_search_c);
                        $row = mysqli_fetch_assoc($query);
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                            <div class="container1">
                                <div class="card1">
                                    <div class="imgBx">
                                        <img class="shop-item-image" src="<?php echo "img/" . $row['image']; ?>">
                                    </div>
                                    <div class="contentBx">
                                        <h2 class="shop-item-title">
                                            <?php echo $row['name']; ?>-M
                                        </h2>
                                        <div class="f-s">
                                            <?php echo $row['description']; ?>
                                        </div>
                                        <div class="size">
                                            <h3>Size :</h3>
                                            <button class="size-select-s">S</button>
                                            <button class="size-select-m">M</button>
                                            <button class="size-select-l">L</button>
                                        </div>
                                        <div class="size">
                                            <h3 class="price">Price:- Rs.</h3>
                                            <h3 class="hide-price"><?php echo $row['price']; ?></h3>
                                            <h3 class="shop-item-price">
                                                <?php
                                                echo $row['price']; ?>
                                            </h3>
                                        </div>
                                        <button class="btn-cart shop-item-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else if (isset($_POST['Drink'])) {

                        $item_search_c = "select * from cart where item = 'd'";

                        $query = mysqli_query($conn1, $item_search_c);
                        $row = mysqli_fetch_assoc($query);
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="container1">
                                <div class="card1">
                                    <div class="imgBx">
                                        <img class="shop-item-image" src="<?php echo "img/" . $row['image']; ?>">
                                    </div>
                                    <div class="contentBx">
                                        <h2 class="shop-item-title">
                                            <?php echo $row['name']; ?>-M
                                        </h2>
                                        <div class="f-s">
                                            <?php echo $row['description']; ?>
                                        </div>
                                        <div class="size">
                                            <h3>Size :</h3>
                                            <button class="size-select-s">S</button>
                                            <button class="size-select-m">M</button>
                                            <button class="size-select-l">L</button>
                                        </div>
                                        <div class="size">
                                            <h3 class="price">Price:- Rs.</h3>
                                            <h3 class="hide-price"><?php echo $row['price']; ?></h3>
                                            <h3 class="shop-item-price">
                                                <?php
                                                echo $row['price']; ?>
                                            </h3>
                                        </div>
                                        </form>
                                        <button class="btn-cart1 shop-item-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="container1">
                                <div class="card1">
                                    <div class="imgBx">
                                        <img class="shop-item-image" src="<?php echo "img/" . $row['image']; ?>">
                                    </div>
                                    <div class="contentBx">
                                        <h2 class="shop-item-title">
                                            <?php echo $row['name']; ?>-M
                                        </h2>
                                        <div class="f-s">
                                            <?php echo $row['description']; ?>
                                        </div>
                                        <div class="size">
                                            <h3>Size :</h3>
                                            <button class="size-select-s">S</button>
                                            <button class="size-select-m">M</button>
                                            <button class="size-select-l">L</button>
                                        </div>
                                        <div class="size">
                                            <h3 class="price">Price:- Rs.</h3>
                                            <h3 class="hide-price"><?php echo $row['price']; ?></h3>
                                            <h3 class="shop-item-price">
                                                <?php
                                                echo $row['price']; ?>
                                            </h3>
                                        </div>
                                        </form>
                                        <button class="btn-cart1 shop-item-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <div class="container1">
                            <div class="card1">
                                <div class="imgBx">
                                    <img class="shop-item-image" src="<?php echo "img/" . $row['image']; ?>">
                                </div>
                                <div class="contentBx">
                                    <h2 class="shop-item-title">
                                        <?php echo $row['name']; ?>-M
                                    </h2>
                                    <div class="f-s">
                                        <?php echo $row['description']; ?>
                                    </div>
                                    <div class="size">
                                        <h3>Size :</h3>
                                        <button class="size-select-s">S</button>
                                        <button class="size-select-m">M</button>
                                        <button class="size-select-l">L</button>
                                    </div>
                                    <div class="size">
                                        <h3 class="price">Price:- Rs.</h3>
                                        <h3 class="hide-price"><?php echo $row['price']; ?></h3>
                                        <h3 class="shop-item-price">
                                            <?php
                                            echo $row['price']; ?>
                                        </h3>
                                    </div>
                                    </form>
                                    <button class="btn-cart1 shop-item-button">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="cart-box">
            <h5 class="d-flex justify-content-between algin-items-center font-size">
                <span class="section-header">Cart</span>
                <button class="btn1 btn-sm1 btn-clear1">Clear</button>
            </h5>
            <hr>
            <div class="manage">
                <div class="cart-row">
                    <span class="cart-item cart-header cart-column">ITEM</span>
                    <span class="cart-price cart-header cart-column">PRICE</span>
                    <span class="cart-quantity cart-header cart-column">QUANTITY</span>
                </div>
                <div class="cart-items">
                </div>
            </div>
            <hr>
            <div class="cart-total">
                <big class="total-items">Total Items</big>
                <span class="total-items-value">0</span><br>
                <big class="cart-total-title">Total</big>
                <span class="cart-total-price">Rs. 0</span>
            </div>
            <hr>
            <button class="btn1 btn-cart1 btn-lg1 w-100 btn-purchase1" id="btn" type="button">PURCHASE</button>
        </div>
    </div>
</body>

</html>