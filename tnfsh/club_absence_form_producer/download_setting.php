<?php
header('Content-type:application/force-download');
header('Content-Transfer-Encoding: UTF-8');
header('Content-Disposition:attachment;filename=CAFPsetting.json');
echo json_encode($_POST,JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>