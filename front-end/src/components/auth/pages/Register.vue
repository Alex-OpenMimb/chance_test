<template>
    <h1 class="text-2xl font-semibold mb-4">Registro</h1>
    <form @submit.prevent="register" action="" method="">
      <!-- Username Input -->
      <div class="mb-4">
        <label for="name" class="block text-gray-600">Nombre*</label>
        <input
         v-model="form.name"
          type="text"
          id="name"
          name="name"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>
  
      <!-- email Input -->
      <div class="mb-4">
        <label for="email" class="block text-gray-600">Email*</label>
        <input
        v-model="form.email"
          type="email"
          id="email"
          name="email"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>
      <!-- Password Input -->
      <div class="mb-4">
        <label for="password" class="block text-gray-600">Contraseña*</label>
        <input
        v-model="form.password"
          type="password"
          id="password"
          name="password"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>    
      <!-- Login Button -->
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
      >
        Guardar
      </button>
    </form>
       <div class="mt-4">
        <p class="text-red-500 text-sm " v-for="error in errors" :key="error">
                    <span v-for="err in error" :key="err">{{ err }}</span>
                </p>
       </div>
    <!-- Sign up  Link -->
    <div class="mt-6 text-blue-500 text-center">
      <RouterLink :to="{ name: 'login' }" class="hover:underline">Login</RouterLink>
    </div>
  </template>

  <script>
import axios from 'axios';
import { reactive,ref } from 'vue'
import { useRouter } from "vue-router"
import { useStore } from 'vuex'

  export default {
    setup(){
        const router = useRouter()
        const store = useStore()
       //Data
        const form = reactive({
            name: '',
            email: '',
            password: ''
        });

        let errors = ref('')
        //Config axios
        const api = axios.create({
               baseURL: 'http://127.0.0.1:8000'
         });

        //Methods
        const register = async ()=>{
              try{
                await api.post('api/register',form)
                .then(res =>{
                  store.dispatch('setToken',res.data.authorisation.token);
                  router.push({name:'students'})
                    console.log(res)
                })
              }catch(err){
                console.log(err)
                
                    errors.value = err.response.data.errors
              }
        }


        return{
            form,
            register,
            errors
        }
    }
    
  }
  </script>
  