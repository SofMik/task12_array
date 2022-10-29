<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];
 
//1A. getFullnameFromParts1 принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.
$number1 = 'Громов';
$number2 = 'Александр';
$number3 = 'Иванович';
function getFullnameFromParts1($number1, $number2, $number3) {
    $fullName1 = $number1 . ' ' . $number2 . ' ' . $number3;
    return $fullName1;
    };
print "1А). ";
print_r(getFullnameFromParts1($number1, $number2, $number3));
print "<br/>";

//1B. getFullnameFromParts2 принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.
$parts = ['Пащенко', 'Владимир', 'Александрович'];
function getFullnameFromParts2($parts){
    return implode(' ',$parts);
    };
print "1Б). ";
print_r(getFullnameFromParts2($parts)); 
print "<br/>";

//2. getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.
$example = 'Степанова Наталья Степановна';
function getPartsFromFullname1($example){
    return array_combine(['surname','name','patronymic'], explode(' ',$example));
};
print "2). ";
print_r(getPartsFromFullname1($example));
print "<br/>";


//3. getShortName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество.
$new = explode(' ',$example);
function getShortName($new){
    $name = $new[1];
    $surname = iconv_substr($new[0], 0, 1) . ".";
    $newName = $name . ' ' . $surname;
    return $newName;
    };
print "3). ";
print_r(getShortName($new));
print "<br/>";

//4. getGenderFromName, принимающую как аргумент строку, содержащую ФИО (вида «Иванов Иван Иванович») для определения пола. 
function getGenderFromName1($new){
    $gender1 = 0;
    $surnameLast1 = iconv_substr($new[0], -1);
    $nameLast1 = iconv_substr($new[1], -1);
    $patronymicLast1 = iconv_substr($new[2], -2);
        if ($surnameLast1 === 'а') {
            $gender1--;
        }
        if ($nameLast1 === 'а') {
            $gender1--;
        } 
        if ($patronymicLast1 === 'на') {
            $gender1--;
        } 
        if ($surnameLast1 === 'в') {
            $gender1++;
        }
        if ($nameLast1 === 'н' || $nameLast1 === 'й') {
            $gender1++;
        } 
        if ($patronymicLast1 === 'ич') {
            $gender1++;
        } 
        if ($gender1 < 0) {
            return -1;
        }
        if ($gender1 > 0) {
            return 1;
        }
        if ($gender1 == 0) {
            return 0;
        }
};
print "4). ";
print_r(getGenderFromName1($new)); 
print "<br/>";


 //5. определения пола массива
 function getGenderFromNameAll($example_persons_array){
print "5). ";
$genderMale = 0;
$genderFemale = 0;
$genderNone = 0;
for($i = 0; $i < count($example_persons_array); $i++) {
    print "<br/>";
    $full = $example_persons_array[$i]['fullname'];
    $pieces = explode(" ", $full);
    $surname = $pieces[0]; 
    $name = $pieces[1]; 
    $lastname = $pieces[2]; 
    echo "Полное имя и пол в строку: " . $example_persons_array[$i]['fullname'];

    $surnameLast = iconv_substr($surname, -1);//определение пола
    $nameLast = iconv_substr($name, -1);
    $patronymicLast = iconv_substr($lastname, -2);
    if ($surnameLast === 'а' || $nameLast === 'я' || $nameLast === 'a' || $patronymicLast === 'на') {
        $gender = 'ж';
    }
    elseif ($surnameLast === 'в' || $nameLast === 'н' || $nameLast === 'й' || $patronymicLast === 'ич') {
        $gender = 'м';  
    } 
    else {
        $gender = 'неопределен';
    }
//echo   " фам " .  $surnameLast . " имя " .  $nameLast . " отч " .  $patronymicLast; 
echo " пол " . $gender;
$array = array(
    'surname' => $pieces[0],
    'name' => $pieces[1],
    'patronymic' => $pieces[2],
    'gender' => $gender,
);
print "<br/>";
echo "В виде массива: ";
print_r($array);
print "<br/>";

    if ($gender == 'м') {
            $genderMale++;
    }
    elseif ($gender === 'ж') {
            $genderFemale++;
    }
    elseif ($gender === 'неопределен') {
            $genderNone++;
    }
};
//print "<br/> женщин:" . $genderFemale;
//print "<br/> мужчин:" . $genderMale ;
//print "<br/> не определить:" . $genderNone ;
//print_r("<br/> Всего:" . count($example_persons_array));
$resultMale = round($genderMale / count($example_persons_array) * 100, 1);
$resultFemale = round($genderFemale / count($example_persons_array) * 100, 1); 
$resultNoMale = round($genderNone / count($example_persons_array) * 100, 1);
echo "<br/> Гендерный состав аудитории:" . "<br/>" ;
echo "Женщин - " . $resultFemale . " %" . "<br/>";
echo "Мужчин - " . $resultMale. " %" . "<br/>";
echo "Не удалось определить - " . $resultNoMale. " %" . "<br/>";
};

print_r(getGenderFromNameAll($example_persons_array)); 
print "6). ";

//6. подбор пары
function getPerfectPartner($example_persons_array){

$number1 = random_int(0, count($example_persons_array));
$number2 = random_int(0, count($example_persons_array));
$partner1 = $example_persons_array[$number1]['fullname'];
$partner2 = $example_persons_array[$number2]['fullname'];
$new1 = explode(' ',$partner1);
$new2 = explode(' ',$partner2);
$genderofpartner1= getGenderFromName1($new1);
$genderofpartner2 = getGenderFromName1($new2);
    if($new1 == $new2){
            getPerfectPartner($example_persons_array);
        }
    elseif($genderofpartner1 == 0 || $genderofpartner2 == 0){
            getPerfectPartner($example_persons_array);
        }
    elseif ($genderofpartner1 != $genderofpartner2) {
        $print1 = getShortName($new1);
        $print2 = getShortName($new2);
        echo $print1 . " + " . $print2 . " = ♡ Идеально на " . random_int(5000, 10000) / 100 ." % ♡";
    }
    else {
        getPerfectPartner($example_persons_array);
    }
};

print_r(getPerfectPartner($example_persons_array)); 

