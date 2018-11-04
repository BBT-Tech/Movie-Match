<template>
  <div class="question">
    <div class="title">{{questionNow.question}}</div>
    <div class="option">
      <label>
        <input @click="handleSubmit($event)" type="radio" value="A"><span>{{questionNow.A}}</span>
      </label>
    </div>
    <div class="option">
      <label>
        <input @click="handleSubmit($event)" type="radio" value="B"><span>{{questionNow.B}}</span>
      </label>
    </div>
    <div class="option">
      <label>
        <input @click="handleSubmit($event)" type="radio" value="C"><span>{{questionNow.C}}</span>
      </label>
    </div>
    <div class="option">
      <label>
        <input @click="handleSubmit($event)" type="radio" value="D"><span>{{questionNow.D}}</span>
      </label>
    </div>
    <div class="option">
      <label>
        <input @click="handleSubmit($event)" type="radio" value="E"><span>{{questionNow.E}}</span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'question',
  props: ['questionNow'],
  data() {
    return {
      present: '',
      question: '',
      A: '',
      B: '',
      C: '',
      D: '',
      E: '',
    };
  },
  methods: {
    handleSubmit(e) {
      this.global.answer.user.push(e.toElement.value);
      const next = this.questionNow.id + 1;
      if (next < 12) {
        this.$router.push({ name: `question${next}` });
      } else {
        this.$router.push({ name: 'testResult' });
      }
    },
  },
};
</script>

<style scoped>
.question {
  font-family: 'Microsoft YaHei';
  font-size: 1em;
  text-align: start;
}

.title {
  width: 70vw;
  padding: 0 15vw 5vh 15vw;
  display: flex;
  text-align: start;
}

.option {
  display: flex;
  padding-left: 12vw;
}

input {
  margin: 3.5vh 0;
  opacity: 0;
}
</style>
