<?php
require_once "config/connection.php";
require_once "functions/func-db.php";
$productData['products'] = $productData['sub_categories'] = $productData['total_page'] = array();
$parentCategoryid = $_POST['parent_cat'];
$subCategoryid = $_POST['sub_cat'];
$pageLimit = 6; // Number of entries to show in a page.
if ($subCategoryid > 0)
{
    $where = "child_category_id=" . $subCategoryid . "";
}
else
{
    $where = "parent_category_id=" . $parentCategoryid . "";
}
//check parent categories have childerens
$isChildrens = find($parentCategoryid, 'category');
if ($isChildrens->is_childrens == '1')
{
    //get sub categories
    $productData['sub_categories'] = dbQuery("SELECT sub_category.id,count(products.child_category_id) as total,sub_category.name from sub_category LEFT JOIN products on products.child_category_id=sub_category.id where sub_category.parent_id=" . $parentCategoryid . " group by sub_category.id, sub_category.name ");
}
$getProductcount = dbQuery("SELECT count('id') as total_records from `products` where " . $where . " and status='1' ");

$totalRecord = $getProductcount[0]->total_records; //get total count
$totalPages = ceil($totalRecord / $pageLimit);
$previousPage = $nextPage = '';
if (!empty($_POST["page"]))
{
    $page = $_POST["page"];
}
else
{
    $page = 1;
}
$startFrom = ($page - 1) * $pageLimit;
$productData['products'] = dbQuery("SELECT id,name,thumnail_image_path,thumnail_image,original_price,discounted_price from `products` where " . $where . " and status='1' LIMIT " . $startFrom . "," . $pageLimit . " ");
// $productData['showing_limits']="SHOWING ". $startFrom."-".$pageLimit. " PRODUCTS";
foreach ($productData['products'] as $key => $value)
{
    $value->thumnail_image_path = str_replace("../", "", $value->thumnail_image_path);
}
$start_loop = $page;
$difference = $totalPages - $page;

if ($difference <= 5)
{
    $start_loop = $totalPages - 5;
}
$end_loop = $start_loop + 4;
if ($page > 1)
{
    $productData['total_page'][1] = "FIRST_";
    $productData['total_page'][$page - 1] = "<i class='fa fa-angle-left'></i>_";
    //  echo "<a href='cricketers_list.php?page=1'>First</a>";
    //  echo "<a href='cricketers_list.php?page=".($page - 1)."'><<</a>";
    
}
for ($i = $start_loop;$i <= $end_loop;$i++)
{
    //  echo "<a href='cricketers_list.php?page=".$i."'>".$i."</a>";
    if ($page == $i)
    {
        $activePage = 'active';
    }
    else
    {
        $activePage = '';
    }
    $productData['total_page'][$i] = $i . "_" . $activePage;

}
if ($page <= $end_loop)
{
    $productData['total_page'][] = "<i class='fa fa-angle-right'></i>_";
    $productData['total_page'][$totalPages] = "LAST_";
    //  echo "<a href='cricketers_list.php?page=".($page + 1)."'>>></a>";
    //  echo "<a href='cricketers_list.php?page=".$totalPages."'>Last</a>";
    
}
echo json_encode($productData);

?>
