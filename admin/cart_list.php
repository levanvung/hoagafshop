
<?php
	include '../lib/session.php';
	include '../class/category.php';
	include '../class/product.php';
	include '../class/cart.php';
	include_once '../helper/formats.php';
?>
<?php
	$cart = new cart();
    if(isset($_GET['cart_id'])){
        $id = $_GET['cart_id'];
        $deleteCart = $cart->delete_cart($id);
    }
?>
<?php include 'inc/header.php'; ?>

<?php include 'inc/aside.php'; ?>
<section id="main-content">
	<section class="wrapper">
  <div class="w3layouts-glyphicon">		
            <div class="panel panel-default">
                <div class="panel-heading">
                Danh sách đặt hàng
                </div>
                <div class="table-responsive">
                <?php
                    if(isset($deleteCart)){
                        echo $deleteCart;
                    }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cart = new cart();
                        $fm = new Format();
                        $show_cart = $cart->show_cart();
                        if($show_cart){
                            $i=0;
                            while($result = $show_cart->fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['product_name']; ?></td>
                        <td><?php echo number_format($result['price']); ?></td>
                        <td><?php echo $result['quantity']; ?></td>
                        <td><?php echo $result['day_order']; ?></td>
                        <td>
                        <?php 
						switch($result['status_order']) {
							case '0':
								echo 'Đơn hàng chờ xác nhận';
								break;
							case '1':
								echo 'Người bán đang chuẩn bị hàng';
								break;
							case '2':
								echo 'Đơn vị vận chuyển đã lấy hàng';
								break;
							case '3':
						    	echo 'Đang giao hàng';
								break;
							case '4':
								echo 'Đã nhận được hàng';
								$deletecart = $cart->delete_data();
								break;
						}
						?>
                        </td>
                        <td>
                        <a href="cart_edit.php?order_id=<?php echo $result['order_id']; ?>" class="active edit_style" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a onclick="return confirm('Are you want to delete?')" href="?order_id=<?php echo $result['order_id']?>" class="active edit_style" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
		</div>
</section>
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
