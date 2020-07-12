<h1>My site</h1>

@can('edit_forum')
    <li>
        <a href="">Edit form</a>
    </li>
@endcan

@can('view_reports')
    <li>
        <a href="reports">View reports</a>
    </li>
@endcan
