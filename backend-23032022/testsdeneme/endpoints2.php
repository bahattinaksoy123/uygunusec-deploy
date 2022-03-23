<?php
  
// PHP program to search for multiple
// key=>value pairs in array
  
function search($array, $search_list) {
  
    // Create the result array
    $result = array();
  
    // Iterate over each array element
    foreach ($array as $key => $value) {
  
        // Iterate over each search condition
        foreach ($search_list as $k => $v) {
      
            // If the array element does not meet
            // the search condition then continue
            // to the next element
            if (!isset($value[$k]) || $value[$k] != $v)
            {
                  
                // Skip two loops
                continue 2;
            }
        }
      
        // Append array element's key to the
        //result array
        $result[] = $value;
    }
  
    // Return result 
    return $result;
}
  
// Multidimensional array for students list
$arr = array(
    1 => array(
        'rollNo' => 44,
        'name' => 'Alice',
        'section' => 'B'
    ),
    2 => array(
        'rollNo' => 3,
        'name' => 'Amit',
        'section' => 'B'
    ),
    3 => array(
        'rollNo' => 3,
        'name' => 'Bob',
        'section' => 'A'
    ),
    4 => array(
        'rollNo' => 5,
        'name' => 'Gaurav',
        'section' => 'B'
    ),
    5 => array(
        'rollNo' => 5,
        'name' => 'Gaurav',
        'section' => 'A'
    ) 
);
  
// Define search list with multiple key=>value pair
$search_items = array('rollNo'=>5, 'section'=>"A");
  
// Call search and pass the array and
// the search list
$res = search($arr, $search_items);
  
// Print search result
foreach ($res as $var) {
    echo 'RollNo: ' . $var['rollNo'] . '<br>';
    echo 'Name: ' . $var['name'] . '<br>';
    echo 'Section: ' . $var['section'] . '<br>';        
}
  
?>