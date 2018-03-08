import appConfig from './services/appConfig';
//import Vuex from 'vuex';

require('materialize-css');

window.Vue = require('vue');
//window.Vue.use(Vuex);

require('vue-resource');
require('vuex');

Vue.http.options.root = appConfig.api_url;

require('./filters');
require('./validators');
require('./services/interceptors');
require('./router');

//console.log(appConfig.login_url);

//LocalStorage.set('nome', 'Eduardo Mattos');
//LocalStorage.setObject('user', { name: 'Eduardo Mattos', id: 2 });
//console.log(LocalStorage.getObject('user'));

