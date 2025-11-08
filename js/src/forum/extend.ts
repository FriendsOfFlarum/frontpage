import { default as commonExtend } from '../common/extend';
import Extend from 'flarum/common/extenders';
import Discussion from 'flarum/common/models/Discussion';
import Model from 'flarum/common/Model';

export default [
  ...commonExtend,

  new Extend.Model(Discussion) //
    .attribute<boolean>('frontpage')
    .attribute('frontdate', Model.transformDate)
    .attribute<boolean>('front'),
];
