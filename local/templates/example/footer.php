<?php
/**
 * Template footer section
 */

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc as Location;

?>
<footer class="footer">
    <div class="container-fluid">
        <span class="text-muted"><?=Location::getMessage('FOOTER_MESSAGE_1')?></span>
    </div>
</footer>
</body>
</html>