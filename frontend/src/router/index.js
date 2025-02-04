import { createRouter, createWebHistory } from 'vue-router'
import product from '../components/product.vue'

const router = createRouter({
    history: createWebHistory('/'),
    routes: [
      {
        path: '/product',
        name: 'product',
        component: product
      }
    ]
})

export default router;
