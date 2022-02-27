<?php


function tableHead(Array $headings){
    $tableheadings='';
    foreach ($headings as $key => $value) {
       $tableheadings .="<th>".$value."</th>";
    }
    echo $tableheadings;

}

function tableData(Array $tableData){
    $tabledata='';

    foreach ($tableData as $key => $value) {
       $tabledata .="<td>".$value."</td>";
    }
    echo $tabledata;
}

?>