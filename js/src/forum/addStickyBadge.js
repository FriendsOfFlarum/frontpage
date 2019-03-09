import { extend } from 'flarum/extend';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';
import Badge from 'flarum/components/Badge';

Discussion.prototype.frontpage = Model.attribute('frontpage');

export default function addStickyBadge() {
  extend(Discussion.prototype, 'badges', function(badges) {
    if (this.frontpage()) {
      badges.add('frontpage', Badge.component({
        type: 'frontpage',
        label: app.translator.trans('core.forum.badge.frontpage_tooltip'),
        icon: 'fas fa-home'
      }), 10);
    }
  });
}
