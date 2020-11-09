import {extend} from 'flarum/extend';
import DiscussionListState from 'flarum/states/DiscussionListState';

export default function () {
  extend(DiscussionListState.prototype, 'requestParams', function (params) {

    if (app.current.get('routeName') === 'front') {
      params.filter.q = (params.filter.q || '') + 'is:frontpage';
    }
  });

  extend(DiscussionListState.prototype, 'sortMap', function (map) {

    // Delete Mapping
    delete map.latest;
    delete map.newest;
    delete map.top;
    delete map.oldest;

    // Re-Add Mapping to Redo Sort Order
    map.front = '-frontdate';
    map.latest = '-lastPostedAt';
    map.newest = '-createdAt';
    map.oldest = 'createdAt';
    map.top = '-commentCount';
  });
}
