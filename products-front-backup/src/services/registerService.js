import axios from 'axios';
import { baseURL } from '../helpers/api';
import handleErrors from '../helpers/error';

const registerService = {
    async register(email, password, name) {
        try {
            const response = await axios.post(baseURL + '/register', {
                email: email,
                password: password,
                name: name,
            });
            return response;
        } catch (error) {
            handleErrors(error);
            return error.response;
        }
    }
};

export default registerService;