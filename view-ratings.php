<?php
require_once "config/connection.php";
require_once "functions/func-db.php";
$productId=$_POST['product_id'];
$ratings  = array();
$pageLimit = 3; // Number of products to show in a page.
$allReviews=dbQuery("SELECT * FROM `ratings` where product_id='".$productId."'");
$ratings['total_count']=count($allReviews);
$ratings['all_reviews'] = $allReviews;
$getProductcount = dbQuery("SELECT count('id') as total_records from `ratings` where product_id='".$productId."'");
$totalRecord = $getProductcount[0]->total_records; //get total count
$totalPages = ceil($totalRecord / $pageLimit);//get total pages
if (!empty($_POST["page"]))
{
    $page = $_POST["page"];//get current page no
}
else
{
    $page = 1; //default 1
}
$startFrom = ($page - 1) * $pageLimit;
$ratings['review_by_page'] = dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,DATE_FORMAT(`ratings`.created_at, '%d-%m-%Y') as created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' LIMIT " . $startFrom . "," . $pageLimit . " ");
$ratings['rating_by_value'][5] = count(dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,`ratings`.created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' and `ratings`.star_rating='5'"));
$ratings['rating_by_value'][4] = count(dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,`ratings`.created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' and `ratings`.star_rating='4'"));
$ratings['rating_by_value'][3] = count(dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,`ratings`.created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' and `ratings`.star_rating='3'"));
$ratings['rating_by_value'][2] = count(dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,`ratings`.created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' and `ratings`.star_rating='2'"));
$ratings['rating_by_value'][1] = count(dbQuery("SELECT `login`.display_name,`ratings`.review,`ratings`.star_rating,`ratings`.created_at from `ratings` inner join `login` on `login`.id=`ratings`.user_id where `ratings`.product_id='".$productId."' and `ratings`.star_rating='1'"));

$start_loop = $page;
$difference = $totalPages - $page;
if($totalPages>1){
    if ($difference <= 5)
    {
        $start_loop = $totalPages - 5;
    }
    $end_loop = $start_loop + 4;
    if ($page > 1)
    {
        // $productData['total_page'][1] = "FIRST_";//first page
        
        $ratings['total_page'][1] = "<i class='fa fa-angle-left'></i>__".($page-1);//previous page
    }
for ($i = $start_loop;$i <= $end_loop;$i++)
{
    if ($page == $i)
    {
        $activePage = 'active';//current active page
    }
    else
    {
        $activePage = '';
    }
    
    $ratings['total_page'][$i] = $i . "_" . $activePage."_".$i;//show 5 page range per pages 

}
if ($page <= $end_loop)
{
    
    $ratings['total_page'][] = "<i class='fa fa-angle-right'></i>__".($page+1);//next page
    // $productData['total_page'][$totalPages] = "LAST__".$totalPages;//last page
}
if($page==$totalPages){

        $ratings['total_page'][$totalPages]=$totalPages."_active_".$totalPages;//final page
}
foreach ($ratings['total_page'] as $key => $value) {
    if($key<=0){
        unset($ratings['total_page'][$key]);
    }
}
}
echo json_encode($ratings);
exit;

?>
