import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Model from 'flarum/common/Model';
import Discussion from 'flarum/common/models/Discussion';
import Badge from 'flarum/common/components/Badge';

export default function addStickyBadge() {
  extend(Discussion.prototype, 'badges', function (badges) {
    if (this.frontpage()) {
      badges.add(
        'frontpage',
        Badge.component({
          type: 'frontpage',
          label: app.translator.trans('core.forum.badge.frontpage_tooltip'),
          icon: 'fas fa-home',
        }),
        10
      );
    }
  });
}
