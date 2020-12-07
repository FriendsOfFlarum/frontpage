import { extend } from 'flarum/extend';
import DiscussionControls from 'flarum/utils/DiscussionControls';
import Button from 'flarum/components/Button';
import Model from 'flarum/Model';
import Discussion from 'flarum/models/Discussion';

Discussion.prototype.frontpage = Model.attribute('frontpage');
Discussion.prototype.front = Model.attribute('front');

export default function addFrontPage() {
    extend(DiscussionControls, 'moderationControls', function (items, discussion) {
        let isFront = discussion.frontpage();

        if (discussion.front()) {
            items.add(
                'frontpage',
                Button.component(
                    {
                        icon: 'fas fa-home',
                        onclick: () => {
                            isFront = !isFront;
                            discussion.save({ frontpage: isFront });
                        },
                    },
                    app.translator.trans(
                        discussion.frontpage() ? 'core.forum.post_controls.pull_from_front_button' : 'core.forum.post_controls.push_to_front_button'
                    )
                )
            );
        }
    });
}
