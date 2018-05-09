import { extend } from 'flarum/extend';
import DiscussionControls from 'flarum/utils/DiscussionControls';
import DiscussionPage from 'flarum/components/DiscussionPage';
import Button from 'flarum/components/Button';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';

Discussion.prototype.frontpage = Model.attribute('frontpage');
Discussion.prototype.front = Model.attribute('front');

export default function addfrontpage() {

  extend(DiscussionControls, 'moderationControls', function(items, discussion) {
    
    let isfront = discussion.frontpage();
    if (discussion.front()) {
      items.add('frontpage', Button.component({
        children: discussion.frontpage() ? 'Unfront' : 'Front',
        icon: 'home',
        onclick: () => {
          isfront = !isfront;
          discussion.save({frontpage: isfront});

      
        }

      }));
    }
    
  });

}

