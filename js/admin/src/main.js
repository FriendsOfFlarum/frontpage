import { extend } from 'flarum/extend';
import app from 'flarum/app';
import PermissionGrid from 'flarum/components/PermissionGrid';

app.initializers.add('fixer112-frontpage', () => {
  extend(PermissionGrid.prototype, 'moderateItems', items => {
    items.add('front', {
      icon: 'home',
      label: 'Frontpage discussion',
      permission: 'discussion.front'
    }, 96);
  });
});
