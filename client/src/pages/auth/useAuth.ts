import { getAxiosInstance } from './../../configuration/axiosInstance';
import axios from 'axios';
import { getAxiosWithToken } from '../../configuration/axiosInstance';
import { IFormInput } from './login/interface';

function useAuth() {
    const handleLogin = (data: IFormInput) => {
        const res = getAxiosInstance().post('/api/auth/login', data);
        return res;
    };

    const handleLogout = () => {
        const res = getAxiosWithToken().get(`/api/auth/logout`);
        return res;
    };

    return {
        handleLogin,
        handleLogout
    };
}

export default useAuth;
