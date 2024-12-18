import app from 'flarum/admin/app';

app.initializers.add('fof/frontpage', () => {
  app.registry.for('fof-frontpage').registerPermission(
    {
      icon: 'fas fa-home',
      label: app.translator.trans('core.admin.permissions.can_push_to_frontpage_label'),
      permission: 'discussion.front',
    },
    'moderate'
  );
});
