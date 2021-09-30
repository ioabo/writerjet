import DocumentsIndex from './components/documents/Index'
import DocumentsCreate from './components/documents/Example_multiselect'
import DocumentsEdit from './components/documents/Edit'

export const routes = [
    {
        path: '/documents',
        name: 'DocumenstIndex',
        component: DocumentsIndex
    },
    { 
        path: '/documents/create',
        name: 'DocumentCreate',
        component: DocumentsCreate
    },
    {
        path: '/documents/:id',
        name: 'DocumentsEdit',
        component: DocumentsEdit
    }
];