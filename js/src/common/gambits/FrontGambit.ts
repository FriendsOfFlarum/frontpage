import app from 'flarum/common/app';
import { BooleanGambit } from 'flarum/common/query/IGambit';

export default class FrontGambit extends BooleanGambit {
  key() {
    return app.translator.trans('fof-frontpage.lib.gambits.frontpage.key', {}, true);
  }

  filterKey() {
    return 'frontpage';
  }
}
