import React from 'react';
import { Navigate } from 'react-router-dom';
import { getInitialState } from '../../../../utils';
import { Props } from '../interface/index';

const isLogin = (): boolean => {
    const appState = getInitialState();

    if (appState.currentUser?.id == 0) {
        return false;
    }

    return true;
};

function PrivateRoute({ children }: Props): React.ReactElement {
    if (isLogin()) {
        return <React.Fragment>{children}</React.Fragment>;
    }

    return <Navigate to="/login" replace={true} />;
}

export default PrivateRoute;
