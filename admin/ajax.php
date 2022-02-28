<?php
require_once ('functions/func-db.php');
// error_reporting(0);
// ini_set('display_errors', 0);
$action = $_POST['action'];
switch ($action)
{
    case 'create-category':
        $status = '0';
        if (!empty($_POST['status']))
        {
            $status = '1';
        }
        //check if this category has childrens are not
        if (!empty($_POST['is_childrens']))
        {
            $isChildrens = '1';
        }
        else
        {
            $isChildrens = '0';
        }
              
        //keys must be db table fields
        $insertParentCategory = array(
            'name' => mysqli_real_escape_string($conn, $_POST['name']) ,
            'status' => mysqli_real_escape_string($conn, $status) ,
            'is_childrens' => mysqli_real_escape_string($conn, $isChildrens) ,
            'success_message' => $_POST['success_message'],
            'redirect_url' => $_POST['redirect_url']
        );
        
        if ($isChildrens == '0')
        {
            create('category', $insertParentCategory);
        }
        else
        {
            unset($insertParentCategory['success_message'], $insertParentCategory['redirect_url']);
            $insertParentCategory['created_at'] = date("Y-m-d H:i:s");
            $insertCategory = "INSERT into `category`(" . implode(",", array_keys($insertParentCategory)) . ") values ('" . implode("','", $insertParentCategory) . "')";
            if (mysqli_query($conn, $insertCategory))
            {
                $subCategoriesData = array_filter($_POST['sub_category']);
                $parentCategoryId = mysqli_insert_id($conn); //get last inserted category id
                if (empty($subCategoriesData))
                {
                    $isChildrenUpdated = mysqli_query($conn, "UPDATE `category` set is_childrens='0' where id='" . $parentCategoryId . "'");
                    if ($isChildrenUpdated)
                    {
                        sendResponse('success', $_POST['success_message'], $_POST['redirect_url']);
                    }
                }
                foreach ($subCategoriesData as $key => $value)
                {
                    $insertSubCategory = "INSERT into `sub_category`(parent_id,name,created_at) values ('" . $parentCategoryId . "','" . $value . "','" . date("Y-m-d H:i:s") . "')";
                    if (mysqli_query($conn, $insertSubCategory))
                    {
                        $isSubCategoryCreated = 1;
                    }
                }
                if ($isSubCategoryCreated)
                {
                    sendResponse('success', $_POST['success_message'], $_POST['redirect_url']);
                }
            }

        }
    break;

    case 'update-category':
        // update($_POST['id'], 'category', $_POST, '');
        $id = $_POST['id'];
        $status = '0';
        if ($_POST['status'] == 'on')
        {
            $status = '1';
        }
        //check if this category has childrens are not
        if (!empty($_POST['is_childrens']))
        {
            $isChildrens = '1';
        }
        else
        {
            $isChildrens = '0';
        }
        //keys must be db table fields
        $updateCategory = array(
            'name' => $_POST['name'],
            'status' => $status,
            'is_childrens' => $isChildrens,
            'success_message' => $_POST['success_message'],
            'redirect_url' => $_POST['redirect_url']
        );
        
        $getSubCategories = dbQuery("SELECT id from `sub_category` where parent_id='" . $id . "'");
        if ($isChildrens == '0')
        {
            if (!empty($getSubCategories))
            {
                foreach ($getSubCategories as $key => $value)
                {
                    $deleteSubCategories = "DELETE from `sub_category` where id=" . $value->id . "";
                    if (mysqli_query($conn, $deleteSubCategories))
                    {
                        $isSubCategoryDeleted = 1;
                    }
                }
            }
            update($id, 'category', $updateCategory);
        }
        else
        {
            $updateCategory = "UPDATE `category` set name='" . mysqli_real_escape_string($conn, $_POST['name']) . "',status='" . mysqli_real_escape_string($conn, $status) . "',is_childrens='" . mysqli_real_escape_string($conn, $isChildrens) . "' where id='" . $id . "'";
            if (mysqli_query($conn, $updateCategory))
            {
                $subCategoriesData = array_filter($_POST['sub_category']);
                //      echo "<pre>";
                // print_r($getSubCategories);
                // exit;
                $parentCategoryId = $id; //get last inserted category id
                if (empty($subCategoriesData))
                {
                    if (!empty($getSubCategories))
                    {
                        foreach ($getSubCategories as $key => $value)
                        {
                            $deleteSubCategories = "DELETE from `sub_category` where id=" . $value->id . "";
                            if (mysqli_query($conn, $deleteSubCategories))
                            {
                                $isSubCategoryDeleted = 1;
                            }
                        }
                        if ($isSubCategoryDeleted)
                        {
                            update($id, 'category', $updateCategory);
                        }
                    }
                    $isChildrenUpdated = mysqli_query($conn, "UPDATE `category` set is_childrens='0' where id='" . $parentCategoryId . "'");
                    if ($isChildrenUpdated)
                    {
                        sendResponse('success', $_POST['success_message'], $_POST['redirect_url']);
                    }
                }
                if (!empty($getSubCategories))
                {
                    foreach ($getSubCategories as $key => $value)
                    {
                        $deleteSubCategories = "DELETE from `sub_category` where id=" . $value->id . "";
                        if (mysqli_query($conn, $deleteSubCategories))
                        {
                            $isSubCategoryDeleted = 1;
                        }
                    }
                }
                // if ($isSubCategoryDeleted)
                // {
                foreach ($subCategoriesData as $key => $value)
                {
                    $insertSubCategory = "INSERT into `sub_category`(parent_id,name,created_at) values ('" . $parentCategoryId . "','" . $value . "','" . date("Y-m-d H:i:s") . "')";
                    if (mysqli_query($conn, $insertSubCategory))
                    {
                        $isSubCategoryCreated = 1;
                    }
                }
                // }
                if ($isSubCategoryCreated)
                {
                    sendResponse('success', $_POST['success_message'], $_POST['redirect_url']);
                }
            }
        }

    break;
    case 'delete-category':
        delete($_POST['id'], 'category');
    break;
    case 'create-product':
        $isproductImageUploaded = $isthumnailImageUploaded = 0;
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        foreach ($_FILES['product_images']['name'] as $key => $value)
        {
            $imageName = $value;
            $parentCategory=explode("-",$_POST['parent_category_id']);
           
            $temp_name = $_FILES['product_images']['tmp_name'][$key];
            if (!file_exists('../assets/uploads/'))
            {
                mkdir('../assets/uploads/', 0777, true); //create new folder inside assets
                
            }
            if (!file_exists('../assets/uploads/'. $parentCategory['1']))
            {
                mkdir('../assets/uploads/'. $parentCategory['1'], 0777, true); //create new folder inside assets
                
            }
            if(!empty($_POST['child_category_id'])){
                $childCategory=explode("-",$_POST['child_category_id']);
                if (!file_exists('../assets/uploads/'. $parentCategory['1'].'/'.$childCategory['1'].''))
            {
                mkdir('../assets/uploads/'. $parentCategory['1'].'/'.$childCategory['1'].'', 0777, true); //create new folder inside assets
                $productImagesPath='../assets/uploads/'. $parentCategory['1'].'/'.$childCategory['1'].'/';
                
            }
            $subCategoryId=$childCategory['0'];
            }else{
                $productImagesPath='../assets/uploads/'. $parentCategory['1'].'/';
                $subCategoryId=$_POST['child_category_id'];

            }

            $target_file = $productImagesPath . basename($imageName);
            if (move_uploaded_file($temp_name, $target_file))
            {
                $isproductImageUploaded .= 1;
            }
        }
        $thumnailImage = $_FILES['thumnail_image']['name'];
        if (!file_exists('../assets/uploads/'. $parentCategory['1'].'/thumnails'))
        {
            mkdir('../assets/uploads/'. $parentCategory['1'].'/thumnails', 0777, true); //create new folder inside assets
            
        }
        $thumnailImagePath='../assets/uploads/'. $parentCategory['1'].'/thumnails/';
        $thumb_temp_name = $_FILES['thumnail_image']['tmp_name'];
        $thumb_target_file = $thumnailImagePath . basename($thumnailImage);
        if (move_uploaded_file($thumb_temp_name, $thumb_target_file))
        {
            $isthumnailImageUploaded .= 1;
        }

        if ($isproductImageUploaded && $isthumnailImageUploaded)
        {
            $_POST['product_images_path']=$productImagesPath;
            $_POST['thumnail_image_path']=$thumnailImagePath;
            $_POST['product_images'] = implode(',', $_FILES['product_images']['name']);
            $_POST['thumnail_image'] = $thumnailImage;
            $_POST['parent_category_id']=$parentCategory['0'];
            $_POST['child_category_id']=$subCategoryId;
            create('products', $_POST);
        }
    break;
    case "get-sub-category":
        $subcategory=dbQuery("SELECT id,name from `sub_category` where parent_id='" . $_POST['parent_id'] . "'");
        echo json_encode($subcategory);
        exit;
    break;
    default:
        # code...
        
    break;
}
?>
