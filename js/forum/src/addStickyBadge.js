import { extend } from 'flarum/extend';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';
import Badge from 'flarum/components/Badge';

Discussion.prototype.frontpage = Model.attribute('frontpage');

export default function addStickyBadge() {

  extend(Discussion.prototype, 'badges', function(badges, discussion) {
    if (this.frontpage()) {
      badges.add('frontpage', Badge.component({
        type: 'front',
        label: 'front',
        icon: 'home'
      }), 10);
    }
  });
}
