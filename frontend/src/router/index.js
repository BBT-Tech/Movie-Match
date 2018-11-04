import Vue from 'vue';
import Router from 'vue-router';
import welcome from '@/components/welcome';
import prevent from '@/components/prevent';
import signIn from '@/components/signIn';
import match from '@/components/match';
import sexMatch from '@/components/match/sexMatch';
import test from '@/components/match/test';
import type from '@/components/match/type';
import draw from '@/components/match/draw';
import question from '@/components/match/question';
import testResult from '@/components/match/testResult';
import success from '@/components/match/success';
import inquery from '@/components/inquery';
import know from '@/components/know';
import cancel from '@/components/cancel';
import second from '@/components/second';
import end from '@/components/end';

Vue.use(Router);

const meta = {
  status: 0,
  login: false,
  reg: false,
  filled: false,
};

export default new Router({
  routes: [
    {
      path: '/',
      name: 'welcome',
      component: welcome,
      meta,
    },
    {
      path: '/signIn',
      name: 'signIn',
      component: signIn,
      meta,
    },
    {
      path: '/prevent',
      name: 'prevent',
      component: prevent,
      meta,
    },
    {
      path: '/match',
      component: match,
      children: [
        {
          path: '/',
          name: 'sexMatch',
          component: sexMatch,
          meta,
        },
        {
          path: 'test',
          component: test,
          meta,
          children: [
            {
              path: '/',
              name: 'question1',
              component: question,
              meta,
            },
            {
              path: 'question2',
              name: 'question2',
              component: question,
              meta,
            },
            {
              path: 'question3',
              name: 'question3',
              component: question,
              meta,
            },
            {
              path: 'question4',
              name: 'question4',
              component: question,
              meta,
            },
            {
              path: 'question5',
              name: 'question5',
              component: question,
              meta,
            },
            {
              path: 'question6',
              name: 'question6',
              component: question,
              meta,
            },
            {
              path: 'question7',
              name: 'question7',
              component: question,
              meta,
            },
            {
              path: 'question8',
              name: 'question8',
              component: question,
              meta,
            },
            {
              path: 'question9',
              name: 'question9',
              component: question,
              meta,
            },
            {
              path: 'question10',
              name: 'question10',
              component: question,
              meta,
            },
            {
              path: 'question11',
              name: 'question11',
              component: question,
              meta,
            },
          ],
        },
        {
          path: 'testResult',
          name: 'testResult',
          component: testResult,
          meta,
        },
        {
          path: 'type',
          name: 'type',
          component: type,
          meta,
        },
        {
          path: 'draw',
          name: 'draw',
          component: draw,
          meta,
        },
        {
          path: '/success',
          name: 'success',
          component: success,
          meta,
        },
      ],
    },
    {
      path: '/inquery',
      name: 'inquery',
      component: inquery,
      meta,
    },
    {
      path: '/know',
      name: 'know',
      component: know,
      meta,
    },
    {
      path: '/cancel',
      name: 'cancel',
      component: cancel,
      meta,
    },
    {
      path: '/second',
      name: 'second',
      component: second,
      meta,
    },
    {
      path: '/end',
      name: 'end',
      component: end,
      meta,
    },
  ],
});
