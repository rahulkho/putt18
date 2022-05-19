{{ lotus()->breadcrumbs([
    ['Dashboard', route('dashboard')],
    ['Access Permissions', route('manage.access.index')],
    $breadcrumbs,
    [$pageTitle, null, true]
]) }}