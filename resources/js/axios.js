import axios from 'axios';

const axiosClient = axios.create({
    baseURL : process.env.APP_URL,
    headers : {
        'Content-Type' : 'application/json',
        'X-Requested-With' :'XMLHttpRequest',
        'Accept' : 'application/json'
    }
});

export default axiosClient;
