'use strict';

System.register('fixer112/frontpage/addfrontpage', ['flarum/extend', 'flarum/utils/DiscussionControls', 'flarum/components/DiscussionPage', 'flarum/components/Button', 'flarum/Model', 'flarum/models/Discussion'], function (_export, _context) {
  "use strict";

  var extend, DiscussionControls, DiscussionPage, Button, Model, Discussion;
  function addfrontpage() {

    extend(DiscussionControls, 'moderationControls', function (items, discussion) {

      var isfront = discussion.frontpage();
      if (discussion.front()) {
        items.add('frontpage', Button.component({
          children: discussion.frontpage() ? 'Unfront' : 'Front',
          icon: 'home',
          onclick: function onclick() {
            isfront = !isfront;
            discussion.save({ frontpage: isfront });
          }

        }));
      }
    });
  }

  _export('default', addfrontpage);

  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumUtilsDiscussionControls) {
      DiscussionControls = _flarumUtilsDiscussionControls.default;
    }, function (_flarumComponentsDiscussionPage) {
      DiscussionPage = _flarumComponentsDiscussionPage.default;
    }, function (_flarumComponentsButton) {
      Button = _flarumComponentsButton.default;
    }, function (_flarumModel) {
      Model = _flarumModel.default;
    }, function (_flarumModelsDiscussion) {
      Discussion = _flarumModelsDiscussion.default;
    }],
    execute: function () {

      Discussion.prototype.frontpage = Model.attribute('frontpage');
      Discussion.prototype.front = Model.attribute('front');
    }
  };
});;
'use strict';

System.register('fixer112/frontpage/addfrontsort', ['flarum/extend', 'flarum/components/DiscussionList'], function (_export, _context) {
	"use strict";

	var extend, DiscussionList;

	_export('default', function () {
		extend(DiscussionList.prototype, 'requestParams', function (params) {

			if (this.props.params.sort === 'front') {

				params.filter.q = (params.filter.q || '') + 'is:frontpage';
			}
		});

		extend(DiscussionList.prototype, 'sortMap', function (map) {

			//delete map.latest;
			delete map.top;
			delete map.newest;
			delete map.oldest;

			map.front = '-frontdate';
			//map.latest = '-lastTime';
			map.top = '-commentsCount';
			map.newest = '-startTime';
			map.oldest = 'startTime';
		});
	});

	return {
		setters: [function (_flarumExtend) {
			extend = _flarumExtend.extend;
		}, function (_flarumComponentsDiscussionList) {
			DiscussionList = _flarumComponentsDiscussionList.default;
		}],
		execute: function () {}
	};
});;
'use strict';

System.register('fixer112/frontpage/addStickyBadge', ['flarum/extend', 'flarum/Model', 'flarum/models/Discussion', 'flarum/components/Badge'], function (_export, _context) {
  "use strict";

  var extend, Model, Discussion, Badge;
  function addStickyBadge() {

    extend(Discussion.prototype, 'badges', function (badges, discussion) {
      if (this.frontpage()) {
        badges.add('frontpage', Badge.component({
          type: 'front',
          label: 'front',
          icon: 'home'
        }), 10);
      }
    });
  }

  _export('default', addStickyBadge);

  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumModel) {
      Model = _flarumModel.default;
    }, function (_flarumModelsDiscussion) {
      Discussion = _flarumModelsDiscussion.default;
    }, function (_flarumComponentsBadge) {
      Badge = _flarumComponentsBadge.default;
    }],
    execute: function () {

      Discussion.prototype.frontpage = Model.attribute('frontpage');
    }
  };
});;
'use strict';

System.register('fixer112/frontpage/main', ['flarum/extend', 'flarum/app', 'fixer112/frontpage/addfrontsort', 'fixer112/frontpage/addfrontpage', 'fixer112/frontpage/addStickyBadge'], function (_export, _context) {
  "use strict";

  var extend, notificationType, app, addfrontsort, addfrontpage, addStickyBadge;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
      notificationType = _flarumExtend.notificationType;
    }, function (_flarumApp) {
      app = _flarumApp.default;
    }, function (_fixer112FrontpageAddfrontsort) {
      addfrontsort = _fixer112FrontpageAddfrontsort.default;
    }, function (_fixer112FrontpageAddfrontpage) {
      addfrontpage = _fixer112FrontpageAddfrontpage.default;
    }, function (_fixer112FrontpageAddStickyBadge) {
      addStickyBadge = _fixer112FrontpageAddStickyBadge.default;
    }],
    execute: function () {

      app.initializers.add('fixer112-frontpage', function () {
        ;

        addfrontsort();
        addfrontpage();
        addStickyBadge();
      });
    }
  };
});