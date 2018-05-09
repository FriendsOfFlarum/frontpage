import { extend } from 'flarum/extend';
import DiscussionList from 'flarum/components/DiscussionList';

export default function () {
extend(DiscussionList.prototype, 'requestParams', function(params) {

	if (this.props.params.sort === 'front') {

	params.filter.q = (params.filter.q || '') + 'is:frontpage';
	
	}

  });

extend(DiscussionList.prototype, 'sortMap', function (map) {
    	
    	//delete map.latest;
	    delete map.top ;
	    delete map.newest ;
	    delete map.oldest;

        map.front = '-frontdate';
        //map.latest = '-lastTime';
	    map.top = '-commentsCount';
	    map.newest = '-startTime';
	    map.oldest = 'startTime';


        

    });
}