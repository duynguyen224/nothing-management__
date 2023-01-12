import React from 'react';
import { Link, Outlet } from 'react-router-dom';

function FrontendLayout(): React.ReactElement {
    return (
        <>
            <nav>
                <ul>
                    <li>
                        <Link to="/cart">Shopping cart</Link>
                    </li>
                    <li>
                        <Link to="/login">Login</Link>
                    </li>
                </ul>
            </nav>

            <Outlet />
        </>
    );
}

export default FrontendLayout;
