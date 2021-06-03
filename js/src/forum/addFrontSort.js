import { extend } from 'flarum/common/extend';
import DiscussionListState from 'flarum/forum/states/DiscussionListState';

export default function () {
    extend(DiscussionListState.prototype, 'requestParams', function (params) {
        if (this.params.sort === 'front') {
            params.filter.q = (params.filter.q || '') + 'is:frontpage';
        }
    });

    extend(DiscussionListState.prototype, 'sortMap', function (map) {
        map.front = '-frontdate';
    });
}
