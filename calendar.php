<?php
//https://phpjp.com/sample/%E3%82%AB%E3%83%AC%E3%83%B3%E3%83%80%E3%83%BC.php
function color_get($i) {
    if ($i == 0) return '#ff0000'; elseif ($i == 6)return '#0000ff'; else return '#000000';
}
$m = $_GET['m'];
if ($m) {
    $year = date('Y', strtotime($m . '01'));
    $month = date('n', strtotime($m . '01'));
} else {
    $year = date('Y');
    $month = date('n');
}
$day = date('j');
$weekday = array('日', '月', '火', '水', '木', '金', '土');
$holiday =[[2020,1,1],
			[2020,1,13],
			[2020,2,11],
			[2020,2,23],
			[2020,3,20],
			[2020,4,29],
			[2020,5,3],
			[2020,5,4],
			[2020,5,5],
			[2020,5,6],
			[2020,7,23],
			[2020,7,24],
			[2020,8,10],
			[2020,9,21],
			[2020,9,22],
			[2020,11,3],
			[2020,11,23]
			];
			
echo '<TABLE cellpadding="4" cellspacing="1" style="background-color: #aaaaaa;text-align : center;"><CAPTION style="padding: 4px;"><A href="?m=' . date('Ym', mktime(0, 0, 0, $month, 1, $year - 1)) . '">&lt;&lt;</A> <A href="?m='. date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . '">&lt;</A>' . $year . '年' . $month . '月 <A href="?m=' . date('Ym', mktime(0,0, 0, $month + 1 , 1, $year)) . '">&gt;</A> <A href="?m='. date('Ym', mktime(0, 0, 0, $month , 1, $year + 1)) . '">&gt;&gt;</A></CAPTION><TBODY><TR>';
$i = 0;
while ($i <= 6) {
    $c = color_get($i);
    echo '<TD style="color : ' . $c . ';background-color: #eeeeee;">' . $weekday[$i] . '</TD>';
    $i++;
}
echo '</TR><TR>';
$i = 0;
while ($i != date('w', mktime(0, 0, 0, $month, 1, $year))) {
    echo '<TD style="background-color : #ffffff;">　</TD>';
    $i++;
}
for ($days = 1; checkdate($month, $days, $year); $days++) {
    if ($i > 6) {
        echo '</TR><TR>';
        $i = 0;
    }
    $c = color_get($i);
    foreach ($holiday as $value) {
    	if(($value[0] == $year) and ($value[1] == $month) and ($value[2] == $days) ){
    		$c = '#ff0000';
    		break;
    	}
//    	echo '('.$value[0].'='.$year.'||'.$value[1].'='.$month.'||'.$value[2].'='.$days.')';
	}
    if ($days == $day) $bc = '#ffff00'; else $bc ='#ffffff';
    echo '<TD style="color : ' . $c . ';background-color: ' . $bc . ';">' . $days . '</TD>';
    $i++;
}
while ($i < 7) {
    echo '<TD style="background-color : #ffffff;">　</TD>';
    $i++;
}
echo '</TR></TBODY></TABLE>';
?>
