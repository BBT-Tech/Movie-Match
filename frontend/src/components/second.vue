<template>
  <div class="second">
    <div class="title">是否参加二次匹配？</div>
    <div class="agree" @click="agree"></div>
    <div class="refuse" @click="refuse"></div>
  </div>
</template>

<script>
export default {
  name: 'second',
  methods: {
    agree() {
      this.$router.push({ name: 'type' });
    },
    refuse() {
      this.$router.push({ name: 'end' });
    },
  },
};
</script>

<style scoped>
.second {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background4.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
}

.title {
  font-size: 1.7em;
  padding: 17vh 0;
  font-family: 'special';
  letter-spacing: 0.2em;
}

.agree {
  width: 45vw;
  height: 15vh;
  background: url(../assets/inquery/agree.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}

.refuse {
  width: 45vw;
  height: 15vh;
  background: url(../assets/inquery/refuse.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
