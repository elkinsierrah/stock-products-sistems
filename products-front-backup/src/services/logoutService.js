import interceptor from '../helpers/interceptor';
import handleErrors from '../helpers/error';

const logoutService = {
    async logout() {
        try {
            const response = await interceptor.get('/logout');
            return response;
        }
        catch (error) {
            handleErrors(error);
            return error.response;
        }
    }
};

export default logoutService;