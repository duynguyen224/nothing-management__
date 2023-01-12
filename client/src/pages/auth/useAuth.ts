import axios from 'axios';
import { axiosInstance } from '../../configuration/axiosInstance';
import { IFormInput } from './login/interface';

function useAuth() {
    const handleLogin = (data: IFormInput) => {
        const res = axios.post(`${process.env.REACT_APP_ROOT_URL}/api/auth/login`, data);
        return res;
    };

    const handleLogout = () => {
        const res = axiosInstance().post(`/api/auth/logout`);
        return res;
    };

    return {
        handleLogin,
        handleLogout
    };
}

export default useAuth;
