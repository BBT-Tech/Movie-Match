<template>
  <div id="app">
  <transition name="fade" mode="out-in">
    <router-view/>
  </transition>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
html, body {
  margin: 0;
  padding: 0;
}

body {
  background: #443457;
}

@font-face {
  font-family: 'special';
  src: url('./assets/font/special.ttf');
  font-weight: normal;
  font-style: normal;
}

#app {
  text-align: center;
}

a {
  color: #fefdfb;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
