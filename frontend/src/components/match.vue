<template>
  <div class="match">
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'match',
  data() {
    return {
      picked: '',
    };
  },
  beforeRouteEnter(to, from, next) {
    if (to.name === 'type' && to.meta.status === 2) {
      next();
    } else if (to.meta.reg) {
      next({
        name: 'prevent',
        replace: 'true',
      });
    } else if (to.meta.status > 0) {
      next({
        name: 'welcome',
        replace: 'true',
      });
    } else if (!to.meta.filled) {
      next({
        name: 'signIn',
        replace: 'true',
      });
    } else {
      next();
    }
  },
  methods: {
    // handleSubmit() {
    //   this.$router.push('draw');
    // },
  },
};
</script>

<style scoped>
.match {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background2.png) no-repeat bottom;
  background-size: cover;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

button {
  margin: 1vh 0;
}
</style>
