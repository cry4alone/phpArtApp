<nav aria-label="Pagination">
    <?php
        $current = $pageData['currentPage'];
        $last = $pageData['lastPage'];
        $query = $pageData['queryParams'];
        $basePage = $pageData['basePage'];

        function buildPageUrl($queryParams, $page) {
            global $basePage;
            $queryParams['page'] = $page;
            return $basePage . '?' . http_build_query($queryParams);
        }

        function renderPageItem($page, $current, $query) {
            $active = $page === $current ? ' active' : '';
            $url = buildPageUrl($query, $page);
            return "<li class='page-item$active'><a class='page-link' href='$url'>$page</a></li>";
        }
    ?>

    <ul class="pagination justify-content-center">
        <li class="page-item <?= $current <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= $current > 1 ? buildPageUrl($query, $current - 1) : '#' ?>">&lt;</a>
        </li>

        <?= renderPageItem(1, $current, $query) ?>

        <?php if ($current >= 4): ?>
            <li class='page-item disabled'><span class='page-link'>...</span></li>
        <?php elseif ($last >= 2): ?>
            <?= renderPageItem(2, $current, $query) ?>
        <?php endif; ?>

        <?php
            $start = max(3, $current - 1);
            $end = min($last - 1, $current + 1);

            for ($i = $start; $i <= $end; $i++) {
                echo renderPageItem($i, $current, $query);
            }
        ?>

        <?php if ($current < $last - 2): ?>
            <li class='page-item disabled'><span class='page-link'>...</span></li>
        <?php endif; ?>

        <?php if ($last > 1 && $last !== 2): ?>
            <?= renderPageItem($last, $current, $query) ?>
        <?php endif; ?>

        <li class="page-item <?= $current >= $last ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= $current < $last ? buildPageUrl($query, $current + 1) : '#' ?>">&gt;</a>
        </li>
    </ul>
</nav>