import { extend } from 'flarum/common/extend';
import DiscussionListState from 'flarum/forum/states/DiscussionListState';

import type { PaginatedListParams } from 'flarum/common/states/PaginatedListState';

export default function () {
  extend(DiscussionListState.prototype, 'requestParams', function (this: DiscussionListState, params: PaginatedListParams) {
    if (this.params.sort === 'front') {
      if (params.filter.q) {
        params.filter.q = (params.filter.q || '') + 'is:frontpage';
      } else {
        params.filter.frontpage = true;
      }
    }
  });

  extend(DiscussionListState.prototype, 'sortMap', function (map: Record<string, string>) {
    map.front = '-frontdate';
  });
}
