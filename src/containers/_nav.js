export default [
  {
    _name: 'CSidebarNav',
    _children: [
      {
        _name: 'CSidebarNavTitle',
        _children: ['محاسبة']
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'ثوابت النظام',
        route: '/',
        icon: 'cil-puzzle',
        items: [
          {
            name: 'المناطق',
            to: '/areas'
          },
        ]
      },
    ]
  }
]