<?php

//---1

$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1" ],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2" ],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4" ],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1" ],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4" ],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3" ],
];

$filtered_array=[];
$unique_ids = array_unique(array_column($array, 'id'));
$result_array = array_filter($array, function($item) use ($unique_ids, &$filtered_array) {
    $to_remove=in_array($item['id'], $unique_ids);
    if($to_remove) $filtered_array[]=$item;
    return $to_remove;
});

print_r($result_array);

//---2

usort($array, function($a, $b) {
    return $a['id'] - $b['id'];
});

//---3

$id_to_find = 2;
$result_array = array_filter($array, function($item) use ($id_to_find) {
    return $item['id'] == $id_to_find;
});

//--4

$new_array = array_reduce($array, function($acc, $item) {
    $acc[$item['name']] = $item['id'];
    return $acc;
}, array());

print_r($new_array);

//--5

SELECT goods_id,
       (SELECT name FROM goods WHERE id = goods_id) as name
FROM goods_tags gt
WHERE (SELECT COUNT(id) FROM tags) = (SELECT COUNT(tag_id) FROM goods_tags WHERE goods_id = gt.goods_id)
GROUP BY goods_id;

//--6


SELECT department_id, AVG(value) as avg_mark
FROM evaluations
WHERE gender=true
GROUP BY department_id
HAVING avg_mark > 5;