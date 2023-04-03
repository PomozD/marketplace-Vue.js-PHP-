import axios from 'axios';

axios.defaults.headers.common = {
    "Content-Type": "application/json;charset=utf-8",
};

export const getCategory = async () => {
    const response = await axios.get('http://project-php:8081/server/categories.php');
    return response.data;
}