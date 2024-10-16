import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import DiscussionControls from 'flarum/forum/utils/DiscussionControls';
import Button from 'flarum/common/components/Button';

import type Discussion from 'flarum/common/models/Discussion';
import type Mithril from 'mithril';
import type ItemList from 'flarum/common/utils/ItemList';

export default function addFrontPage() {
  extend(DiscussionControls, 'moderationControls', function (items: ItemList<Mithril.Children>, discussion: Discussion) {
    if (!discussion.front()) return;

    let isFront = discussion.frontpage();

    items.add(
      'frontpage',
      <Button
        icon="fas fa-home"
        onclick={() => {
          isFront = !isFront;
          discussion.save({ frontpage: isFront });
        }}
      >
        {app.translator.trans(
          discussion.frontpage() ? 'core.forum.post_controls.pull_from_front_button' : 'core.forum.post_controls.push_to_front_button'
        )}
      </Button>
    );
  });
}
