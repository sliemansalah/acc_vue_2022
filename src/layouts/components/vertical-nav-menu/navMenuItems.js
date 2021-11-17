
export default [
  {
    url: null,
    name: 'Dashboard',
    tag: '1',
    tagColor: 'success',
    icon: 'HomeIcon',
    i18n: 'Dashboard',
    submenu: [
      {
        url: '/dashboard/analytics',
        name: 'Analytics',
        slug: 'dashboard-analytics',
        i18n: 'Analytics'
      },
    ]
  },
  {
    header: 'Apps',
    icon: 'PackageIcon',
    i18n: 'Apps',
    items: [
      {
        tag: '5',
        tagColor: 'danger',
        url: '/apps/email',
        name: 'Email',
        slug: 'email',
        icon: 'MailIcon',
        i18n: 'Email'
      },
    ]
  },
]

