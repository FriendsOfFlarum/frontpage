import { extend, notificationType } from 'flarum/extend';
import app from 'flarum/app';

import addfrontsort from 'fixer112/frontpage/addfrontsort';
import addfrontpage from 'fixer112/frontpage/addfrontpage';
import addStickyBadge from 'fixer112/frontpage/addStickyBadge';

app.initializers.add('fixer112-frontpage', function() {;

  addfrontsort();
  addfrontpage();
  addStickyBadge();
  
});