import axios from 'axios';

const baseURL = process.env.NODE_ENV === 'production' ? '/api' : 'http://localhost/api';


const api = axios.create({
    baseURL,
    headers: {
        "Content-Type": "application/json"
    }
});

api.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default api;
