import {dateFormat} from './date-format.filter';
import {resolveStatusStoredVideoFilter} from './resolve-status-stored-video.filter';

export default {
  install(Vue) {
    Vue.filter('resolveStatusStoredVideoFilter', resolveStatusStoredVideoFilter);
    Vue.filter('dateFormat', dateFormat);
  }
}
