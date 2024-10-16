import app from 'flarum/forum/app';
import addFrontSort from './extenders/addFrontSort';
import addFrontPage from './extenders/addFrontPage';
import addStickyBadge from './extenders/addStickyBadge';

export { default as extend } from './extend';

app.initializers.add('fof/frontpage', () => {
  addFrontSort();
  addFrontPage();
  addStickyBadge();
});
