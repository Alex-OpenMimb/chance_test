import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';
import NotFound404 from '@/components/common/pages/NotFound404.vue';


export const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes:[
        //Studendt
        {
            path: '/',
            name: 'alumnos',
            component: () => import('@/components/students/layouts/StudentsLayout.vue'),
            children: [
                { 
                    path: '/',
                    name: 'home',
                    component: () => import('@/components/students/pages/Home.vue'),
                  },
              { 
                path: '/alumnos',
                name: 'students',
                component: () => import('@/components/students/pages/Table.vue'),
              },

            ],
        },


        // Auth
        {
            path: '/',
            redirect: { name: 'login' }, //'/login',
            component: () => import('@/components/auth/layouts/AuthLayout.vue'),
            children: [
              {
                path: 'login',
                name: 'login',
                component: () => import('@/components/auth/pages/Login.vue'),
              },
              {
                path: 'register',
                name: 'register',
                component: () => import('@/components/auth/pages/Register.vue'),
              },
            ],
          },

            // Not Found
     {
        path: '/:pathMatch(.*)*',
        // redirect: '/',
        component: NotFound404,
      },



    ]
})

export default router;