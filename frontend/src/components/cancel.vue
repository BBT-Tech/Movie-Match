<template>
  <div class="cancel">
    <div class="background-fix"></div>
    <div class="title">取消配对</div>
    <div class="main"><span>你的密码是：{{reciveWard}}</span></div>
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
      reciveWard: this.global.inqueryMsg.self.psw,
      errMsg: '',
    };
  },
  methods: {
    handleSubmit() {
      this.axios.post('api/cancel', {
        psw: this.password,
      }).then((response) => {
        const data = response.data;
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
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.background-fix {
  position: fixed;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url(../assets/background3.png) no-repeat top;
  background-size: cover;
}

.title {
  font-size: 1.7em;
  padding: 17vw 0 10vw 20vw;
  width: 80vw;
  display: flex;
  font-family: 'special';
  letter-spacing: 0.2em;
}

.main {
  padding: 2vw 0 2vw 20vw;
  width: 80vw;
  display: flex;
  font-size: 1.1em;
}

.tips {
  padding: 0 0 0.5vw 20vw;
  width: 80vw;
  display: flex;
  font-size: 0.8em;
}

input {
  color: #80798b;
  background: #ccc8d2;
  border: 1px solid #ccc8d2;
  border-radius: 3px;
  font-size: 1.1em;
  padding: 5px;
  width: 55vw;
}

.next {
  width: 45vw;
  height: 80vw;
  background: url(../assets/inquery/cancel.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
