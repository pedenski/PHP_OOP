<base href="http://demo.reconnect-inc.com/pagination/seo/">
<?php
include('config.php');

$max = 6;
$select = "SELECT * FROM test";
$query1 = mysql_query($select) or die( mysql_error() ); 
$total = mysql_num_rows($query1);

$nav = new Pagination($max, $total);

$query2 = mysql_query($select." LIMIT ".$nav->start().",".$max) or die(mysql_error()); 
while($item = mysql_fetch_object($query2)) 
{ 
    echo $item->id . ' - <b>' . $item->name . '</b><br />';
}

$link = './page-{nr}/';

echo $nav->previous(' <a href="'.$link.'">Previous</a> | ');

echo $nav->numbers(' <a href="'.$link.'">{nr}</a> | ', ' <b>{nr}</b> | ');

echo $nav->next(' <a href="'.$link.'">Next</a> | ');
