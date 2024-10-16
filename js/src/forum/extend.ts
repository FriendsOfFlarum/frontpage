import Extend from 'flarum/common/extenders';
import Discussion from 'flarum/common/models/Discussion';

export default [
  new Extend.Model(Discussion) //
    .attribute<boolean>('frontpage')
    .attribute<string>('frontdate')
    .attribute<boolean>('front'),
];
