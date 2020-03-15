import axiosClient from "../../config/axios";
import tokenAuth from "../../config/token";
const state ={
    //variable active user info
    user : null,
    //variable used to store jwt token
    token : '',
    //boolean used to know if a session is started
    admin : ''
};

const getters ={
    getUser : state => state.user,
    getToken : state => state.token,
    checkAdmin : state => state.admin,
}

const actions ={
     async login({commit},credentials){
        try{
            //logs in, gets jwt token in return
            let tokenResponse = await axiosClient.post('api/login',credentials);
            commit('setToken',tokenResponse.data.token);
            //uses that token to get the user's info
            let userResponse = await axiosClient.get('api/user');
            commit('setUser',userResponse.data);
            //marks admins boolean as true to indicate that the session has been started
            commit('enableAdmin');
        }catch(error){
            commit('setMessage',error.response)
        }
    },
    async quickLogin({commit}){
        try{
            //looks for jwt token in local storage
            commit('setToken',localStorage.getItem('token'));
            //try's to fetch the user's info with it
            let userResponse = await axiosClient.get('api/user');
            commit('setUser',userResponse.data);
            //if nothing goes wrong,marks admins boolean as true to indicate that the session has been started
            commit('enableAdmin');
        }catch(error){
            commit('disableAdmin');
            commit('setMessage',error.response)
        }
    },
    async logout({commit}){
         try{
             //logs out from server
             let response = await axiosClient.get('api/logout');
             //resets all variables
             commit('disableAdmin');
             commit('setUser',null);
             commit('setToken','');
             localStorage.removeItem('token');
         }catch (e) {

         }
    },
    enableAdmin({commit}){
         commit('enableAdmin');
    }
};

const mutations ={
    setToken : (state,token) => {

        localStorage.setItem('token',token);
        state.token = token;
        tokenAuth(state.token);
    },
    setMessage : (state,message) => state.message=message,
    setUser : (state,user ) => state.user = user,
    enableAdmin : state => state.admin = true,
    disableAdmin : state => state.admin =false,
}

export default {
    state,
    getters,
    actions,
    mutations
}
