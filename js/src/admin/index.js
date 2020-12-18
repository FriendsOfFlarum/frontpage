import app from 'flarum/app';

app.initializers.add('fof/frontpage', () => {
    app.extensionData.for('fof-frontpage').registerPermission(
        {
            icon: 'fas fa-home',
            label: app.translator.trans('core.admin.permissions.can_push_to_frontpage_label'),
            permission: 'discussion.front',
        },
        'moderate'
    );
});
