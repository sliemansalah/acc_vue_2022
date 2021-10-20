import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const Areas = () => import('@/views/pages/Areas');

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes () {
  return [
    {
      path: '/',
      redirect: '/areas',
      name: 'الرئيسية',
      component: TheContainer,
      children: [
        {
          path: 'areas',
          name: 'المناطق',
          component: Areas
        },
      ]
    }
  ]
}

