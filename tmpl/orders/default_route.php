<?php

use Joombooking\Component\Bookpro\Administrator\Helper\CurrencyHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

if (count($this->routes) > 0) {
    foreach ($this->routes as $route) {
?>


        <table class="table table-sm">
            <tr>

                <td colspan="2">
                    <?php echo  $route->from_name . ' -> ' . $route->to_name . ' - ' . $route->title ?>
                </td>
            </tr>

        </table>
<?php
    }
}
?>