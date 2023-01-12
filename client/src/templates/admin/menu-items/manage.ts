// assets
import { IconDashboard } from '@tabler/icons';

// constant
const icons = { IconDashboard };

// ==============================|| DASHBOARD MENU ITEMS ||============================== //

const manage = {
    id: 'manage',
    title: 'Manage',
    type: 'group',
    children: [
        {
            id: 'manage-product',
            title: 'Products',
            type: 'item',
            url: 'admin/manage/products',
            icon: icons.IconDashboard,
            breadcrumbs: false
        },
        {
            id: 'manage-category',
            title: 'Categories',
            type: 'item',
            url: 'admin/manage/categories',
            icon: icons.IconDashboard,
            breadcrumbs: false
        }
    ]
};

export default manage;
