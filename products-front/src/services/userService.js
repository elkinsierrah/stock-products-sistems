import interceptor from '../helpers/interceptor';
import handleErrors from '../helpers/error';

const userService = {
    async searchUser(email) {
        try {
            const response = await interceptor.get('/users/' + email);
            return response;
        }
        catch (error) {
            handleErrors(error);
            return error.response;
        }
    }
};

export default userService;