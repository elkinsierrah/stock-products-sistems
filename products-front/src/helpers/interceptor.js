import axios from 'axios';
import { baseURL } from './api';

const interceptor = axios.create({
    baseURL: baseURL,
});

interceptor.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default interceptor;