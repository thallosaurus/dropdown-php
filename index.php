<?php
require 'vendor/autoload.php';

use Donstrange\DropdownPhp\Dropdown;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        echo Dropdown::getAssets();
    ?>
    <script>
        window.addEventListener("load", (event) => {
            document.addEventListener("contextmenu", (ctxmenuev) => {
                // openDropdownById("test_dd");
                ctxmenuev.preventDefault();
                open("test_dd", ctxmenuev.pageX, ctxmenuev.pageY)
                .then(e => {
                    console.log("Action Id: " + e.actionId);
                });
            });
        })
    </script>
</head>
<body>
    <?php
        $dd = new Dropdown("test_dd");
        $dd->setTitle("Title");
        $dd->addEntry("1", "Tag Genehmigen");
        $dd->addEntry("2", "Tag Ablehnen");
        $dd->addEntry("3", "Tag unter Vorbehalt freigeben", ["divider"]);
        $dd->addEntry("10", "Woche Genehmigen");
        $dd->addEntry("11", "Woche Ablehnen");
        $dd->addEntry("12", "Woche unter Vorbehalt freigeben", ["divider"]);
        $dd->addEntry("xx", "Tag löschen");
        $dd->addEntry("yy", "Woche löschen");
        echo $dd->getOpenButton();

        print Dropdown::getAllDropdowns();
    ?>
</body>
</html>