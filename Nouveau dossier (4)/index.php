<?php
$file = "tasks.txt";
if(!file_exists($file)) file_put_contents($file,"");

if(isset($_POST['add'])){
    $task = trim($_POST['task']);
    if($task !== "") file_put_contents($file, $task."\n", FILE_APPEND);
}

if(isset($_POST['del'])){
    $idx = intval($_POST['idx']);
    $all = file($file, FILE_IGNORE_NEW_LINES);
    unset($all[$idx]);
    file_put_contents($file, implode("\n",$all).(count($all)? "\n":""));
}

$tasks = file($file, FILE_IGNORE_NEW_LINES);
?>
<!DOCTYPE html>
<html>
<body>
<h2>قائمة المهام</h2>
<form method="post">
    <input type="text" name="task" placeholder="أضف مهمة">
    <button name="add">إضافة</button>
</form>

<h3>المهام الحالية</h3>
<?php foreach($tasks as $i=>$t): ?>
    <?= htmlspecialchars($t) ?>
    <form method="post" style="display:inline">
        <input type="hidden" name="idx" value="<?= $i ?>">
        <button name="del">حذف</button>
    </form>
    <br>
<?php endforeach; ?>
</body>
</html>
