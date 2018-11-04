<template>
  <div class="complete">
    <div class="title">报名表</div>
    <div class="input-item">
      <span>姓名</span>
      <input placeholder="请输入" type="text" maxlength="20" v-model="studentName">
    </div>
    <div :class="errName ? 'error' : 'correct'">请输入姓名</div>
    <div class="input-item">
      <span>性别</span>&nbsp;
      <select class="special" v-model="sex">
        <option value>请选择</option>
        <option value="0">男</option>
        <option value="1">女</option>
      </select>
    </div>
    <div :class="errSex ? 'error' : 'correct'">请选择性别</div>
    <div class="input-item">
      <span>年龄</span>
      <input placeholder="请输入" type="text" maxlength="2" v-model="age">
    </div>
    <div :class="errAge ? 'error' : 'correct'">请输入年龄</div>
    <div class="input-item">
      <span>手机</span>
      <input placeholder="请输入" type="text" maxlength="11" v-model="phoneNumber">
    </div>
    <div :class="errPhone ? 'error' : 'correct'">请输入正确的电话号码</div>
    <div class="input-item">
      <span>学校</span>
      <select v-model="school">
        <option value>请选择</option>
        <option value="0">华南理工大学</option>
        <option value="1">广东药科大学</option>
        <option value="2">广东工业大学</option>
        <option value="3">广州中医药大学</option>
        <option value="4">广东外语外贸大学</option>
        <option value="5">广州美术学院</option>
        <option value="6">华南师范大学</option>
        <option value="7">星海音乐学院</option>
        <option value="8">中山大学</option>
        <option value="9">广州大学</option>
      </select>
    </div>
    <div :class="errSchool ? 'error' : 'correct'">请选择学校</div>
    <div class="input-item">
      <span>学院</span>
      <input placeholder="请输入" type="text" maxlength="24" v-model="college">
    </div>
    <div :class="errCollege ? 'error' : 'correct'">请输入学院</div>
    <div class="input-item">
      <span>年级</span>
      <select v-model="grade">
        <option value>请选择</option>
        <option value="1">大一</option>
        <option value="2">大二</option>
        <option value="3">大三</option>
        <option value="4">大四或以上</option>
        <option value="5">研一</option>
        <option value="6">研二</option>
        <option value="7">研三</option>
      </select>
    </div>
    <div :class="errGrade ? 'error' : 'correct'">请选择年级</div>
    <div class="input-item">
      <span>微信（选填）</span>
      <input placeholder="请输入" type="text" maxlength="24" v-model="wechatID">
    </div>
    <div class="next" @click="handleSubmit()"></div>
  </div>
</template>

<script>
export default {
  name: 'complete',
  data() {
    return {
      studentName: '',
      sex: '',
      age: '',
      phoneNumber: '',
      school: '',
      college: '',
      grade: '',
      wechatID: '',
      errName: true,
      errSex: true,
      errAge: true,
      errPhone: true,
      errSchool: true,
      errCollege: true,
      errGrade: true,
    };
  },
  methods: {
    handleSubmit() {
      // this.axios.post('/url', {
      //   tel: this.phoneNumber,
      // }).then(function success() {
      this.$router.push({ name: 'config' });
      // }).catch((error) => {
      //   this.errorMsg = error;
      // });
    },
    // watch: {
    //   studentName(value) {
    //     if (value !== '') {
    //       this.errName = false;
    //     }
    //   },
    //   sex(value) {
    //     if (value !== '') {
    //       this.errSex = false;
    //     }
    //   },
    //   age(value) {
    //     if (value !== '') {
    //       this.errAge = false;
    //     }
    //   },
    //   phoneNumber(value) {
    //     if (value !== '') {
    //       this.errPhone = false;
    //     }
    //   },
    //   school(value) {
    //     if (value !== '') {
    //       this.errSchool = false;
    //     }
    //   },
    //   college(value) {
    //     if (value !== '') {
    //       this.errCollege = false;
    //     }
    //   },
    //   grade(value) {
    //     if (value !== '') {
    //       this.errGrade = false;
    //     }
    //   },
    // },
  },
};
</script>

<style scoped>
.complete {
  height: 100vh;
  width: 100vw;
  background: url(../assets/background3.png) no-repeat bottom;
  background-size: 100% 100%;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.title {
  font-size: 1.7em;
  font-family: 'special';
  letter-spacing: 0.2em;
  padding: 10vh 0 5vh 15vw;
  width: 85vw;
  display: flex;
}

.input-item {
  padding: 1vh 0 1vh 15vw;
  width: 85vw;
  display: flex;
}

.special {
  padding-left: 1vw;
}

input, select {
  padding-left: 2vw;
  border: none;
  background: transparent;
  color: #80798b;
  -webkit-appearance: none;
  -moz-appearance: none;
  position: relative;
  top: 2px;
}

.error {
  height: 1vh;
  font-size: 1vh;
  color: #c53448;
  display: flex;
  padding-left: 15vw;
  position: relative;
  bottom: 1.1vh;
}

.correct {
  opacity: 0;
  height: 1vh;
  font-size: 1vh;
}

.next {
  width: 40vw;
  height: 15vh;
  background: url(../assets/complete/next.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
