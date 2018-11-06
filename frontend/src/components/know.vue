<template>
  <div class="know">
    <div class="title">了解一下Ta</div>
    <div class="result">
      <span>姓名：{{name}}</span>
    </div>
    <div class="result">
      <span>年龄：{{age}}</span>
    </div>
    <div class="result">
      <span>学校：{{college}}</span>
    </div>
    <div class="result">
      <span>学院：{{school}}</span>
    </div>
    <div class="result">
      <span>年级：{{grade}}</span>
    </div>
    <div class="result">
      <span>手机：{{phone}}</span>
    </div>
    <div
      v-if="wechatNumber !== null"
      class="result"
      v-clipboard:copy="wechatNumber"
    >
      <span>微信号(点击复制)：</span><button class="copy"
        v-clipboard:copy="wechatNumber"
        v-clipboard:success="onCopy"
        v-clipboard:error="onError"
      >{{wechatNumber}}</button>
    </div>
    <div class="back" @click="back()"></div>
    <div class="response">{{response}}</div>
  </div>
</template>

<script>

export default {
  name: 'know',
  data() {
    return {
      name: this.global.inqueryMsg.ta.name,
      age: this.global.inqueryMsg.ta.age,
      school: this.global.inqueryMsg.ta.school,
      college: this.global.inqueryMsg.ta.college,
      grade: this.global.inqueryMsg.ta.grade,
      phone: this.global.inqueryMsg.ta.tel,
      wechatNumber: this.global.inqueryMsg.ta.wechat,
      response: '',
    };
  },
  methods: {
    back() {
      this.$router.history.go(-1);
    },
    onCopy() {
      this.response = '复制成功！';
    },
    onError(e) {
      this.response = e;
    },
  },
};
</script>

<style scoped>
.know {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background3.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.title {
  font-size: 1.7em;
  padding: 10vh 0 5vh 15vw;
  width: 85vw;
  display: flex;
  font-family: 'special';
  letter-spacing: 0.2em;
}

.result {
  display: flex;
  margin-left: 15vw;
  margin-bottom: 3.5vh;
}

.copy {
  border: none;
  background: transparent;
  padding: 0;
  font-size: 1em;
  color: #fefdfb;
  max-width: 30vw;
  overflow-x: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.back {
  width: 40vw;
  height: 15vh;
  background: url(../assets/back.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
