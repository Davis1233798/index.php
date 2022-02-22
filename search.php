<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
</head>

<body>

<?php

if (isset($_GET['s'])) { // 如果有搜尋文字顯示搜尋結果

    $sql = "SELECT * FROM meal WHERE meal_ID =  '" . $s . "'";
    $result = $db->doselect($sql);


    // 搜尋無資料時顯示「查無資料」
    if (mysqli_num_rows($result) <= 0) {
        echo "<tr><td colspan='4'>查無資料</td></tr>";
    }

    // 搜尋有資料時顯示搜尋結果
    while ($row = mysqli_fetch_array($result)) {

        echo "<span>" . $row['remark'] . "</sapn>";

    }
}

?>

</body>

</html>