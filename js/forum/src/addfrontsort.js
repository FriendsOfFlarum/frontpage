import { extend } from 'flarum/extend';
import DiscussionList from 'flarum/components/DiscussionList';

export default function () {
    extend(DiscussionList.prototype, 'sortMap', function (map) {
        map.front = '-frontdate';
        
    });


extend(DiscussionList.prototype, 'requestParams', function(params) {
	
  });
}