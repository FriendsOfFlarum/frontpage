import { extend } from 'flarum/extend';
import app from 'flarum/app';
import PermissionGrid from 'flarum/components/PermissionGrid';

app.initializers.add('fof/frontpage', () => {
    extend(PermissionGrid.prototype, 'moderateItems', (items) => {
        items.add('frontpage', {
            icon: 'fas fa-home',
            label: app.translator.trans('core.admin.permissions.can_push_to_frontpage_label'),
            permission: 'discussion.front',
        });
    });
});
