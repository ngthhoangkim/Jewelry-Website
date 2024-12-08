<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
        }

        .left-side {
            background-color: #4CAF50;
            color: #fff;
            padding: 30px;
            width: 50%;
        }

        .right-side {
            padding: 30px;
            width: 50%;
        }

        h2 {
            margin-top: 0;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3e8e41;
        }

        .file-input {
            position: relative;
            display: inline-block;
        }

        .file-input input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input span {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-box">
            <div class="left-side">
                <h2>Sản phẩm cần thanh toán</h2>
                <?php
                if (!empty($cart)) {
                    echo '<table>';
                    echo '<tr><th>Ảnh sản phẩm</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr>';
                    $total = 0;
                    foreach ($cart as $product) {
                        $subtotal = $product['price'] * $product['quantity'];
                        $total += $subtotal;
                        echo '<tr>';
                        echo '<td><img src="' . $product['image'] . '" alt="' . $product['name'] . '"></td>';
                        echo '<td>' . $product['name'] . '</td>';
                        echo '<td>' . $product['quantity'] . '</td>';
                        echo '<td>' . number_format($product['price'], 0, ',', '.') . ' đ</td>';
                        echo '<td>' . number_format($subtotal, 0, ',', '.') . ' đ</td>';
                        echo '</tr>';
                    }
                    echo '<tr><td colspan="4" style="text-align:right;"><strong>Tổng cộng:</strong></td><td><strong>' . number_format($total, 0, ',', '.') . ' đ</strong></td></tr>';
                    echo '</table>';
                } else {
                    echo '<p>Giỏ hàng trống.</p>';
                }
                ?>
            </div>
            <div class="right-side">
                <h2>Thông tin thanh toán</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Lời nhắn:</label>
                        <textarea id="message" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Hình thức thanh toán:</label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="">Chọn hình thức thanh toán</option>
                            <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                            <option value="online">Thanh toán online</option>
                        </select>
                    </div>
                    <button type="submit">Thanh toán</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>