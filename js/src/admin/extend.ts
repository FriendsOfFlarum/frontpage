import app from 'flarum/admin/app';
import Extend from 'flarum/common/extenders';
import { default as commonExtend } from '../common/extend';

export default [
  ...commonExtend,

  new Extend.Admin().permission(
    () => ({
      icon: 'fas fa-home',
      label: app.translator.trans('fof-frontpage.admin.permissions.can_push_to_frontpage_label'),
      permission: 'discussion.front',
    }),
    'moderate'
  ),
];
