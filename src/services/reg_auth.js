import axios from 'axios';

axios.defaults.headers.common = {
    "Content-Type": "application/json;charset=utf-8",
};

export const getUser = async (email, password) => {
    const response = await axios.get('http://project-php:8081/server/signin.php?email=' + email + '&password=' + password );
    return response.data;
}

export const postUser = async (name, surname, email, password) => {
    const data = {
        name,
        surname,
        email,
        password,
    };
    const response = await axios.post("http://project-php:8081/server/signup.php", JSON.stringify(data), {
        headers: {
            "Content-Type": "application/json;charset=utf-8",
        }
    });

    return response.data;
}