window.Vue = require('vue');

window.VUE_EVENT = new class {
  constructor() {
    this.vue = new Vue();
  }

  dispatch(event, data = null) {
    this.vue.$emit(event, data);
  }

  listen(event, callback) {
    this.vue.$on(event, callback);
  }

  destroy(event, callback) {
    this.vue.$off(event, callback);
  }
};