<template>
    <h1 class="text-2xl font-semibold mb-4">Registro</h1>
    <form action="#" method="POST">
      <!-- Username Input -->
      <div class="mb-4">
        <label for="name" class="block text-gray-600">Nombre</label>
        <input
          type="text"
          id="name"
          name="name"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>
  
      <!-- Username Input -->
      <div class="mb-4">
        <label for="username" class="block text-gray-600">Email</label>
        <input
          type="email"
          id="username"
          name="username"
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
          autocomplete="off"
        />
      </div>
      <!-- Password Input -->
      <div class="mb-4">
        <label for="password" class="block text-gray-600">Contraseña</label>
        <input
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
    <!-- Sign up  Link -->
    <div class="mt-6 text-blue-500 text-center">
      <RouterLink :to="{ name: 'login' }" class="hover:underline">Login</RouterLink>
    </div>
  </template>

  <script>

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

        const errors = ref('')

        //Methods
        const register = async ()=>{

            await axios.post('api/register',form)
                .then(res =>{
                    store.dispatch('setToken',res.data.authorisation.token);
                    router.push({name:'alumnos'})
                    console.log(res)
                }).catch(e =>{
                    console.log(e.response.data.errors)
                    errors.value = e.response.data.errors
                })

        }


        return{
            form,
            register,
            errors
        }
    }
    
  }
  </script>
  