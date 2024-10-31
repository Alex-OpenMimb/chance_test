import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';
import NotFound404 from '@/components/common/pages/NotFound404.vue';

 export const   routes = [
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
                    meta: {
                      requiresAuth:true
                  }
                  },

              { 
                path: '/alumnos',
                name: 'students',
                component: () => import('@/components/students/pages/Table.vue'),
                meta: {
                  requiresAuth:true
              }
              },
              { 
                path: '/alumnos/create',
                name: 'form',
                component: () => import('@/components/students/pages/Form.vue'),
                meta: {
                  requiresAuth:true
              }
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
                meta: {
                  requiresAuth:false
              }
              },
              {
                path: 'register',
                name: 'register',
                component: () => import('@/components/auth/pages/Register.vue'),
                meta: {
                  requiresAuth:false
              }
              },
            ],
          },

            // Not Found
     {
        path: '/:pathMatch(.*)*',
        component: NotFound404,
      },



    ]
  

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to,from) =>{
  if(to.meta.requiresAuth && !localStorage.getItem('token') ){
      return {name: 'login'}
  }

})

export default router;