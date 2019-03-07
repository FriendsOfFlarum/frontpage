import { extend } from 'flarum/extend';
import app from 'flarum/app';
import PermissionGrid from 'flarum/components/PermissionGrid';

app.initializers.add('fof/frontpage', () => {
  extend(PermissionGrid.prototype, 'moderateItems', items => {
    items.add('frontpage', {
      icon: 'home',
      label: 'frontpage',
      permission: 'discussion.front'
    });
  });
});
