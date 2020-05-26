<?php
use \koolreport\widgets\koolphp\Table;
// access url http://localhost:8000/report/myreport
?>
<html>
    <head>
    <title>My Report</title>
    </head>
    <body>
        <h1>It works</h1>
        <?php
        Table::create([
            "dataSource"=>$this->dataStore("acp_item")
        ]);
        ?>
    </body>
</html>
