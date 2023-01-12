import { useContext, useEffect, useState } from 'react';
import { SubmitHandler } from 'react-hook-form';
import { useNavigate } from 'react-router-dom';
import { ROLES } from '../../../../configuration/constants/role';
import { AppContext } from '../../../../context/AppContext';
import { IUserInfo } from '../../../../context/interface';
import { LOGIN_FAILED, LOGIN_REQUEST, LOGIN_SUCCESS } from '../../../../context/reducer';
import useAuth from '../../useAuth';
import { IFormInput } from '../interface';

function useLogin() {
    const [error, setError] = useState<string | null>();

    const { handleLogin } = useAuth();

    const { state, dispatch } = useContext(AppContext);
    const { loading } = state;

    const navigate = useNavigate();

    useEffect(() => {
        localStorage.removeItem('currentUser');
    }, []);

    const onSubmit: SubmitHandler<IFormInput> = async (data) => {
        try {
            dispatch({
                type: LOGIN_REQUEST
            });

            const res = await handleLogin(data);
            if (res.status === 200) {
                const payload = res.data;

                const user: IUserInfo = {
                    access_token: payload.access_token,
                    type: payload.type,
                    id: payload.user.id,
                    name: payload.user.name,
                    email: payload.user.email,
                    role: payload.user.role
                };

                localStorage.setItem('currentUser', JSON.stringify(user));

                dispatch({
                    type: LOGIN_SUCCESS,
                    payload: user
                });

                navigateUser(user.role);
            }
        } catch (error: any) {
            dispatch({
                type: LOGIN_FAILED
            });

            const errorMsg = error.response.data.error;
            setError(errorMsg);
        }
    };

    const navigateUser = (role: string): void => {
        switch (role.trim().toLowerCase()) {
            case ROLES.ADMIN:
                navigate('/admin/dashboard');
                break;
            case ROLES.YARD_OWNER:
                navigate('/admin/dashboard');
                break;
            case ROLES.CLIENT:
                navigate('/');
                break;
            default:
                navigate('/login');
                break;
        }
    };

    return {
        loading,
        error,
        onSubmit
    };
}

export default useLogin;
