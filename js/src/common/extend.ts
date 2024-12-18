import Extend from 'flarum/common/extenders';
import FrontGambit from './gambits/FrontGambit';

export default [new Extend.Search().gambit('discussions', FrontGambit)];
