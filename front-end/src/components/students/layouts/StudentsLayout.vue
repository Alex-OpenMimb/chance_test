<template>
    <div class="flex flex-col h-screen">
      <!-- Header -->
      <header class="bg-blue-500 flex items-center h-14 px-4 border-b border-gray-300 sm:h-16 md:px-6 lg:px-8">
        <nav class="flex  ml-auto space-x-4 items-end h-10 sm:space-x-6">
         
          <div class="space-x-4">
            <button  v-if="(!token)" type="button" @click="login" class="bg-green-500 hover:bg-gren-600 text-white font-bold py-2 px-4 rounded">Login</button>
            <button  v-if="(token)" type="button" @click="logout" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Logout</button>
          </div>
        </nav>
      </header>
      <!-- End Header -->
      <!-- Main -->
      <main class="  ">
        <router-view ></router-view>

        <!-- <RouterView /> -->
      </main>
      <!-- ENd Main -->

    </div>
  </template>

<script>
import { useRouter } from "vue-router"
import { useStore } from 'vuex'
import { computed, onMounted, ref } from 'vue'
export default {
    setup() {

        const router = useRouter();
        const store = useStore();
        const token = computed(() => store.getters.token);
      

        function logout(){
            store.dispatch('removeToken');
            router.push({name:'login'})
        }

        function login(){
          router.push({name:'login'})
        }


        return {
            logout,
            login,
            token,
         

        }

    }
}
</script>
  