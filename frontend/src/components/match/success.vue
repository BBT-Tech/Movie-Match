<template>
  <div class="success">
    <div class="msg">配对结果将在{{$route.params.date}}公布，<br>请自行查询喔，<br>期待11.17雕刻盛典见到你～</div>
    <!--div>//报名资料{{global.signIn}}</div-->
  </div>
</template>

<script>
export default {
  name: 'success',
};
</script>

<style scoped>
.msg {
  width: 70vw;
  padding: 30vh 15vw 5vh 15vw;
  display: flex;
  text-align: start;
  line-height: 2.5em;
  font-size: 1.2em;
}
</style>
