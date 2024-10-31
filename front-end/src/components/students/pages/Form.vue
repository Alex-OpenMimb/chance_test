<template >
    <div class="flex flex-col" > 
        <button @click="backTable" type="button" class="ml-[820px] mt-2 w-[100px]  bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Volver
                </button>  
                
         <div>
            <div class="container flex justify-center ">
                <form @submit.prevent="createStudent"  class=" rounded-lg ">
                <h2 class="text-2xl font-bold mb-4">Crear Nuevo Alumno</h2>
                
                <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="name" class="block c-text-blue font-bold mb-2">Nombre*:</label>
                        <input   v-model="form.name"     type="text" id="" name="name" class="bg-gray-300  focus:outline-none  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  mb-2">

                    
                    </div>
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="" class="block c-text-blue font-bold mb-2">Nombre el padre*:</label>
                        <input   v-model="form.father_name"   type="text" id="" name="" class="bg-gray-300 focus:outline-none  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  mb-2">

                    
                    </div>
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0 ">
                        <label for="phone" class="block c-text-blue font-bold mb-2">Nombre de la madre:</label>
                        <input   v-model="form.mother_name"   type="text" id="" name="phone" class="focus:outline-none bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  mb-2">

                
                    </div>
                </div>
                <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="name" class="block c-text-blue font-bold mb-2">Fecha de Nacimiento*:</label>
                        <input   v-model="form.born_date"    type="date" id="" name="name" class="bg-gray-300  focus:outline-none  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  mb-2">

                    
                    </div>
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="" class="block c-text-blue font-bold mb-2">Fecha de ingreso*:</label>
                        <input   v-model="form.date_entry"    type="date" id="" name="" class="bg-gray-300 focus:outline-none  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  mb-2">
 
                    </div>
                   
                </div>

                <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="name" class="block c-text-blue font-bold mb-2">Grado*:</label>
                        <select  v-model="form.grade_id"  id="" name="roleId" class="mb-2 bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option   v-for="(grade, index) in grades" :key="index" :value="grade.id" >
                                {{ grade.grade }}
                            </option>

                        </select>
                    
                    </div>
                    <div class="md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
                        <label for="" class="block c-text-blue font-bold mb-2">seccion*:</label>
                        <select  v-model="form.section"  id="" name="" class="mb-2 bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Diurna">Diurna</option>
                            <option value="Nocturna">Nocturna</option>
                            <option value="Sabatina">Sabatina</option>
                        </select>
            
                    </div>
                   
                </div>
            
                <div class="flex justify-end space-x-2">
                    
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Guardar</button>
                </div>
        
            </form>

            <div v-if="errors && errors.length" class="error-messages">
                            <ul>
                                <li class="text-red-500"v-for="(error, index) in errors" :key="index">{{ error }}</li>
                            </ul>
                        </div>
            </div>
         </div>       
      
    
    </div>

</template>
<script>
import { ref,reactive, computed, onMounted } from 'vue';
import { useStore  } from 'vuex'
import { useRouter } from "vue-router"

export default {
    setup() {
        //Data
        const store = useStore()
        const router = useRouter()
        const errorAuht = ref('')
        const grades = computed(() => store.getters.grades)
        const errors = computed(() => store.getters.error)
        const form = reactive({
            name: '',
            born_date: '',
            father_name: '',
            mother_name : '',
            section : '',
            date_entry : '',
            grade_id : '',

        });
    

        onMounted(() => {

            store.dispatch('fetchGrades').then(()=>{
                console.log('successfully')
            }).catch((error)=>{
                if( error.response.statusText === 'Unauthorized' ){
                    errorAuht.value = 'La sesión se ha terminado.'
                    setTimeout(()=>{
                     router.push({name:'login'})
                    },4000)
                    
                }
                
            })

          
    
        })

        const createStudent = () =>{
           store.dispatch('storeStudent',form).then((response)=>{
            if( response.data.response ){
                   store.dispatch('fetchStudents')
                   router.push({name:'students'})
               }
             
           }).catch(( error )=>{
            console.log(error)
           })
        };

        const backTable = ()=>{
            store.dispatch('clearError')
            router.push({name:'students'})
        }

       
        return {
            form,
            errorAuht,
            grades,
            errors,
            createStudent,
            backTable
           
        };
    }
};

</script>