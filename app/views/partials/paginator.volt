<nav>
    <ul class="pagination pagination-sm" style="margin: 0px 0;">
        <li>{{ link_to(contaction~"?page="~page.first, "&laquo;") }}</li>
        <li>{{ link_to(contaction~"?page="~page.before, "&lsaquo;") }}</li>
        <li>{{ link_to(contaction~"?page="~page.current, page.from_items~" bis "~page.to_items~" von "~page.total_items) }}</li>
        <li>{{ link_to(contaction~"?page="~page.next, "&rsaquo;") }}</li>
        <li>{{ link_to(contaction~"?page="~page.last, "&raquo;") }}</li>
    </ul>
</nav>
