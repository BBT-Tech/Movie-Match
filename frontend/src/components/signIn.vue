<template>
  <div class="signIn">
    <div class="background-fix"></div>
    <div class="title">报名表</div>
    <div class="input-item">
      <span>姓名</span>
      <input placeholder="请输入" type="text" maxlength="25" v-model="studentName">
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
      <select v-model="college">
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
    <div :class="errCollege ? 'error' : 'correct'">请选择学校</div>
    <div class="input-item">
      <span>学院</span>
      <input placeholder="请输入" type="text" maxlength="40" v-model="school">
    </div>
    <div :class="errSchool ? 'error' : 'correct'">请输入学院</div>
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
      <span>微信</span>
      <input placeholder="选填" type="text" maxlength="24" v-model="wechatID">
    </div>
    <div :class="errWechatID ? 'error' : 'correct'">请检查微信号是否正确</div>
    <div class="next" @click="handleSubmit()"></div>
  </div>
</template>

<script>
export default {
  name: 'signIn',
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
      errName: false,
      errSex: false,
      errAge: false,
      errPhone: false,
      errSchool: false,
      errCollege: false,
      errGrade: false,
      errWechatID: false,
    };
  },
  beforeRouteEnter(to, from, next) {
    if (to.meta.reg) {
      next({
        name: 'prevent',
        replace: true,
      });
    } else {
      next();
    }
  },
  methods: {
    handleSubmit() {
      // 判断报名信息是否正确
      if (this.studentName === '') this.errName = true;
      if (this.sex === '') this.errSex = true;
      if (this.age === '' || !(/^\d{1,2}$/.test(this.age)) || this.age <= 0 || this.age > 200) {
        this.errAge = true;
      }
      if (this.phoneNumber === '' || !(/^1\d{10}$/.test(this.phoneNumber))) {
        this.errPhone = true;
      }
      if (this.college === '' || this.college > 40) this.errCollege = true;
      if (this.school === '') this.errSchool = true;
      if (this.grade === '') this.errGrade = true;
      this.errWechatID = !(/^[a-z][\w-]{5,19}$/i.test(this.wechatID));
      if (/^\s*$/.test(this.wechatID)) {
        this.wechatID = '';
        this.errWechatID = false;
      }
      // 把报名信息存入全局变量
      this.global.signIn.gender = this.sex;
      this.global.signIn.name = this.studentName;
      this.global.signIn.age = this.age;
      this.global.signIn.grade = this.grade;
      this.global.signIn.college = this.college;
      this.global.signIn.school = this.school;
      this.global.signIn.tel = this.phoneNumber;
      this.global.signIn.wechat = this.wechatID;
      // 判断跳转
      if (!(this.errAge || this.errPhone || this.errSchool || this.errCollege ||
        this.errGrade || this.errName || this.errSex || this.errWechatID) && (this.sex !== '' ||
          this.studentName !== '' || this.age !== '' || this.grade !== '' ||
            this.college !== '' || this.school !== '' || this.phoneNumber !== '')) {
        this.$route.meta.filled = true;
        this.$router.push({ path: 'match' });
      }
    },
  },
  watch: {
    studentName() {
      this.errName = false;
    },
    sex() {
      this.errSex = false;
    },
    age() {
      this.errAge = false;
    },
    school() {
      this.errSchool = false;
    },
    college() {
      this.errCollege = false;
    },
    grade() {
      this.errGrade = false;
    },
    phoneNumber() {
      this.errPhone = false;
    },
  },
};
</script>

<style scoped>
.signIn {
  position: absolute;
  width: 100%;
  color: #fefdfb;
  font-family: 'Microsoft YaHei';
}

.background-fix {
  position: fixed;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url(../assets/background3.png) no-repeat top;
  background-size: cover;
}

.title {
  font-size: 1.7em;
  font-family: 'special';
  letter-spacing: 0.2em;
  padding: 16vw 0 8vw 15vw;
  width: 85vw;
  display: flex;
}

.input-item {
  padding: 2vw 0 2vw 15vw;
  width: 85vw;
  display: flex;
  font-size: 1.1em;
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
  font-size: 1em;
}

select {
  transform: translateY(-2px);
}

input::-webkit-input-placeholder {
  color: #80798b;
  font-size: 1em;
}

.error {
  height: 2vw;
  font-size: 0.8em;
  color: #c53448;
  display: flex;
  padding-left: 15vw;
  position: relative;
  bottom: 2vw;
}

.correct {
  opacity: 0;
  height: 2vw;
  font-size: 2vw;
}

.next {
  width: 40vw;
  height: 30vw;
  background: url(../assets/signIn/next.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
