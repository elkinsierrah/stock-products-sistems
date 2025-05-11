import axios from 'axios';
import { baseURL } from '../helpers/api';
import handleErrors from '../helpers/error';

const loginService = {
    async login(email, password) {
        try {
            const response = await axios.post(baseURL + '/login', {
                email: email,
                password: password,
            });
            return response;
        } catch (error) {
            handleErrors(error);
            return error.response;
        }
    }
};

export default loginService;
