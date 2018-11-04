<template>
  <div class="type">
    <div class="title">选择你喜欢的类型：</div>
    <div class="options">
      <div>
        <label><input type="radio" value="0" v-model="picked">动画片</label>
        <span :class="[select1 ? 'selected' : 'notSelect']" class="underLine"></span>
      </div>
      <div>
        <label><input type="radio" value="1" v-model="picked">恐怖片</label>
        <span :class="[select2 ? 'selected' : 'notSelect']" class="underLine"></span>
      </div>
      <div>
        <label><input type="radio" value="2" v-model="picked">科幻动作片</label>
        <span :class="[select3 ? 'selected' : 'notSelect']" class="underLine"></span>
      </div>
      <div>
        <label><input type="radio" value="3" v-model="picked">爱情片</label>
        <span :class="[select4 ? 'selected' : 'notSelect']" class="underLine"></span>
      </div>
      <div>
        <label><input type="radio" value="4" v-model="picked">剧情片</label>
        <span :class="[select5 ? 'selected' : 'notSelect']" class="underLine"></span>
      </div>
    </div>
    <div class="next" v-if="isSelect" @click="handleSubmit"></div>
    <div>{{errMsg}}</div>
  </div>
</template>

<script>
export default {
  name: 'type',
  data() {
    return {
      isSelect: false,
      select1: false,
      select2: false,
      select3: false,
      select4: false,
      select5: false,
      picked: '',
      errMsg: '',
    };
  },
  methods: {
    handleSubmit() {
      this.global.signIn.movie = this.picked;
      if (this.$route.meta.status === 0) {
        this.$router.push({ name: 'draw' });
      } else if (this.$route.meta.status === 2) {
        this.axios.post('api/second', {
          movie: this.global.signIn.movie,
        }).then((response) => {
          const data = response.data;
          if (data.errno === 0) {
            this.$router.push({ name: 'success', params: { date: '11月15日' } });
          } else {
            this.errMsg = data.errmsg;
          }
        });
      } else {
        this.errMsg = '本次活动已结束';
      }
    },
  },
  watch: {
    picked(value) {
      this.global.signIn.movie = this.picked;
      if (value) {
        this.isSelect = true;
      }
      switch (value) {
        case '0':
          this.select1 = true;
          this.select2 = false;
          this.select3 = false;
          this.select4 = false;
          this.select5 = false;
          break;
        case '1':
          this.select2 = true;
          this.select1 = false;
          this.select3 = false;
          this.select4 = false;
          this.select5 = false;
          break;
        case '2':
          this.select3 = true;
          this.select2 = false;
          this.select1 = false;
          this.select4 = false;
          this.select5 = false;
          break;
        case '3':
          this.select4 = true;
          this.select2 = false;
          this.select3 = false;
          this.select1 = false;
          this.select5 = false;
          break;
        case '4':
          this.select5 = true;
          this.select2 = false;
          this.select3 = false;
          this.select4 = false;
          this.select1 = false;
          break;
        default:
          break;
      }
    },
  },
};
</script>

<style scoped>
.type {
  height: 100vh;
  width: 100vw;
  background: url(../../assets/background2.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.title {
  font-size: 2em;
  letter-spacing: 0.15em;
  padding: 10vh 15vw 6vh 15vw;
  width: 70vw;
  display: flex;
  font-family: 'special';
}

input {
  display: none;
}

.options {
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
}

label {
  font-size: 1.2em;
  position: absolute;
  left: 0;
  right: 0;
  margin: 0 auto;
  z-index: 20;
}

.underLine {
  width: 40vw;
  height: 10vh;
  background: url(../../assets/match/underLine.png) no-repeat center;
  background-size: contain;
  display: -webkit-inline-box;
  position: relative;
  bottom: 0.3em;
  z-index: 1;
}

.selected {
  opacity: 1;
}

.notSelect {
  opacity: 0.1;
}

.next {
  width: 45vw;
  height: 15vh;
  background: url(../../assets/match/inMatch.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
