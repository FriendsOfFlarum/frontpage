import app from 'flarum/forum/app';
import addFrontSort from './addFrontSort';
import addFrontPage from './addFrontPage';
import addStickyBadge from './addStickyBadge';

app.initializers.add('fof/frontpage', () => {
  addFrontSort();
  addFrontPage();
  addStickyBadge();
});
