import DocumentsIndex from './components/documents/Index'
import DocumentsCreate from './components/documents/Create'
import DocumentsCreateFromTemplate from './components/documents/CreateFromTemplate'
import DocumentsEdit from './components/documents/Edit'
import DocumentsShow from './components/documents/Show'
import TemplatesIndex from './components/templates/Index'
import TemplatesCreate from './components/templates/Create'
import TemplatesEdit from './components/templates/Edit'
import DashboardIndex from './components/Dashboard'
import DocumentsArchives from './components/documents/Archives'
import DocumentsArchivesForSecretaries from './components/documents/ForSecretary'
import DocumentsDrafts from './components/documents/Drafts'
import UsersIndex from './components/users/Index'
import UsersEdit from './components/users/Edit'

export const routes = [
    {
        path: '/documents',
        name: 'DocumenstIndex',
        component: DocumentsIndex
    },
    { 
        path: '/documents/create',
        name: 'DocumentsCreate',
        component: DocumentsCreate
    },
    { 
        path: '/documents/createfromtemplate/:id',
        name: 'DocumentsCreateFromTemplate',
        component: DocumentsCreateFromTemplate
    },
    {
        path: '/documents/:id',
        name: 'DocumentsEdit',
        component: DocumentsEdit
    },
    {
        path: '/documents/show/:id',
        name: 'DocumentsShow',
        component: DocumentsShow
    },
    {
        path: '/documents-archives',
        name: 'DocumentsArchives',
        component: DocumentsArchives
    },
    {
        path: '/documents-drafts',
        name: 'DocumentsDrafts',
        component: DocumentsDrafts
    },
    {
        path: '/for-secretaries',
        name: 'DocumentsArchivesForSecretaries',
        component: DocumentsArchivesForSecretaries
    },
    {
        path: '/templates',
        name: 'TemplatesIndex',
        component: TemplatesIndex
    },
    {
        path: '/templates/create',
        name: 'TemplatesCreate',
        component: TemplatesCreate
    },
    {
        path: '/templates/:id',
        name: 'TemplatesEdit',
        component: TemplatesEdit
    },
    {
        path: '/home',
        name: 'DashboardIndex',
        component: DashboardIndex
    },
    {
        path: '/users-list',
        name: 'UsersIndex',
        component: UsersIndex
    },
    {
        path: '/users/:id',
        name: 'UsersEdit',
        component: UsersEdit
    },
];