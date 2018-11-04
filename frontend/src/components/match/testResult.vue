<template>
  <div class="testResult">
    <div class="title">经测试，</div>
    <div class="title">你最适合看的电影类型为</div>
    <div class="result">{{result}}</div>
    <div class="inMatch" @click="match()"></div>
    <div>
      <span>结果不对？</span><router-link to="/match/type">直接更换类型</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'testResult',
  data() {
    return {
      answerList: [
        { id: 1, content: this.global.answer.user[0] },
        { id: 2, content: this.global.answer.user[1] },
        { id: 3, content: this.global.answer.user[2] },
        { id: 4, content: this.global.answer.user[3] },
        { id: 5, content: this.global.answer.user[4] },
        { id: 6, content: this.global.answer.user[5] },
        { id: 7, content: this.global.answer.user[6] },
        { id: 8, content: this.global.answer.user[7] },
        { id: 9, content: this.global.answer.user[8] },
        { id: 10, content: this.global.answer.user[9] },
        { id: 11, content: this.global.answer.user[10] },
      ],
      cartoon: 0,
      terrify: 0,
      scienceFiction: 0,
      romantic: 0,
      feature: 0,
      result: '',
    };
  },
  mounted() {
    this.count();
  },
  methods: {
    count() {
      switch (this.global.answer.user[0]) {
        case 'A':
          this.feature += 1;
          break;
        case 'B':
          this.scienceFiction += 1;
          break;
        case 'C':
          this.romantic += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.cartoon += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[1]) {
        case 'A':
          this.scienceFiction += 1;
          break;
        case 'B':
          this.feature += 1;
          break;
        case 'C':
          this.cartoon += 1;
          break;
        case 'D':
          this.romantic += 1;
          break;
        case 'E':
          this.terrify += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[2]) {
        case 'A':
          this.romantic += 1;
          break;
        case 'B':
          this.feature += 1;
          break;
        case 'C':
          this.cartoon += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.scienceFiction += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[3]) {
        case 'A':
          this.cartoon += 1;
          break;
        case 'B':
          this.romantic += 1;
          break;
        case 'C':
          this.terrify += 1;
          break;
        case 'D':
          this.feature += 1;
          break;
        case 'E':
          this.scienceFiction += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[4]) {
        case 'A':
          this.romantic += 1;
          break;
        case 'B':
          this.cartoon += 1;
          break;
        case 'C':
          this.terrify += 1;
          break;
        case 'D':
          this.feature += 1;
          break;
        case 'E':
          this.scienceFiction += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[5]) {
        case 'A':
          this.romantic += 1;
          break;
        case 'B':
          this.feature += 1;
          break;
        case 'C':
          this.cartoon += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.scienceFiction += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[6]) {
        case 'A':
          this.feature += 1;
          break;
        case 'B':
          this.romantic += 1;
          break;
        case 'C':
          this.scienceFiction += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.cartoon += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[7]) {
        case 'A':
          this.cartoon += 1;
          break;
        case 'B':
          this.romantic += 1;
          break;
        case 'C':
          this.scienceFiction += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.feature += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[8]) {
        case 'A':
          this.cartoon += 1;
          break;
        case 'B':
          this.romantic += 1;
          break;
        case 'C':
          this.feature += 1;
          break;
        case 'D':
          this.scienceFiction += 1;
          break;
        case 'E':
          this.terrify += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[9]) {
        case 'A':
          this.scienceFiction += 1;
          break;
        case 'B':
          this.romantic += 1;
          break;
        case 'C':
          this.feature += 1;
          break;
        case 'D':
          this.terrify += 1;
          break;
        case 'E':
          this.cartoon += 1;
          break;
        default:
          break;
      }
      switch (this.global.answer.user[10]) {
        case 'A':
          this.cartoon += 1;
          break;
        case 'B':
          this.scienceFiction += 1;
          break;
        case 'C':
          this.feature += 1;
          break;
        case 'D':
          this.romantic += 1;
          break;
        case 'E':
          this.terrify += 1;
          break;
        default:
          break;
      }
      const compare = [this.cartoon, this.terrify,
        this.scienceFiction, this.romantic, this.feature];
      const max = [this.cartoon, 0];
      for (let i = 1; i <= 5; i += 1) {
        if (max[0] < compare[i]) {
          max[0] = compare[i];
          max[1] = i;
        }
      }
      this.global.signIn.movie = max[1];
      switch (max[1]) {
        case 0:
          this.result = '动画片';
          this.global.signIn.movie = 0;
          break;
        case 1:
          this.result = '恐怖片';
          this.global.signIn.movie = 1;
          break;
        case 2:
          this.result = '科幻动作片';
          this.global.signIn.movie = 2;
          break;
        case 3:
          this.result = '爱情片';
          this.global.signIn.movie = 3;
          break;
        case 4:
          this.result = '剧情片';
          this.global.signIn.movie = 4;
          break;
        default:
          break;
      }
    },
    type() {
      this.$router.push({ name: 'type' });
    },
    match() {
      this.$router.push({ name: 'draw' });
    },
  },
};
</script>

<style scoped>
.title:nth-child(1) {
  padding-top: 10vh;
}

.title {
  text-align: start;
  padding-top: 2vh;
  font-size: 1.2em;
  padding-left: 15vw;
  width: 85vw;
  display: flex;
}

.result {
  padding: 8vh 0;
  font-size: 1.7em;
}

.inMatch {
  width: 40vw;
  height: 15vh;
  background: url(../../assets/match/inMatch.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
