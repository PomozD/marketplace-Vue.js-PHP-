import axios from 'axios';

axios.defaults.headers.common = {
    "Content-Type": "application/json;charset=utf-8",
};

export const getItem = async (category, type, sortingValue, filtresValue, searchText) => {

    const response = await axios.get(
        'http://project-php:8081/server/catalog.php?category=' + category +
        '&type=' + type +
        '&sortingValue=' + sortingValue +
        '&filtresValue=' + JSON.stringify(filtresValue) +
        '&searchText=' + searchText);
    //console.log(response.data);
    return response.data?.item;
}

export const getSize = async () => {
    const response = await axios.get('http://project-php:8081/server/getSizes.php');
    return response.data;
}