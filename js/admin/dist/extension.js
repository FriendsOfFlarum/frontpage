'use strict';

System.register('flarum/sticky/main', ['flarum/extend', 'flarum/app', 'flarum/components/PermissionGrid'], function (_export, _context) {
  "use strict";

  var extend, app, PermissionGrid;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumApp) {
      app = _flarumApp.default;
    }, function (_flarumComponentsPermissionGrid) {
      PermissionGrid = _flarumComponentsPermissionGrid.default;
    }],
    execute: function () {

      app.initializers.add('fixer112-frontpage', function () {
        extend(PermissionGrid.prototype, 'moderateItems', function (items) {
          items.add('front', {
            icon: 'home',
            label: 'Frontpage discussion',
            permission: 'discussion.front'
          }, 96);
        });
      });
    }
  };
});