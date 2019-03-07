import { extend, notificationType } from 'flarum/extend';
import app from 'flarum/app';

import addfrontsort from './addfrontsort';
import addfrontpage from './addfrontpage';
import addStickyBadge from './addStickyBadge';

app.initializers.add('fof/frontpage', () => {
  addfrontsort();
  addfrontpage();
  addStickyBadge();
});
