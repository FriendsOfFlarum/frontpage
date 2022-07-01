import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import DiscussionControls from 'flarum/forum/utils/DiscussionControls';
import Button from 'flarum/common/components/Button';
import Model from 'flarum/common/Model';
import Discussion from 'flarum/common/models/Discussion';

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
