// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import axios from 'axios';
import VueClipboard from 'vue-clipboard2';
import App from './App';
import router from './router';
import global from './global';

Vue.use(VueClipboard);

Vue.prototype.axios = axios;

Vue.prototype.global = global;

Vue.config.productionTip = false;

router.beforeEach((() => {
  let isChecked = false;
  return (to, from, next) => {
    if (!isChecked) {
      isChecked = true;
      // 注入session测试
      // axios.get('api/inject/4Y0UUI')
      //   .then(() => axios.post('api/init'))
      axios.post('api/init')
        .then((data) => {
          data = data.data;
          if (data.errno) {
            alert(data.msg);
          } else if (data.login) {
            to.meta.status = data.status;
            to.meta.login = data.login;
            to.meta.reg = data.reg;
          } else {
            location.href = `https://hemc.100steps.net/2018/fireman/auth.php?state=123&redirect=${encodeURIComponent('https://hemc.100steps.net/2018/movie-matching/api/login')}`;
          }
          next();
        });
    } else if (to.meta.status === 5) {
      alert('电影对对碰结束啦，更多活动敬请期待。');
      next(false);
    } else {
      next();
    }
  };
})());

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
});
