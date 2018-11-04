<template>
  <div class="config">
    <div class="title">你希望匹配到的是</div>
    <div id="sex">
      <div class="pick">
        <label>
          <span :class="[!isSelect ? activeClass : errorClass]"></span>
          <input type="radio" value="男生" v-model="picked">
          <span>男生</span>
        </label>
        <label>
          <span :class="[isSelect ? activeClass : errorClass]"></span>
          <input type="radio" value="女生" v-model="picked">
          <span>女生</span>
        </label>
      </div>
    </div>
    <div class="test" @click="test()"></div>
    <div class="refuse">
      <span>不了，</span>
      <router-link to="/match/type">直接选择电影类型</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'config',
  data() {
    return {
      picked: '男生',
      isSelect: false,
      activeClass: 'selected',
      errorClass: 'notSelected',
    };
  },
  mounted() {
    this.global.signIn.tagender = 0;
  },
  methods: {
    test() {
      this.$router.push({ path: '/match/test' });
    },
  },
  watch: {
    picked(value) {
      this.isSelect = !this.isSelect;
      if (value === '男生') {
        this.global.signIn.tagender = 0;
      } else {
        this.global.signIn.tagender = 1;
      }
    },
  },
};
</script>

<style scoped>
input {
  opacity: 0;
}

.title {
  font-size: 1.2em;
  padding: 12vh 0 5vh 20vw;
  width: 85vw;
  display: flex;
}

.pick {
  font-size: 1.2em;
  display: flex;
  padding: 0 0 12vh 15vw;
}

.test {
  width: 45vw;
  height: 15vh;
  background: url(../../assets/match/inTest.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}

.selected {
  background: url(../../assets/match/selected.png) no-repeat center;
  background-size: contain;
  display: -webkit-inline-box;
}

.notSelected {
  background: url(../../assets/match/notSelected.png) no-repeat center;
  background-size: contain;
  display: -webkit-inline-box;
}

.selected, .notSelected {
  width: 20px;
  height: 20px;
  position: relative;
  left: 1.5em;
  top: 2px;
}
</style>
