<?php

class Utils
{

    /**
     * $totalItems - общее количество элементов для отображения
     * $perPage - количество элементов, отображаемых на одной странице
     */
    public function drawPager($totalItems, $perPage, $additional_href = '')
    {

        $pages = ceil($totalItems / $perPage);

        if (!isset($_GET['page']) || intval($_GET['page']) == 0) {
            $page = 1;
        } elseif (intval($_GET['page']) > $totalItems) {
            $page = $pages;
        } else {
            $page = intval($_GET['page']);
        }


        $pager = "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";
        $pager .= "<li><a data-ng-click='reloadPage(1)' <a href='/?page=1" . $additional_href . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span> Начало</a></li>";
        for ($i = 2; $i <= $pages - 1; $i++) {
            $pager .= "<li><a href='/?page=" . $i . $additional_href . "' data-ng-click='reloadPage(" . $i . ")'>" . $i . "</a></li>";
        }
        $pager .= "<li><a href='/?page=" . $pages . $additional_href . "' data-ng-click='reloadPage(" . $i . ")' aria-label='Next'>Конец <span aria-hidden='true'>&raquo;</span></a></li>";
        $pager .= "</ul>
                   </nav>";

        return $pager;

    }

}
