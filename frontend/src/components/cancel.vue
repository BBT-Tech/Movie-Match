<template>
  <div class="cancel">
    <div class="title">取消配对</div>
    <div class="main"><span>你的密码是：</span><span>{{reciveWard}}</span></div>
    <div class="main">
      <input type="text" placeholder="收到的密码" v-model="password">
    </div>
    <div class="tips">如主动取消，请把你的密码告知对方</div>
    <div class="tips">如对方取消，请输入收到的密码</div>
    <div class="next" @click="handleSubmit()"></div>
    <div>{{errMsg}}</div>
  </div>
</template>

<script>
export default {
  name: 'cancel',
  data() {
    return {
      password: '',
      reciveWard: this.global.self.psw,
      errMsg: '',
    };
  },
  methods: {
    handleSubmit() {
      this.axios.post('api/cancel', {
        psw: this.password,
      }).then((response) => {
        const data = JSON.parse(response);
        if (data.errno === 0) {
          this.$router.push({ name: 'second' });
        } else {
          this.errMsg = data.errmsg;
        }
      });
    },
  },
};
</script>

<style scoped>
.cancel {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background2.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.title {
  font-size: 1.7em;
  padding: 10vh 0 5vh 20vw;
  width: 85vw;
  display: flex;
  font-family: 'special';
  letter-spacing: 0.2em;
}

.main {
  padding: 1vh 0 1vh 20vw;
  width: 85vw;
  display: flex;
}

.tips {
  padding: 0 0 0.5vh 20vw;
  width: 85vw;
  display: flex;
  font-size: 0.7em;
}

input {
  background: #ccc8d2;
  border: 1px solid #ccc8d2;
  border-radius: 3px;
  font-size: 1em;
  padding: 5px;
  width: 55vw;
}

.next {
  padding-top: 40vh;
  width: 45vw;
  height: 15vh;
  background: url(../assets/inquery/cancel.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
