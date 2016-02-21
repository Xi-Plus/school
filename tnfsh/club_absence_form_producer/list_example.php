<?php
header('Content-type:application/force-download');
header('Content-Transfer-Encoding: UTF-8');
header('Content-Disposition:attachment;filename=CAFPlist.csv');
readfile("resource/list_example.csv");
?>