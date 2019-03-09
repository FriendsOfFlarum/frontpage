import { extend } from 'flarum/extend';
import PostControls from 'flarum/utils/PostControls';
import Button from 'flarum/components/Button';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';

Discussion.prototype.frontpage = Model.attribute('frontpage');
Discussion.prototype.front = Model.attribute('front');

export default function addFrontPage() {
  extend(PostControls, 'moderationControls', function(items, post) {
    let isFront = post.discussion().frontpage();

    if (post.discussion().front()) {
      items.add('frontpage', Button.component({
        children: app.translator.trans(post.discussion().frontpage() ? 'core.forum.post_controls.pull_from_front_button' : 'core.forum.post_controls.push_to_front_button'),
        icon: 'fas fa-home',
        onclick: () => {
          isFront = !isFront;
          post.discussion().save({frontpage: isFront});
        }
      }));
    }
  });
}
