import axios from 'axios';
import { getAccessToken } from './../utils/index';

export const axiosInstance = () => {
    const token = getAccessToken();
    const authorizationType = process.env.REACT_APP_AUTHORIZATION_TYPE ? process.env.REACT_APP_AUTHORIZATION_TYPE : 'Bearer';

    return axios.create({
        baseURL: `${process.env.REACT_APP_ROOT_URL}`,
        headers: { Authorization: `${authorizationType} ${token}` }
    });
};
