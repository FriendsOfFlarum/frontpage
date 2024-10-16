import 'flarum/common/models/Discussion';

declare module 'flarum/common/models/Discussion' {
  export default interface Discussion {
    frontpage(): boolean;
    frontdate(): string;
    front(): boolean;
  }
}
