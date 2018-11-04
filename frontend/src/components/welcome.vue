<template>
  <div class="hello">
    <div class="title"></div>
    <div class="signIn" @click="signIn"></div>
    <div class="inquery" @click="inquery"></div>
    <div>{{errorMsg}}</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errorMsg: '',
    };
  },
  name: 'welcome',
  methods: {
    signIn() {
      if (this.$route.meta.status === 5) {
        this.errorMsg = '活动已过期';
      } else if (!this.$route.meta.login) {
        this.errorMsg = '请先授权登录';
      } else if (this.$route.meta.reg === false) {
        if (this.$route.meta.status === 0) {
          this.$router.push({ name: 'signIn' });
        } else {
          this.errorMsg = '报名已结束，感谢参与';
        }
      } else {
        this.$router.push({ name: 'prevent' });
      }
      // if (this.status === 0 && this.global.userStatus.reg === false) {
      //   this.$router.push({ name: 'signIn' });
      // } else if (this.status === 5) {
      //   this.errorMsg = '活动已过期';
      // } else if (this.global.userStatus.login === false) {
      //   this.errorMsg = '请先授权登录';
      // } else {
      //   this.$router.push({ name: 'prevent' });
      // }
    },
    inquery() {
      if (this.$route.meta.status === 5) {
        this.errorMsg = '活动已过期';
      } else if (this.$route.meta.reg === false) {
        this.errorMsg = '你还没有报名';
      } else if (this.$route.meta.login === false) {
        this.errorMsg = '请先授权登录';
      } else {
        this.axios.post('api/query').then((response) => {
          const data = response.data;
          if (data.errno === 0) {
            this.global.inqueryMsg = data;
            this.$router.push({ name: 'inquery' });
          } else {
            this.errorMsg = data.errmsg;
          }
        });
      }
    },
  },
};
</script>

<style scoped>
.hello {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background1.png) no-repeat bottom;
  background-size: 100% 100%;
  color: #fefdfb;
}

.title {
  padding-top: 10vh;
  width: 100vw;
  height: 25vh;
  background: url(../assets/welcome/title.png) no-repeat center;
  background-size: contain;
}

.signIn {
  width: 40vw;
  height: 15vh;
  background: url(../assets/welcome/signIn.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}

.inquery {
  width: 40vw;
  height: 15vh;
  background: url(../assets/welcome/inquery.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
