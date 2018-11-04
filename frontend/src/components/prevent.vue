<template>
  <div class="end">
    <div class="msg">你已经报过名啦<br>不要这么花心~</div>
  </div>
</template>

<script>
export default {
  name: 'prevent',
  beforeRouteEnter(to, from, next) {
    if (to.meta.reg) {
      next();
    } else {
      next({
        name: 'welcome',
        replace: true,
      });
    }
  },
};
</script>

<style scoped>
.end {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background4.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
}

.msg {
  font-size: 1.2em;
  padding-top: 40vh;
  line-height: 2em;
}
</style>
