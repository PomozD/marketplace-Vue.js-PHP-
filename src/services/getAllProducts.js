import axios from 'axios';

axios.defaults.headers.common = {
    "Content-Type": "application/json;charset=utf-8",
};

export const getAllProducts = async () => {

    const response = await axios.get(
        'http://project-php:8081/server/getAllProducts.php');
    return response.data?.item;
}
export const editProducts = async (id, name, size, sex, category, type, price, count, composition, main_photo,
                                   first_sec_photo, second_sec_photo) => {

    const response = await axios.get(
        'http://project-php:8081/server/editProducts.php?itemId=' + id + '&name=' + name +
                                                                    '&size=' + size + '&sex=' + sex +
                                                                    '&category=' + category + '&type=' + type +
                                                                    '&price=' + price + '&count=' + count +
                                                                    '&composition=' + composition + '&main_photo=' + main_photo +
                                                                    '&first_sec_photo=' + first_sec_photo + '&second_sec_photo=' + second_sec_photo);
    return response.data;
}

export const deleteProducts = async (id) => {

    const response = await axios.get(
        'http://project-php:8081/server/deleteProducts.php?itemId=' + id);
    return response.data;
}
