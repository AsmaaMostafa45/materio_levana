import Vue from 'vue'
import store from '../store/index'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    redirect: '/pages/login',
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/dashboard/Dashboard.vue'),
  },
  // {
  //   path: '/typography',
  //   name: 'typography',
  //   component: () => import('@/views/typography/Typography.vue'),
  // },
  {
    path: '/icons',
    name: 'icons',
    component: () => import('@/views/icons/Icons.vue'),
  },
  {
    path: '/iconstest',
    name: 'iconstest',
    component: () => import('@/views/icons/Iconstest.vue'),
  },
  {
    
    path: '/cards',
    name: 'cards',
    component: () => import('@/views/cards/Card.vue'),
  },
  {
    path: '/simple-table',
    name: 'simple-table',
    component: () => import('@/views/simple-table/SimpleTable.vue'),
  },
  {
    path: '/form-layouts',
    name: 'form-layouts',
    component: () => import('@/views/form-layouts/FormLayouts.vue'),
  },
  {
    path: '/pages/account-settings',
    name: 'pages-account-settings',
    component: () => import('@/views/pages/account-settings/AccountSettings.vue'),
  },
  {
    path: '/pages/login',
    name: 'pages-login',
    component: () => import('@/views/pages/Login.vue'),
    // meta: {
    //   layout: 'blank',
    //   auth: true,
    //   authRequired: true,

    // },
    meta: { 
   
      layout: 'blank',
    },
  },
  {
    path: '/pages/register',
    name: 'pages-register',
    component: () => import('@/views/pages/Register.vue'),
    meta: {
      layout: 'blank',
    },
    // meta: { 
    //   requiresAuth: true,
    //   layout: 'blank',
    // },
  },
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/Error.vue'),
    meta: {
      layout: 'blank',
    },
  },
  {
    path: '/tasks_projects',
    name: 'tasks_projects',
    component: () => import('@/views/TasksAndProjects/Tasks_projects.vue'),
   
  },
  {
      path: '/crm',
      name: 'crm',
      component: () => import('@/views/crm/components/Crm.vue'),
   

  },
  {
    path: '/crm_deals',
    name: 'deals',
    component: () => import('@/views/crm/Deals.vue'),
   

},
{
  path: '/crm_customers',
  name: 'customers',
  component: () => import('@/views/crm/Customers.vue'),
 

},
{
  path: '/crm_analytics',
  name: 'analytics',
  component: () => import('@/views/crm/Analytics.vue'),
 

},
{
  path: '/company',
  name: 'company',
  component: () => import('@/views/company/components/Company.vue'),


},
{
  path: '/company_structure',
  name: 'company_structure',
  component: () => import('@/views/company/CompanyStructure.vue'),


},
{
  path: '/company_employees',
  name: 'company_employees',
  component: () => import('@/views/company/Employees.vue'),


},
{
  path: '/Chats_calls',
  name: 'Chats_calls',
  component: () => import('@/views/Chats_calls/ChatsCalls.vue'),
  

},
  {
    path: '*',
    redirect: 'error-404',
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router




// router.beforeEach((to, from, next) => {
//   if (!to.meta.authRequired) {
//       next();
//   } else if (store.getters["user/isAuthenticated"]) {
//       next();
//   } else {
//       next({
//           path: "/crm_customers"
//       });
//   }
// });