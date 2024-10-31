import { createStore } from 'vuex'
import axios from 'axios';
import { useRouter } from "vue-router"

const api = axios.create({
    baseURL: 'http://127.0.0.1:8000'
 });


const store = createStore({
    state:{
        token : localStorage.getItem('token') || '',
   
    },
    mutations:{

        UPDATE_TOKEN(state,payload){
            state.token = payload
        },
       
     
    },
    actions:{
    
        setToken(context,payload){
            localStorage.setItem('token',payload)
            context.commit('UPDATE_TOKEN',payload)
        },
        removeToken(context){
            localStorage.removeItem('token');
            context.commit('UPDATE_TOKEN', 0);
        },

        fetchStudents({commit, state}){
            const token = state.token;
            return new Promise((resolve, reject) => {
                api.get(`api/alumnos`,{
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                }).then( response =>{
                        console.log(response)
                        resolve(response)
                }).catch(error => {
                
                    reject(error) 
                }) 
                
            })




          
        },
    },

    getters:{
  
    }


  });

export default store;