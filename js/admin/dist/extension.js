'use strict';

System.register('fixer112/frontpage/main', ['flarum/extend', 'flarum/app', 'flarum/components/PermissionGrid'], function (_export, _context) {
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
          items.add('frontpage', {
            icon: 'home',
            label: 'frontpage',
            permission: 'discussion.front'
          });
        });
      });
    }
  };
});