import app from 'flarum/forum/app';
import addFrontSort from './extenders/addFrontSort';
import addFrontPage from './extenders/addFrontPage';
import addStickyBadge from './extenders/addStickyBadge';

app.initializers.add('fof/frontpage', () => {
  addFrontSort();
  addFrontPage();
  addStickyBadge();
});
