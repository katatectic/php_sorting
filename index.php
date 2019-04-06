<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style/css.css" type="text/css">
    <title>Hello, world!</title>

</head>
<body>
<?php

    /*
     * All fields array
     * */

    $fields = ['Manufacturer', 'Family', 'Code', 'Code'];

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
     * $elementsQuantity - quantity of elements in array
     * */
    $elementsQuantity = 10000;

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
     * Creating of the global associative array of elements
     * */
    $globalArray = [];
    foreach ($ids as $id) {
        $globalArray[] = array('Manufacturer' => $manufacturers[$id],
            'Family' => $families[$id],
            'Code' => $codes[$id],
            'Score' => $scores[$id]);
    }

    /*
     * Prepare data for multisorting
     * */
    foreach ($globalArray as $key => $row) {
        $Manufacturer[$key]  = $row['Manufacturer'];
        $Family[$key]  = $row['Family'];
        $Code[$key]  = $row['Code'];
        $Score[$key] = $row['Score'];
    }

    array_multisort($Manufacturer, SORT_DESC,
        $Family, SORT_DESC,
        $Code, SORT_DESC,
        $Score, SORT_DESC,
        $globalArray);
    /*
     * check if we have data from our form. If we have, make filter
     * */
    if (isset($_GET['search'])) {
        $inputField = trim($_GET['search']);
        if($inputField) {
            $field = explode(" ", $inputField)[0];
            $field_value = explode(" ", $inputField)[1];
            if (in_array($field, $fields)) {
                $globalArray = array_filter($globalArray, function ($globalArray) use($field, $field_value) {
                    return $globalArray[$field] == $field_value;
                });
            }
        }
    }
?>
    <div class="container mt-5">
        <div class="row">
            <div class ="col-sm-12">
                <h1>Test task</h1>
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" name="search" class="form-control" id="search" placeholder="Enter entity">
                    </div>
                    <button type="submit" name="" class="btn btn-primary">Submit</button>
                </form>
                <div>
                    <?php foreach($globalArray as $array) {?>
                        <ul class="list-group mt-1 ml-1 mb-1 mr-1 globalArray">
                            <?php foreach ($array as $key => $element) { ?>
                            <li class="list-group-item">
                                <?php
                                if (empty($element)) {
                                    echo("[NO $key]");
                                } else {
                                    echo($key . ' ' . $element);
                                }
                                }?>
                            </li>
                        </ul>
                    <?}?>
                </div>
            </div>
        </div>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

