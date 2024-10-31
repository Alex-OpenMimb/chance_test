<template>
    <div class="container flex justify-center ">
        <div class="mt-[100px] ">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Alumnos</h1>
                <div class="text-red-500" > {{ errorAuht }} </div>

                <div class="">
                    <select v-model="filterGrade"
                    @change="onGradeChange"
                    name="" id="" class="mb-2 bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    <option value="">Todos los Grados</option>
                    <option   v-for="(grade, index) in grades" :key="index" :value="grade.id" >
                                {{ grade.grade }}
                            </option>
                    </select>
                  
                </div>

               
            </div>
            <button @click="openform" type="button" class="  bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Crear
                </button>
            <table class="w-full relative mt-4" x-data="">
                <thead class="border-b border-neutral-200 dark:border-neutral-700">
                    <tr class="group">
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Nombre</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Fecha de Nacimiento</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Nombre del padre</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Nombre de la madre</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Grado</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Sección</th>
                        <th class="px-2 text-left text-black bg-neutral-50 dark:text-white dark:bg-neutral-800">Fecha de ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id" class="group" wire:key="">
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.name }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.born_date }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.father_name }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.mother_name }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.grade }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.section }}</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">{{ student.date_entry }}</td>
                    
                    </tr>
                </tbody>
                <tfoot class="border-t border-neutral-200 dark:border-neutral-700">
                    <tr class="group"></tr>
                </tfoot>
            </table>
        </div>      
    </div>
</template>

<script>
import { ref,reactive, computed, onMounted,watch } from 'vue';
import { useStore  } from 'vuex'
import { useRouter } from "vue-router"

export default {
    setup() {
        //Data
        const store = useStore()
        const router = useRouter()
        const errorAuht = ref('')
        const filterGrade = ref('')
        const grades = computed(() => store.getters.grades)
        const students = computed(() => store.getters.students)
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

            store.dispatch('fetchStudents').then(()=>{
              
            }).catch((error)=>{
                if( error.response.statusText === 'Unauthorized' ){
                    errorAuht.value = 'La sesión se ha terminado.'
                    setTimeout(()=>{
                     router.push({name:'login'})
                    },4000)
                    
                }
                
            })

            store.dispatch('fetchGrades')

        })

        const openform = () => {
            router.push({name:'form'})
        };

        const onGradeChange = () => {
            store.dispatch('filterByGrade', filterGrade.value).then(()=>{
                store.dispatch('fetchGrades')
                console.log( students.value )
            
            })
        };


        return {
            form,
            errorAuht,
            students,
            grades,
            openform,
            filterGrade,
            onGradeChange
            
           
        };
    }
};

</script>
