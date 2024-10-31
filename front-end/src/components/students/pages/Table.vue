<template>
    <div>
        <div class="mt-[100px]">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Alumnos</h1>
                <div class="text-red-500" > {{ errorAuht }} </div>
                <button @click="openModal" type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Crear
                </button>
            </div>
              
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
                    <tr class="group" wire:key="">
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Andres</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Grado</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Cauarot</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Cauarot</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Cauarot</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Cauarot</td>
                        <td class="px-2 bg-neutral-100 group-odd:bg-white group-hover:bg-neutral-200 dark:bg-neutral-800 dark:group-odd:bg-neutral-900 dark:group-hover:bg-neutral-700">Cauarot</td>
                    </tr>
                </tbody>
                <tfoot class="border-t border-neutral-200 dark:border-neutral-700">
                    <tr class="group"></tr>
                </tfoot>
            </table>
        </div>

        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                <h2 class="text-2xl font-bold mb-4">Crear Nuevo Alumno</h2>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre:</label>
                    <input type="text" v-model="newStudent.name" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Fecha de Nacimiento:</label>
                    <input type="date" v-model="newStudent.birthdate" class="w-full px-4 py-2 border rounded-lg">
                </div>
        
            
                <div class="flex justify-end space-x-2">
                    <button @click="closeModal" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cancelar</button>
                    <button @click="createStudent" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Guardar</button>
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
        const isModalOpen = ref(false)
        const errorAuht = ref('')
        const newStudent = reactive({
            name: '',
            birthdate: '',
       
        });
    

        onMounted(() => {
            store.dispatch('fetchStudents').then(()=>{
                
            }).catch((err)=>{
                if( err.response.statusText === 'Unauthorized' ){
                    errorAuht.value = 'La sesión se ha terminado.'
                    setTimeout(()=>{
                     router.push({name:'login'})
                    },4000)
                    
                }
                
            })
    
        })




        const openModal = () => {
            isModalOpen.value = true;
        };
        const closeModal = () => {
            isModalOpen.value = false;
        };
        const createStudent = () => {
            console.log('Nuevo estudiante:', newStudent.value);

            isModalOpen.value = false;
            newStudent.value = { name: '', birthdate: '' };
        };

        return {
            isModalOpen,
            newStudent,
            errorAuht,
            openModal,
            closeModal,
            createStudent
        };
    }
};

</script>
