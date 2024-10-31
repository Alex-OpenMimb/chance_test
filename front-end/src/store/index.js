import { createStore } from 'vuex'
import axios from 'axios';
import { useRouter } from "vue-router"

const api = axios.create({
    baseURL: 'http://127.0.0.1:8000'
 });


const store = createStore({
    state:{
        token : localStorage.getItem('token') || 0,
        students : [],
        grades : [],
        error: null,
         
   
    },
    mutations:{

        UPDATE_TOKEN(state,payload){
            state.token = payload
        },
        SET_STUDENTS(state, payload){
            state.students = payload
        },
        SET_GRADES(state, payload){
            state.grades = payload
        },
        SET_ERROR( state, message ){
            state.error = message
        },
        CLEAR_ERROR(state) {
            state.error = null
          }
       
     
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
                    
                        let data = response.data.data
                     
                        commit('SET_STUDENTS',data)
                        resolve(response)
                }).catch(error => {
                
                    reject(error) 
                }) 
                
            }) 
        },

        fetchGrades({commit, state}){
            const token = state.token;
            return new Promise((resolve, reject) => {
                api.get(`api/grades`,{
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                }).then( response =>{
                        let data = response.data.data

                        commit('SET_GRADES',data)
                        resolve(response)
                }).catch(error => {
                    reject(error) 
                }) 
                
            }) 
        },
        storeStudent({commit,state}, data){
            const token = state.token;
            return new Promise((resolve, reject) => {
                api.post(`api/crear-alumno`,data,{
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                }).then( response =>{
                    let message = response.data.message
    
                        if( !response.data.response ) {
                            commit('SET_ERROR',message);
                        }else{
                            commit('SET_ERROR',null);
                            resolve(response)
                        }
                        resolve(response)
                }).catch(error => {
                    reject(error) 
                }) 
                
            })
        },

        filterByGrade({commit,state}, idGrade){
            const token = state.token;
            return new Promise((resolve, reject) => {
                api.get(`api/consultar-alumno/${idGrade}`,{
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                }).then( response =>{
                    let data = response.data.data
                    console.log(data)
                     commit('SET_GRADES',data)
                        resolve(response)
                }).catch(error => {
                    reject(error) 
                }) 
                
            })
        },
        clearError({commit}){
            commit('CLEAR_ERROR');
        }
    },

    getters:{
        token: state => state.token,
        students: state=> state.students,
        grades: state=> state.grades,
        error: state => state.error
    }


  });

export default store;