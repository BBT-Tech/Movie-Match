<template>
  <div class="draw">
    <div class="title">请在左边画出一半爱心</div>
    <div class="canvas">
      <canvas class="drawArea" id="drawArea"
      @touchstart="drawStart($event)"
      @touchmove="drawing($event)"
      @touchend="drawEnd"></canvas>
      <div class="right"></div>
    </div>
    <div class="tips">{{tips}}</div>
    <div v-if="!flag">
      <div class="done" @click="done"></div>
      <div class="restart" @click="restart"></div>
    </div>
  </div>
</template>

<script>
let draw;
class Draw {
  constructor() {
    this.canvas = document.getElementById('drawArea');
    this.context = this.canvas.getContext('2d');
    this.borderbox = this.canvas.getBoundingClientRect();
    this.path = {
      beginX: 0,
      beginY: 0,
      endX: 0,
      endY: 0,
    };
  }
}
export default {
  name: 'draw',
  data() {
    return {
      flag: true,
      tips: '',
      allPoints: [],
      point: {
        pEndTop: {
          x: null,
          y: null,
        },
        pEndTopAdj: {
          x: null,
          y: null,
        },
        pTop: {
          x: null,
          y: null,
        },
        pLeft: {
          x: null,
          y: null,
        },
        pEndBottomAdj: {
          x: null,
          y: null,
        },
        pEndBottom: {
          x: null,
          y: null,
        },
      },
    };
  },
  mounted() {
    draw = new Draw();
    draw.canvas.width = 120;
    draw.canvas.height = 240;
  },
  methods: {
    drawStart(e) {
      e.preventDefault();
      draw.context.strokeStyle = '#f1eff5';
      draw.context.lineWidth = 3;
      draw.context.beginPath();
      draw.context.lineCap = 'round';
      draw.context.lineJoin = 'round';
      this.tips = '';
    },
    drawing(e) {
      e.preventDefault();
      if (this.flag === true) {
        // 记录最左端和最上端的点
        const pointNow = {
          x: e.changedTouches[0].clientX - draw.borderbox.left,
          y: e.changedTouches[0].clientY - draw.borderbox.top,
        };
        this.point.pTop = pointNow.y <= this.point.pTop.y ? pointNow : this.point.pTop;
        this.point.pLeft = pointNow.x <= this.point.pLeft.x ? pointNow : this.point.pLeft;
        this.allPoints.push({ x: pointNow.x, y: pointNow.y }); // 记录第所有点
        draw.context.lineTo(pointNow.x, pointNow.y);
        draw.path.endX = pointNow.x;
        draw.path.endY = pointNow.y;
        draw.context.stroke();
        if (pointNow.x > 120 || pointNow.y > 240 || pointNow.x < 0 || pointNow.y < 0) {
          this.drawEnd();
        }
      } else {
        this.tips = '只能画一笔哦';
      }
    },
    drawEnd() {
      draw.context.save();
      draw.context.closePath();
      const pointsLength = this.allPoints.length;
      // 判断上下终止点后给其余点赋值
      if (this.flag === true) {
        if (this.allPoints[0].y < this.allPoints[pointsLength - 1].y) {
          this.point.pEndTop.x = this.allPoints[0].x;
          this.point.pEndTop.y = this.allPoints[0].y;
          this.point.pEndTopAdj.x = this.allPoints[1].x;
          this.point.pEndTopAdj.y = this.allPoints[1].y;
          this.point.pEndBottom.x = this.allPoints[pointsLength - 2].x;
          this.point.pEndBottom.y = this.allPoints[pointsLength - 2].y;
          this.point.pEndBottomAdj.x = this.allPoints[pointsLength - 3].x;
          this.point.pEndBottomAdj.y = this.allPoints[pointsLength - 3].y;
        } else {
          this.point.pEndTop.x = this.allPoints[pointsLength - 2].x;
          this.point.pEndTop.y = this.allPoints[pointsLength - 2].y;
          this.point.pEndTopAdj.x = this.allPoints[pointsLength - 3].x;
          this.point.pEndTopAdj.y = this.allPoints[pointsLength - 3].y;
          this.point.pEndBottom.x = this.allPoints[0].x;
          this.point.pEndBottom.y = this.allPoints[0].y;
          this.point.pEndBottomAdj.x = this.allPoints[1].x;
          this.point.pEndBottomAdj.y = this.allPoints[1].y;
        }
        this.global.signIn.points = [];
        this.global.signIn.points = {
          t_top: Math.atan((this.point.pEndTopAdj.y - this.point.pEndTop.y) /
            (this.point.pEndTopAdj.x - this.point.pEndTop.x)),
          t_bottom: Math.atan((this.point.pEndBottomAdj.y - this.point.pEndBottom.y) /
            (this.point.pEndBottomAdj.x - this.point.pEndBottom.x)),
          h_end_top: this.point.pEndBottom.y - this.point.pEndTop.y,
          p_top: {
            x: (this.point.pTop.x - this.point.pEndBottom.x) /
              (this.point.pEndBottom.y - this.point.pEndTop.y),
            y: (this.point.pTop.y - this.point.pEndBottom.y) /
              (this.point.pEndBottom.y - this.point.pEndTop.y),
          },
          p_right: {
            x: (this.point.pLeft.x - this.point.pEndBottom.x) /
              (this.point.pEndBottom.y - this.point.pEndTop.y),
            y: (this.point.pLeft.y - this.point.pEndBottom.y) /
              (this.point.pEndBottom.y - this.point.pEndTop.y),
          },
        };
      }
      this.flag = false;
    },
    done() {
      const imgData = draw.canvas.toDataURL('image/png');
      this.global.signIn.imgdata = imgData;
      this.axios.post('api/register',
        this.global.signIn).then((response) => {
        const reciveData = response.data;
        if (reciveData.errno === 0) {
          this.$route.meta.reg = true;
          this.$router.push({ name: 'success', params: { date: '11月9日' } });
        } else {
          this.tips = reciveData.errmsg;
        }
      });
    },
    restart() {
      draw.context.clearRect(0, 0, 120, 240);
      this.flag = true;
      this.allPoints = [];
    },
  },
};
</script>

<style scoped>
.title {
  font-size: 1.5em;
  padding: 8vh 0 2vh 15vw;
  width: 70vw;
  display: flex;
}

.canvas {
  width: 240px;
  height: 240px;
  margin: 0 auto;
  border: 1px solid #9b9b9b;
  border-radius: 10px;
  display: flex;
}

.right {
  width: 40vw;
  border-left: 1px solid #9b9b9b;
}

.done, .restart {
  position: relative;
  top: 8vh;
}

.tips {
  height: 2vh;
  font-size: 2vh;
}

.done {
  width: 40vw;
  height: 12vh;
  background: url(../../assets/match/done.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}

.restart {
  width: 40vw;
  height: 12vh;
  background: url(../../assets/match/restart.png) no-repeat center;
  background-size: contain;
  margin: 0 auto;
}
</style>
