import { lazy } from 'react';
import Dashboard from '../pages/admin/dashboard/ui/Dashboard';
import ListCategory from '../pages/admin/manages/category/ui/ListCategory';
import ListProduct from '../pages/admin/manages/product/ui/ListProduct';

// project imports
import MainLayout from '../templates/admin/layout/MainLayout';
import Loadable from '../templates/admin/ui-component/Loadable';

// ==============================|| MAIN ROUTING ||============================== //

const MainRoutes = {
    path: '/',
    element: <MainLayout />,
    children: [
        {
            path: '/admin',
            element: <Dashboard />
        },
        {
            path: 'admin/dashboard',
            element: <Dashboard />
        },
        {
            path: 'admin/manage',
            children: [
                {
                    path: 'products',
                    element: <ListProduct />
                }
            ]
        },
        {
            path: 'admin/manage',
            children: [
                {
                    path: 'categories',
                    element: <ListCategory />
                }
            ]
        }
    ]
};

export default MainRoutes;
