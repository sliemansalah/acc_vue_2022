
export default [
  {
    url: '/',
    name: 'home',
    slug: 'home',
    icon: 'SettingsIcon',
    i18n: 'Home'
  },
  {
    url: null,
    name: 'SystemConstants',
    // tag: '1',
    // tagColor: 'success',
    icon: 'SettingsIcon',
    i18n: 'SystemConstants',
    submenu: [
      {
        url: '/system-constants/settings',
        name: 'settings',
        slug: 'settings',
        i18n: 'Settings'
      },
    ]
  },
]

