import { extend, notificationType } from 'flarum/extend';
import app from 'flarum/app';

import addFrontSort from './addFrontSort';
import addFrontPage from './addFrontPage';
import addStickyBadge from './addStickyBadge';

app.initializers.add('fof/frontpage', () => {
  addFrontSort();
  addFrontPage();
  addStickyBadge();
});
