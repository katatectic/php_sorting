<?php

/*
 * Arrays for defining initial conditions for different types
 * $array = [int( every index), int (start random),  int (end random)]
 * Specified for manufacturers, families, codes, scores
 * */

$manufacturersInitialConditions = [2, 0, 10];
$familiesInitialConditions = [4, 0, 10];
$codesInitialConditions = [7, 0, 10];
$scoresInitialConditions = [1, 0, 1000];

/*
 * $elementsQuantity - quantity of elements un array
 * */

$elementsQuantity = 1000;

/*
 * function makeArray - for making arrays
 * */

function makeArray($initialConditions) {
    $array = [];
    global $elementsQuantity;
    for($i = 1; $i <= $elementsQuantity; $i++) {
        $i % $initialConditions[0] == 0 ? $array[] = rand($initialConditions[1], $initialConditions[2]) : $array[] = null;
    }
    return $array;
}

/*
 * Making of arrays for every field
 * */
$ids = range(0, $elementsQuantity);
$manufacturers = makeArray($manufacturersInitialConditions);
$families = makeArray($familiesInitialConditions);
$codes = makeArray($codesInitialConditions);
$scores = makeArray($scoresInitialConditions);

/*
 * Making of the global associative array of elements
 * */
$global_array = [];
if (!isset($_GET['form'])) {
    foreach ($ids as $id) {
        $global_array[] = array('Manufacturer' => $manufacturers[$id],
            'Family' => $families[$id],
            'Code' => $codes[$id],
            'Score' => $scores[$id]);
    }
}
else {
    //$global_array = [1, 2];
    echo($_GET['form']);
    header('location: index.php');
}


/*
 * Prepare data for multisorting
 * */

foreach ($global_array as $key => $row) {
    $Manufacturer[$key]  = $row['Manufacturer'];
    $Family[$key]  = $row['Family'];
    $Code[$key]  = $row['Code'];
    $Score[$key] = $row['Score'];
}

array_multisort($Manufacturer, SORT_DESC,
    $Family, SORT_DESC,
    $Code, SORT_DESC,
    $Score, SORT_DESC,
    $global_array);

// Sort the data with descending
//if (!isset($_GET['form'])) {
//
//}
//
//else {
//    $global_array = [1, 2];
//    var_dump($global_array);
//    header('location: index.php');
//}


//if (isset($_POST['form'])) {
//    //var_dump($global_array);
//    $global_array2 = [1,2];
//    //echo($_POST['search']);
//    header('location: index.php');
//    //header("Location: {$_SERVER["HTTP_REFERER"]}");
//}

?>