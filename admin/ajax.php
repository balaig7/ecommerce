<?php
require_once ('functions/func-db.php');
require_once ('functions/func-core.php');
error_reporting(0);
ini_set('display_errors', 0);
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
    case 'delete-category':
        delete($_POST['id'], 'category');
    break;
    case 'create-product':
        $isproductImageUploaded = $isthumnailImageUploaded = 0;
        $getUid = dbquery('select MAX(id) as uid from `products`');
        foreach ($_FILES['product_images']['name'] as $key => $value)
        {
            $imageName = $value;
            $parentCategory = explode("-", $_POST['parent_category_id']);

            $temp_name = $_FILES['product_images']['tmp_name'][$key];

            createFolder('../assets/uploads/', 0777, true); //create new folder inside assets
            createFolder('../assets/uploads/' . $parentCategory['1']);
            if (!empty($_POST['child_category_id']))
            {
                $childCategory = explode("-", $_POST['child_category_id']);
                // if (!file_exists('../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . ''))
                // {
                createFolder('../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . ''); //create new folder inside assets
                $productImagesPath = '../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . '/';

                // }
                $subCategoryId = $childCategory['0'];
            }
            else
            {
                $productImagesPath = '../assets/uploads/' . $parentCategory['1'] . '/';
                $subCategoryId = $_POST['child_category_id'];

            }

            $target_file = $productImagesPath . basename($imageName);
            if (move_uploaded_file($temp_name, $target_file))
            {
                $isproductImageUploaded .= 1;
            }
        }
        $thumnailImage = $_FILES['thumnail_image']['name'];
        createFolder('../assets/uploads/' . $parentCategory['1'] . '/thumnails'); //create new folder inside assets
        $thumnailImagePath = '../assets/uploads/' . $parentCategory['1'] . '/thumnails/';
        $thumb_temp_name = $_FILES['thumnail_image']['tmp_name'];
        $thumb_target_file = $thumnailImagePath . basename($thumnailImage);
        if (move_uploaded_file($thumb_temp_name, $thumb_target_file))
        {
            $isthumnailImageUploaded .= 1;
        }

        if ($isproductImageUploaded && $isthumnailImageUploaded)
        {
            $statusOfStocks = 'out of stock';
            if ($_POST['status'] == '1')
            {
                $statusOfStocks = 'in stock';
            }

            $_POST['product_images_path'] = $productImagesPath;
            $_POST['thumnail_image_path'] = $thumnailImagePath;
            $_POST['product_images'] = implode(',', $_FILES['product_images']['name']);
            $_POST['thumnail_image'] = $thumnailImage;
            $_POST['parent_category_id'] = $parentCategory['0'];
            $_POST['child_category_id'] = $subCategoryId;
            $_POST['status'] = $statusOfStocks;
            $_POST['sku'] = generateSku(10, $getUid['0']->uid + 1);

            create('products', $_POST);

        }
    break;
    case 'update-product':
        // printArray($_POST);
        $isproductImageUploaded = $isthumnailImageUploaded = 0;
        foreach ($_FILES['product_images']['name'] as $key => $value)
        {
            $imageName = $value;
            $parentCategory = explode("-", $_POST['parent_category_id']);

            $temp_name = $_FILES['product_images']['tmp_name'][$key];

            createFolder('../assets/uploads/', 0777, true); //create new folder inside assets
            createFolder('../assets/uploads/' . $parentCategory['1']);
            if (!empty($_POST['child_category_id']))
            {
                $childCategory = explode("-", $_POST['child_category_id']);
                // if (!file_exists('../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . ''))
                // {
                createFolder('../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . ''); //create new folder inside assets
                $productImagesPath = '../assets/uploads/' . $parentCategory['1'] . '/' . $childCategory['1'] . '/';

                // }
                $subCategoryId = $childCategory['0'];
            }
            else
            {
                $productImagesPath = '../assets/uploads/' . $parentCategory['1'] . '/';
                $subCategoryId = $_POST['child_category_id'];

            }

            $target_file = $productImagesPath . basename($imageName);
            if (move_uploaded_file($temp_name, $target_file))
            {
                $isproductImageUploaded .= 1;
            }
        }
        $thumnailImage = $_FILES['thumnail_image']['name'];
        createFolder('../assets/uploads/' . $parentCategory['1'] . '/thumnails'); //create new folder inside assets
        $thumnailImagePath = '../assets/uploads/' . $parentCategory['1'] . '/thumnails/';
        $thumb_temp_name = $_FILES['thumnail_image']['tmp_name'];
        $thumb_target_file = $thumnailImagePath . basename($thumnailImage);
        if (move_uploaded_file($thumb_temp_name, $thumb_target_file))
        {
            $isthumnailImageUploaded .= 1;
        }

        if ($isproductImageUploaded && $isthumnailImageUploaded)
        {
            $_POST['product_images_path'] = $productImagesPath;
            $_POST['thumnail_image_path'] = $thumnailImagePath;
            $_POST['product_images'] = implode(',', $_FILES['product_images']['name']);
            $_POST['thumnail_image'] = $thumnailImage;
            $_POST['parent_category_id'] = $parentCategory['0'];
            $_POST['child_category_id'] = $subCategoryId;
            update($_POST['id'], 'products', $data);

        }
    break;
    case 'delete-image':
        $id = $_POST['id'];
        $getProductdatas = find($id, 'products');
        $productImages = $getProductdatas->product_images;
        $deleteImage = str_replace($_POST['image'], "", $productImages); //remove image
        @unlink($getProductdatas->product_images_path . $_POST['image']); //delete image from folder
        $updatedImage = explode(",", $deleteImage);
        $filterFinalImages = array_filter($updatedImage); //updated images
        $data = array(
            'success_message' => 'Image Removed',
            'redirect_url' => "mod-products.php?id=" . $id,
            'product_images' => implode(",", $filterFinalImages) ,
        );
        update($id, 'products', $data);

    break;
    case "get-sub-category":
        $subcategory = dbQuery("SELECT id,name from `sub_category` where parent_id='" . $_POST['parent_id'] . "'");
        echo json_encode($subcategory);
        exit;
    break;
    default:
        # code...
        
    break;
}
?>
