import bootstrapForum from '@flarum/jest-config/src/bootstrap/forum';
import app from 'flarum/forum/app';
import DiscussionListState from 'flarum/forum/states/DiscussionListState';
import { extend } from '../../../src/forum';

beforeAll(() => {
  bootstrapForum();
  app.bootExtensions({ 'fof-frontpage': { extend } });
  app.boot();
});

it('lists front page discussions with the frontpage filter', () => {
  const state = new DiscussionListState({ sort: 'front' });

  expect(state.requestParams().filter).toMatchObject({ frontpage: true });
});

it('keeps the search text intact when listing front page discussions', () => {
  const state = new DiscussionListState({ sort: 'front', q: 'foo' });

  expect(state.requestParams().filter).toMatchObject({ q: 'foo', frontpage: true });
});

it('leaves other sorts alone', () => {
  const state = new DiscussionListState({ sort: 'latest', q: 'foo' });

  expect(state.requestParams().filter).not.toHaveProperty('frontpage');
});
