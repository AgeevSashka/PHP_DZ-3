<?php
//             Задание 1
function task1()
{
    $xml = new DOMDocument();
    $xml->load('dz.xml');
    echo '<pre>';
    var_dump($xml->textContent);
}
function task1_1($name)
{
   echo '<pre>';
    $xml = simplexml_load_file($name);
    foreach ($xml->attributes() as $item) {
        //var_dump($item);
        echo $item->getName() . ': ' . $item . PHP_EOL . PHP_EOL;
    }
    foreach ($xml->Address as $key => $value)
    {
        //var_dump($value);
        echo $value->attributes()->getName() . ': ' . $value->attributes()->Type . PHP_EOL .PHP_EOL;
        echo $value->Name->getName() . ': ' . $value->Name->__toString() . PHP_EOL;
        echo 'Street : ' . $value->Street . PHP_EOL;
        echo 'City : ' . $value->City . PHP_EOL;
        echo 'State : ' . $value->State . PHP_EOL;
        echo 'Zip : ' . $value->Zip . PHP_EOL;
        echo 'Country : ' . $value->Country . PHP_EOL . PHP_EOL;
    }
    echo 'DeliveryNotes: ' . $xml->DeliveryNotes->__toString() . PHP_EOL . PHP_EOL;
    foreach ($xml->Items->Item as $item => $key) {
        //var_dump($item);
        //var_dump($key);
        echo $key->attributes()->getName() . ': ' . $key->attributes() . PHP_EOL;
        echo $key->ProductName->__toString() . ' = ' . $key->Quantity->__toString() . PHP_EOL;
        echo 'Price = ' . $key->USPrice->__toString(). PHP_EOL;
        echo 'Comments: ' . $key->Comment->__toString() . PHP_EOL;
        echo 'Shipping Date: ' . $key->ShipDate->__toString() . PHP_EOL . PHP_EOL;
    }
}
//         Задание 2
function task2()
{
    $animals = [
        cats => [
            homecats =>['homecat1' => 'Барсик', 'homecat2' => 'Клео'],
            streetcats => ['streetcat1' => 'Гарфилд', 'streetcat2' => 'Мурка']
        ],
        dogs => [
            homedogs => ['homedog1' => 'Свисс', 'homedog2' => 'Рекс'],
            streetdog => ['streetdog1' => 'Пес', 'streetdog2' => 'Бобик']
        ]
    ];
    $birds = [
        homebird => ['homebird1' => 'Кеша', 'homebird2' => 'Митя'],
        streetbird => ['streetbird1' => 'Варона', 'streetbird2' => 'Воробей']
    ];
    $random = rand(1, 2);
    if($random == 1)
    {
        array_push($animals, $birds);
        $conv = json_encode($animals);
        file_put_contents('output2.json', $conv);
        echo file_get_contents('output2.json');
    } elseif ($random == 2)
    {
        echo file_get_contents('output.json');
    }else
    {
        echo 'ERROR';
    }
}
//         Задание 3
function task3($num)
{
    echo '<pre>';
    $array = [];
    $sub_array = [];
    $csv = 'dz.csv';
    for ($i = 0; $i < $num; $i++) {
        $array[$i] = (array)rand(1, 50);
    }
   $handle = fopen($csv, 'w');
    foreach ($array as $item)
    {
        if (fputcsv($handle, $item) === false) {
            continue;
        };
    }
    $handle = fopen($csv, 'r');
    while ($str = fgetcsv($handle, 50))
    {
        switch ($str[0] % 2 == 0) {
            case 1:
                $sub_array[] = $str[0];
                break;
            case 2:
                echo 'ERROR';
                break;
        }
    }
    $sum = array_sum($sub_array);
    echo 'Количество четных : ' . count($sub_array) . PHP_EOL . 'Общей суммой : ' . $sum . PHP_EOL;
}
//         Задание 4
function task4($src)
{
    echo '<pre>';
    $file = file_get_contents($src);
    $link = json_decode($file);
    $number = '15580374';
    echo 'title: ' . $link->query->pages->$number->title . PHP_EOL;
    echo 'pageid: ' . $link->query->pages->$number->pageid . PHP_EOL;
}
$src = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';