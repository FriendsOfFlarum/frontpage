import bootstrapForum from '@flarum/jest-config/src/bootstrap/forum';
import app from 'flarum/forum/app';
import { extend } from '../../../src/forum';

beforeAll(() => {
  bootstrapForum();
  app.bootExtensions({ 'fof-frontpage': { extend } });
  app.boot();
  app.translator.addTranslations({
    'core.lib.gambits.group_keys.is': 'статус',
    'fof-frontpage.lib.gambits.frontpage.key': 'главная',
  });
});

it('turns the translated gambit into the frontpage filter', () => {
  expect(app.search.gambits.apply('discussions', { q: 'статус:главная' })).toStrictEqual({ q: '', frontpage: true });
});

it('still turns the English is:frontpage into the frontpage filter on a translated forum', () => {
  expect(app.search.gambits.apply('discussions', { q: 'is:frontpage' })).toStrictEqual({ q: '', frontpage: true });
});

it('still turns the negated English -is:frontpage into the negated filter on a translated forum', () => {
  expect(app.search.gambits.apply('discussions', { q: '-is:frontpage' })).toStrictEqual({ q: '', '-frontpage': true });
});
