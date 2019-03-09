import { extend } from 'flarum/extend';
import PostControls from 'flarum/utils/PostControls';
import Button from 'flarum/components/Button';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';

Discussion.prototype.frontpage = Model.attribute('frontpage');
Discussion.prototype.front = Model.attribute('front');

export default function addfrontpage() {
  extend(PostControls, 'moderationControls', function(items, post) {
    let isfront = post.discussion().frontpage();

    if (post.discussion().front()) {
      items.add('frontpage', Button.component({
        children: post.discussion().frontpage() ? 'Pull from FrontPage' : 'Push to FrontPage',
        icon: 'fas fa-home',
        onclick: () => {
          isfront = !isfront;
          post.discussion().save({frontpage: isfront});
        }
      }));
    }
  });
}
