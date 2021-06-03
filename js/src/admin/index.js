import app from 'flarum/common/app';

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
