import { useSelector } from 'react-redux';

import { CssBaseline, StyledEngineProvider } from '@mui/material';
import { ThemeProvider } from '@mui/material/styles';

// routing
import Routes from './routes';

// defaultTheme
import themes from './templates/admin/themes';

// project imports
import { Route, Routes as RoutesRouterDom, useLocation } from 'react-router-dom';
import PrivateRoute from './components/auth/private_route/ui/PrivateRoute';
import ShoppingCart from './components/frontend/cart/ui';
import Home from './components/frontend/home/ui';
import Login from './pages/auth/login/ui/Login';
import NavigationScroll from './templates/admin/layout/NavigationScroll';
import FrontendLayout from './templates/frontend/layout/FrontendLayout';

// ==============================|| APP ||============================== //

const App = () => {
    const customization = useSelector((state: any) => state.customization);

    if (useLocation().pathname.includes('/admin')) {
        return (
            <PrivateRoute>
                <StyledEngineProvider injectFirst>
                    <ThemeProvider theme={themes(customization)}>
                        <CssBaseline />
                        <NavigationScroll>
                            <Routes />
                        </NavigationScroll>
                    </ThemeProvider>
                </StyledEngineProvider>
            </PrivateRoute>
        );
    }
    return (
        <RoutesRouterDom>
            <Route path="/*" element={<FrontendLayout />}>
                <Route index element={<Home />} />
                <Route path="cart" element={<ShoppingCart />} />
                <Route path="login" element={<Login />} />
            </Route>
        </RoutesRouterDom>
    );
};

export default App;
