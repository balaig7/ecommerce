<?php
include __DIR__."/loader.php";
// echo "<pre>";
// print_r($_SESSION);
$orderDetails=explode('-',$_GET['order_id']);
$invoiceId=base64_decode($orderDetails['0']);
$orderedProducts=dbQuery("select `orders`.total,`order_details`.product_name,`order_details`.product_price,`order_details`.quantity,`order_details`.sub_total from `orders` inner join `order_details` on  `orders`.id=`order_details`.order_id where `orders`.order_id='".$invoiceId."'");
?>
<style>
    .invoice-heading{
        background: #D10024;
        color:#fff;
        text-align:center;
        padding:10px;
        margin-bottom:0px;
    }
    .invoice-box {
        max-width: 100%;
        margin: auto;
        padding: 30px;
        /* border: 1px solid #eee; */
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #D10024;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        color:#fff;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .invoice-box.rtl table {
        text-align: right;
    }

    .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>
        <div class="section">
        <div class="container">
        <p>Hi <b><?=$_SESSION['current_user']['display_name']?></b>,</p>
        <p>Thank You. Your order has been received. Your order no is #<?=$invoiceId?></p>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="heading">
					<td>Items</td>
					<td>Quantity</td>
					<td>Price</td>
					<td>Subtotal</td>
				</tr>
                <?php foreach ($orderedProducts as $key => $value) { ?>
                    <tr class="item">
                        <td><?=$value->product_name?></td>
                        <td><?=$value->quantity?></td>
                        <td>$<?=$value->product_price?></td>
                        <td>$<?=$value->sub_total?></td>
                    </tr>
                <?php } ?>
				
				<tr class="total">
					<td></td>
					<td></td>
					<td>Total</td>
					<td>$<?=$orderedProducts['0']->total?></td>
				</tr>
			</table>
		</div>
		</div>
		</div>

<?php
   include __DIR__."/layouts/footer.php";
?>
