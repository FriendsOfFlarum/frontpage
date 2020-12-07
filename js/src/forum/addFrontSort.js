import { extend } from 'flarum/extend';
import DiscussionListState from 'flarum/states/DiscussionListState';

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
