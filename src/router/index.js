import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const ListAreas = () => import('@/views/pages/areas/ListAreas');
const AddEditArea = () => import('@/views/pages/areas/AddEditArea');

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
      name: 'container',
      component: TheContainer,
      children: [
        {
          path: 'areas',
          name: 'listAreas',
          component: ListAreas,
        },
        {
          path: 'areas/addEdit',
          name: 'addEditArea',
          component: AddEditArea
        }
      ]
    }
  ]
}

