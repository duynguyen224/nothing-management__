import axios from 'axios';
import { getAccessToken } from './../utils/index';

// Create axios instance WITHOUT authorization header
export const getAxiosInstance = () => {
    return axios.create({
        baseURL: `${process.env.REACT_APP_ROOT_URL}`,
        headers: { Accept: 'Application/json' }
    });
};

// Create axios instance WITH Authorization header
export const getAxiosWithToken = () => {
    const token = getAccessToken();
    const authorizationType = process.env.REACT_APP_AUTHORIZATION_TYPE ? process.env.REACT_APP_AUTHORIZATION_TYPE : 'Bearer';

    return axios.create({
        baseURL: `${process.env.REACT_APP_ROOT_URL}`,
        headers: { Authorization: `${authorizationType} ${token}`, Accept: 'Application/json' }
    });
};
