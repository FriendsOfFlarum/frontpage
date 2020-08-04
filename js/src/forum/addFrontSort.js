import {
    extend
} from 'flarum/extend';
import DiscussionList from 'flarum/components/DiscussionList';

export default function() {
    extend(DiscussionList.prototype, 'requestParams', function(params) {

        if (this.props.params.sort === 'front') {
            params.filter.q = (params.filter.q || '') + 'is:frontpage';
        }
    });

    extend(DiscussionList.prototype, 'sortMap', function(map) {

        // Delete Mapping
        delete map.latest;
        delete map.top;
        delete map.newest;
        delete map.oldest;

        // Re-Add Mapping to Redo Sort Order
        map.front = '-frontdate';
        map.latest = '-lastPostedAt';
        map.top = '-commentCount';
        map.newest = '-createdAt';
        map.oldest = 'createdAt';
        console.log(map);
    });
}