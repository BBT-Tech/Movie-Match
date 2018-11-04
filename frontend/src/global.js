const signIn = {
  gender: null,
  name: null,
  age: null,
  grade: null,
  college: null,
  school: null,
  tel: null,
  wechat: null,
  movie: null,
  tagender: null,
  points: null,
  imgdata: null,
};

const answer = {
  user: [],
  feature: 0,
  scienceFiction: 0,
  romantic: 0,
  suspense: 0,
  cartoon: 0,
};

const userStatus = {
  status: 0,
  login: false,
  reg: false,
};

export default {
  signIn,
  answer,
  userStatus,
  inqueryMsg: null,
};
