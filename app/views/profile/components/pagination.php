<?php

function preparePagination(array $data, string $type)
{

    if (!empty($data)) {

        $prepareLI = "";
        $pagesNumber = ceil($data['total'] / 10);
        $prevPageNumber = ($data['currentPage'] > 1) ? $data['currentPage'] - 1 : $data['currentPage'];
        $nextPageNumber = ($data['currentPage'] < $pagesNumber) ? $data['currentPage'] + 1 : $data['currentPage'];
        $isNextPageDisabled = ($data['currentPage'] < $pagesNumber) ? '' : 'disabled';
        $isPrevPageDisabled = ($data['currentPage'] > 1) ? '' : 'disabled';

        $profileLink = route('/profile');

        for ($i = 1; $i <= $pagesNumber; $i++) {
            $isActive = ($data['currentPage'] == $i) ? 'active' : '';
            $prepareLI .= "
    <li class='page-item'><a class='page-link {$isActive}' href='{$profileLink}?{$type}-page={$i}'>{$i}</a></li>
";
        }

        echo "
    <nav aria-label='Page navigation example'>
    <ul class='pagination'>
    <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href='{$profileLink}?{$type}-page={$prevPageNumber}' >Previous</a></li>
{$prepareLI}
    <li class='page-item'><a class='page-link {$isNextPageDisabled}' href='{$profileLink}?{$type}-page={$nextPageNumber}' >Next</a></li>
    </ul>
</nav>
    ";
    }
}
