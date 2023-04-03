import axios from 'axios';

axios.defaults.headers.common = {
    "Content-Type": "application/json;charset=utf-8",
};

export const getCategory = async () => {
    const response = await axios.get('http://project-php:8081/server/getCategories.php');
    return response.data;
}

export const getSex = async () => {
    const response = await axios.get('http://project-php:8081/server/getSexs.php');
    return response.data;
}

export const getSize = async () => {
    const response = await axios.get('http://project-php:8081/server/getSizes.php');
    return response.data;
}

export const getType = async (categoryName) => {
    const response = await axios.get('http://project-php:8081/server/getTypes.php?categoryname=' + categoryName);
    return response.data;
}

export const addProduct = async (item_name, item_size, item_sex, item_category, item_type, item_price, item_count, item_composition, item_mainPhoto, item_fsPhoto, item_ssPhoto) => {
    const response = await axios.get('http://project-php:8081/server/addProduct.php?item_name=' + item_name +
                                         '&item_size=' + item_size + '&item_sex=' + item_sex + '&item_category=' + item_category +
                                         '&item_type=' + item_type + '&item_price=' + item_price + '&item_count=' + item_count +
                                         '&item_composition=' + item_composition + '&item_mainPhoto=' + item_mainPhoto +
                                         '&item_fsPhoto=' + item_fsPhoto + '&item_ssPhoto=' + item_ssPhoto);
    console.log(response.data);
    return response.data;
}

export const addCategory = async (categoryName) => {
    const response = await axios.get('http://project-php:8081/server/addCategory.php?categoryname=' + categoryName);
    return response.data;
}

export const deleteCategory = async (categoryName) => {
    const response = await axios.get('http://project-php:8081/server/deleteCategory.php?categoryname=' + categoryName);
    return response.data;
}

export const addType = async (categoryName, type) => {
    const response = await axios.get('http://project-php:8081/server/addType.php?categoryname=' + categoryName + '&type=' + type);
    console.log(response.data);
    return response.data;
}

export const deleteType = async (categoryName, type) => {
    const response = await axios.get('http://project-php:8081/server/deleteType.php?categoryname=' + categoryName + '&type=' + type);
    console.log(response.data);
    return response.data;
}

