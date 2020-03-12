import Vuex from 'vuex';
import Vue from 'vue';
import CartState from './modules/CartState';

//Load vuex

Vue.use(Vuex);


export default new Vuex.Store({
    modules : {
        CartState
    }
});
