<template>
  <div class="inquery">
    <div class="text">
      <span>你喜欢的电影类型是：</span><span>{{movie}}</span>
      <div>{{response}}</div>
    </div>
    <div class="matchImg">
      <div class="leftImg">
        <img src="api/image/self" alt="">
      </div>
      <div class="rightImg">
        <img src="api/image/ta" alt="">
      </div>
    </div>
    <div>
      <div class="know" v-if="matched" @click="know"></div>
      <router-link v-if="matched" to="/cancel">取消配对</router-link>
    </div>
    <div v-if="!matched" class="fail">
      <span v-if="matching">匹配中!</span>
      <div class="second" v-if="!matching" @click="second"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'inquery',
  data() {
    return {
      status: 0,
      movie: '',
      response: '',
      matched: false,
      matching: true,
    };
  },
  mounted() {
    this.init();
  },
  methods: {
    init() {
      this.movie = [
        '动画片', '恐怖片', '科幻动作片', '爱情片', '剧情片',
      ][this.global.inqueryMsg.self.movie];
      this.status = this.global.inqueryMsg.status;
    },
    know() {
      this.$router.push({ name: 'know' });
    },
    second() {
      this.$router.push({ name: 'second' });
    },
  },
  watch: {
    status(value) {
      switch (value) {
        case 0:
          this.response = '配对成功！你们的爱心轨迹是：';
          this.matched = true;
          this.matching = false;
          break;
        case 1:
          this.response = '匹配失败！';
          this.matched = false;
          this.matching = false;
          break;
        case 2:
          this.response = '你的爱心轨迹是：';
          this.matched = false;
          this.matching = true;
          break;
        default:
          break;
      }
    },
  },
};
</script>

<style scoped>

.inquery {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background2.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

a {
  color: #fefdfb;
}

.text {
  text-align: left;
  padding: 10vh 0 2vh 15vw;
}

.text div {
  padding-top: 2vh
}

.matchImg {
  width: 240px;
  height: 240px;
  margin: 0 auto;
  border: 1px solid #9b9b9b;
  border-radius: 10px;
  display: flex;
}

.leftImg, .rightImg {
  width: 120px;
  height: 240px;
}

.rightImg {
  transform: rotateY(180deg);
}

.leftImg {
  border-right: 1px solid #9b9b9b;
}

.fail {
  padding-top: 6vh;
}

.second {
  width: 40vw;
  height: 15vh;
  background: url(../assets/inquery/second.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}

.know {
  padding-top: 4vh;
  width: 40vw;
  height: 15vh;
  background: url(../assets/inquery/know.png) no-repeat bottom;
  background-size: contain;
  margin: 0 auto;
}
</style>
