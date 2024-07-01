import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/js/views/auth/layouts/LayoutLogin.vue'),
    meta: { requiresAuth: false, redirectIfAuthenticated: true },
    children: [
      {
        path: '',
        component: () => import('@/js/views/auth/Login.vue'),
      },
      {
        path: 'login',
        name: 'login',
        component: () => import('@/js/views/auth/Login.vue'),
      },
      {
        path: 'register',
        name: 'register',
        component: () => import('@/js/views/auth/Register.vue'),
      },
    ],
  },
  {
    path: '/',
    component: () =>
      import('@/js/views/dashboard/layouts/LayoutDashboard.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@/js/views/dashboard/Dashboard.vue'),
      },
      {
        path: 'categories',
        name: 'categories.index',
        component: () => import('@/js/views/categories/Index.vue'),
      },
      {
        path: 'categories/create',
        name: 'categories.create',
        component: () => import('@/js/views/categories/Create.vue'),
      },
      {
        path: 'categories/:id/edit',
        name: 'categories.edit',
        component: () => import('@/js/views/categories/Create.vue'),
      },
      {
        path: 'products',
        name: 'products.index',
        component: () => import('@/js/views/products/Index.vue'),
      },
      {
        path: 'products/create',
        name: 'products.create',
        component: () => import('@/js/views/products/Create.vue'),
      },
      {
        path: 'products/:id/edit',
        name: 'products.edit',
        component: () => import('@/js/views/products/Create.vue'),
      },
      {
        path: 'banners',
        name: 'banners.index',
        component: () => import('@/js/views/banners/Index.vue'),
      },
      {
        path: 'banners/create',
        name: 'banners.create',
        component: () => import('@/js/views/banners/Create.vue'),
      },
      {
        path: 'banners/:id/edit',
        name: 'banners.edit',
        component: () => import('@/js/views/banners/Create.vue'),
      },
    ],
  },
  // {
  //     path: "/:catchAll(.*)",
  //     component: () => import("@/js/views/errors/404.vue"),
  // },
]

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: 'active',
  routes,
})

export default router
