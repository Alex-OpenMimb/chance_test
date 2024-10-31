<template>
    <h1 class="text-2xl font-semibold mb-4">Login</h1>
    <form @submit.prevent="login" action="" method="">
      <!-- Email Input -->
      <div class="mb-4">
        <label for="email" class="block text-gray-600">Email</label>
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
        <label for="password" class="block text-gray-600">Contraseña</label>
        <input
        v-model="form.password"
          type="password"
          id="password"
          name="password"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>
  
      <button
       type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
      >
        Login
      </button>
    </form>
    <p class="text-red-500 mt-4">{{ error }} *</p>
    <!-- Sign up  Link -->
    <div class="mt-6 text-blue-500 text-center">
      <RouterLink :to="{ name: 'register' }" class="hover:underline">Registrarse</RouterLink>
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
  
          const form = reactive({
              email: '',
              password: ''
          });
  
          let error = ref('');

           //Config axios
        const api = axios.create({
               baseURL: 'http://127.0.0.1:8000'
         });
          const login = async ()=>{
              try {
                  await api.post('api/login',form)
                      .then(res =>{
                          store.dispatch('setToken',res.data.authorisation.token);
                          router.push({name:'students'})
                          console.log(res)
                      });
  
              } catch (err) {
               
                  error.value = err.response.data.message;
                  console.log(error)
  
              }
  
          }
  
          return {
              form,
              login,
              error,
  
          }
  
      }
  
  }
  </script>
  