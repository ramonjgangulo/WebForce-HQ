import axiosClient from "./axios";

// method to set bearer token into axios
const tokenAuth = token =>
{
    if(token)
    {
        axiosClient.defaults.headers.common['Authorization'] =`Bearer ${token}`;
    }
    else
        delete  axiosClient.defaults.headers.common['Authorization'];
}

export default tokenAuth;
