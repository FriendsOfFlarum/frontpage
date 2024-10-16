import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Discussion from 'flarum/common/models/Discussion';
import Badge from 'flarum/common/components/Badge';

import type ItemList from 'flarum/common/utils/ItemList';
import type Mithril from 'mithril';

export default function addStickyBadge() {
  extend(Discussion.prototype, 'badges', function (badges: ItemList<Mithril.Children>) {
    if (!this.frontpage()) return;

    badges.add('frontpage', <Badge type="frontpage" label={app.translator.trans('core.forum.badge.frontpage_tooltip')} icon="fas fa-home" />, 10);
  });
}
