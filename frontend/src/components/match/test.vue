<template>
  <div class="test">
    <div class="count">
      <span>{{present}}</span><span> / 11</span>
    </div>
    <transition name="fade" mode="out-in">
      <router-view v-bind:questionNow="questionNow"></router-view>
    </transition>
  </div>
</template>

<script>
const question = require('./question.vue');

export default {
  components: {
    question,
  },
  name: 'test',
  data() {
    return {
      present: 1,
      questionNow: '',
      questionList: [
        {
          id: 1,
          question: '如果可以实现你一个愿望你会选择？',
          A: 'A.有花不完的钱',
          B: 'B.有一项超能力',
          C: 'C.可以和喜欢的人在一起',
          D: 'D.有像福尔摩斯一样的智商',
          E: 'E.生活在二次元',
        },
        {
          id: 2,
          question: '有一天，你突然收到一封来自远方的匿名信，第一想法是什么？',
          A: 'A.外星来信',
          B: 'B.多年未见的朋友',
          C: 'C.哆啦A梦的邀请信',
          D: 'D.喜欢的人的信',
          E: 'E.恐吓信',
        },
        {
          id: 3,
          question: '你最想从事以下哪种职业？',
          A: 'A.婚礼设计师',
          B: 'B.小说家',
          C: 'C.漫画家',
          D: 'D.侦探',
          E: 'E.运动员',
        },
        {
          id: 4,
          question: '森林最深处有一座建筑，你觉得最可能是？',
          A: 'A.美丽的城堡',
          B: 'B.古老的教堂',
          C: 'C.阴森的鬼屋',
          D: 'D.神秘的树屋',
          E: 'E.武林大师的隐居处',
        },
        {
          id: 5,
          question: '请问如果明天是世界末日，今天你想怎么过？',
          A: 'A.和你喜欢的人一起',
          B: 'B.熬夜看完最后一部番',
          C: 'C.安乐死',
          D: 'D.拜神，等待奇迹会发生',
          E: 'E.思考逃生方案',
        },
        {
          id: 6,
          question: '如果学校爆发了丧尸潮，你会',
          A: 'A.等待命定之爱来救你',
          B: 'B.和伙伴策划逃出学校，并寻找解药',
          C: 'C.在学校建立幸存者基地',
          D: 'D.等到弹尽粮绝，不得不走出了房间',
          E: 'E.搜寻物资，集结小队，杀出学校',
        },
        {
          id: 7,
          question: '某天你起床后发现宿舍里空无一人，于是你冲出宿舍，在学校在市区里发了疯地寻找，却仍是不见半个人的踪影。终于，在你绝望到崩溃的时候，你的面前出现了一扇古朴的门，推开门，你看见了',
          A: 'A.创造了这个世界的神',
          B: 'B.你仰慕多年暗恋已久的异性',
          C: 'C.一群正在做空间与次元实验的科学家',
          D: 'D.一个浑身是血，面目狰狞的人',
          E: 'E.哆啦A梦',
        },
        {
          id: 8,
          question: '如果你从楼梯上摔下，你觉得下面是',
          A: 'A.飞毯',
          B: 'B.帅哥/美女',
          C: 'C.弹簧垫',
          D: 'D.教导主任',
          E: 'E.空无一物',
        },
        {
          id: 9,
          question: '一个植物人如何唤醒',
          A: 'A.求助哆啦A梦',
          B: 'B.亲吻',
          C: 'C.闪电',
          D: 'D.进入他的精神世界',
          E: 'E.做法',
        },
        {
          id: 10,
          question: '你收到一个礼盒，你觉得里面是',
          A: 'A.炸弹',
          B: 'B.水晶球',
          C: 'C.照片',
          D: 'D.骨头',
          E: 'E.手办',
        },
        {
          id: 11,
          question: '觉得什么会使你力大无穷',
          A: 'A.黄金矿工的药水',
          B: 'B.被不明虫子咬了',
          C: 'C.受到他人的欺侮',
          D: 'D.暗恋对象受到委屈',
          E: 'E.被人袭击',
        },
      ],
    };
  },
  methods: {
    init() {
      this.global.answer.user = [];
      const now = this.present - 1;
      this.questionNow = this.questionList[now];
    },
  },
  mounted() {
    this.init();
  },
  watch: {
    $route(params) {
      const i = params.name.split('question');
      this.present = i[1];
      const now = this.present - 1;
      this.questionNow = this.questionList[now];
    },
  },
};
</script>

<style scoped>
.count {
  font-family: 'special';
  text-align: end;
  padding: 5vh 10vw 5vh 0;
  font-size: 1.5em;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
